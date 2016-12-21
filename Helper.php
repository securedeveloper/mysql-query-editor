<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author Afzal Ahmad
 */
class Helper {

    public function get_editor_for($col, $value, $rind = 1, &$is_editable = true, &$primary_key = "") {
        if ($rind == 0):
            echo '<input type="hidden" name="table" value="' . $col['TABLE_NAME'] . '"/>';
            echo '<input type="hidden" name="database" value="' . $col['TABLE_SCHEMA'] . '"/>';
            echo '<input type="hidden" name="record_edit" value="1" />';
            if (isset($col['COLUMN_KEY']) && !empty($col['COLUMN_KEY']) && $col['COLUMN_KEY'] == 'PRI') :
                echo '<input type="hidden" name="has_primary_key" value="1"/>';
                echo '<input type="hidden" name="primary_key" value="' . $col['COLUMN_NAME'] . '"/>';
                $primary_key = $col['COLUMN_NAME'] . "&".$col['COLUMN_NAME']."=" . $value;
            else:
                $is_editable = false;
                echo '<input type="hidden" name="has_primary_key" value="0"/>';
            endif;
        endif;
        if (isset($col['COLUMN_KEY']) && !empty($col['COLUMN_KEY']) && $col['COLUMN_KEY'] == "PRI") :
            echo '<input type="hidden" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '"/>' . $value;
        elseif (strpos($col['COLUMN_TYPE'], 'char') !== false):
            echo '<input type="text" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '" maxlength="' . $col['CHARACTER_MAXIMUM_LENGTH'] . '" />';
        elseif (strpos($col['COLUMN_TYPE'], 'int') !== false):
            echo '<input type="number" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '" maxlength="' . $col['CHARACTER_MAXIMUM_LENGTH'] . '"  />';
        elseif (strpos($col['COLUMN_TYPE'], 'decimal') !== false):
            echo '<input type="number" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '" maxlength="' . $col['CHARACTER_MAXIMUM_LENGTH'] . '"  />';
        elseif (strpos($col['COLUMN_TYPE'], 'float') !== false):
            echo '<input type="number" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '" maxlength="' . $col['CHARACTER_MAXIMUM_LENGTH'] . '"  />';
        elseif (strpos($col['COLUMN_TYPE'], 'date') !== false):
            echo '<input type="date" name="' . $col['COLUMN_NAME'] . '" value="' . $value . '" maxlength="' . $col['CHARACTER_MAXIMUM_LENGTH'] . '"  />';
        elseif (strpos($col['COLUMN_TYPE'], 'text') !== false):
            echo '<textarea name="' . $col['COLUMN_NAME'] . '">' . $value . '</textarea>';
        else:
            print_r($col);
        endif;
        //print_r($col);
    }

    public function get_column_editor($col) {
        echo '<input type="hidden" name="selected_column" value="1" />';
        echo '<input type="hidden" name="table" value="' . $col['TABLE_NAME'] . '" />';
        foreach ($col as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
        }
    }

    public function get_column_type_drop_down($selected) {
        $arr = array("INT", "VARCHAR", "TEXT", "DATE", "BIGINT", "DECIMAL", "FLOAT", "DOUBLE", "REAL", "BIT", "BOOLEAN", "SERIAL"
            , "DATE", "DATETIME", "TIMESTAMP", "TIME", "YEAR", "CHAR", "VARCHAR", "TINYTEXT", "TEXT", "MEDIUMTEXT", "LONGTEXT", "BINARY",
            "VARBINARY", "TINYBLOB", "MEDIUMBLOB", "BLOB", "LONGBLOB", "ENUM", "SET", "GEOMETRY", "POINT", "LINESTRING", "POLYGON"
            , "MULTIPOINT", "MULTILINESTRING", "MULTIPOLYGON", "GEOMETRYCOLLECTION");
        echo '<select name="data_type">';
        foreach ($arr as $value) {
            echo '<option value="' . $value . '"';
            if (strtolower($value) == $selected):
                echo ' selected="selected" ';
            endif;
            echo '>';
            echo $value;
            echo '</option>';
        }
        echo '</select>';
    }

}
