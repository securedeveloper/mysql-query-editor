<?php
if (isset($_REQUEST['submit_add_record'])) {
    $data = $_REQUEST;
    $query = "INSERT INTO `" . $data['table'] . "` ";
    if (isset($data['table']))
        unset($data['table']);
    if (isset($data['database']))
        unset($data['database']);
    if (isset($data['submit_add_record']))
        unset($data['submit_add_record']);
    if (isset($data['submit_x']))
        unset($data['submit_x']);
    if (isset($data['submit_y']))
        unset($data['submit_y']);
    $cols = array();
    $vals = array();
    foreach ($data as $key => $value) {
        $cols[] = "`" . $key . "`";
        $vals[] = "'" . $value . "'";
    }
    $query .= "(";
    $query .= implode(",", $cols);
    $query .= ") VALUES (";
    $query .= implode(",", $vals);
    $query .= ")";
    $error = "";
    if ($db->run_query($query, $error) == 1) {
        echo '<br><span class="success">Record added successfully!</span>';
    } else {
        echo '<br><span class="error">Record adding failed <br>' . $error . '</span>';
    }
    $selected_table = $_REQUEST['table'];
    global $selected_table;
} else {
    $cols = $db->get_table_columns($selected_table);
    if (isset($cols) && count($cols) > 0) :
        $rind = 0;
        ?>
        <fieldset>
            <legend>Add New Record</legend>
            <form action="index.php" method="post" style="text-align: center;">
                <input type="hidden" name="table" value="<?= $selected_table ?>" />
                <input type="hidden" name="submit_add_record" value="1" />
                <table style="margin:auto;">
                    <?php
                    foreach ($cols as $key => $value) :
                        if (isset($value['COLUMN_KEY']) && !empty($value['COLUMN_KEY']) && $value['COLUMN_KEY'] == "PRI") :
                            $rind++;
                        else:
                            ?>
                            <tr>

                                <td><?= $value['COLUMN_NAME']; ?></td>
                                <td><?php $helper->get_editor_for($cols[$rind++], '', 1); ?></td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </table>
                <input type="image" name="submit" src="<?= RESOURCE_PATH; ?>database.png" border="0" alt="Submit" />
            </form>
        </fieldset>
        <?php
    else:
        ?><h1>You can't add record to this table</h1><?php
    endif;
}

