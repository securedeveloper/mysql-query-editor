<?php
include('credentials.php');

class DBHandler {

    private $db;
    private $dbh;

    public function __construct() {
        $this->dbh = mysql_connect(SERVER, PREFIX . USER, PASS);
        if (!$this->dbh) {
            echo "connection to database failed.";
        }
        $this->db = mysql_select_db(PREFIX . DATABASE);
        if (!$this->db) {
            echo "Database selection failed.";
        }
    }

    public function __destruct() {
        mysql_close($this->dbh);
    }

    public function get_tables_list() {
        $query = mysql_query('show tables', $this->dbh);
        if (!$query) {
            echo ('No tables are available at this time');
        } else {
            if (mysql_num_rows($query) > 0) {
                while ($row = mysql_fetch_array($query)) {
                    if (PREFIX != '') {
                        $result[] = $row['Tables_in_' . PREFIX . DATABASE];
                    } else {
                        $result[] = $row['Tables_in' . PREFIX . '_' . DATABASE];
                    }
                }
                echo "<ul class='atbls'>";
                for ($i = 0; $i < count($result); $i++) {
                    echo "<li onClick='ChangeQuery(\"$result[$i]\");'>" . $result[$i] . "</li>";
                }
                echo "</ul>";
            } else {
                echo ('No tables are available at this time');
            }
        }
    }

    public function get_table_columns($tbl) {
        $c = "SELECT * FROM `INFORMATION_SCHEMA`.`COLUMNS`  WHERE `TABLE_SCHEMA` = '" . PREFIX . DATABASE . "' AND `TABLE_NAME` = '$tbl'";
        $query = mysql_query($c, $this->dbh);
        if ($query == FALSE) {
            $ccount = 0;
        } else {
            $ccount = mysql_num_rows($query);
        }
        if ($ccount > 0) {
            $ind = 0;
            $arr = array();
            while ($row = mysql_fetch_array($query)) {
                foreach ($row as $key => $value) {
                    $arr[$ind][$key] = $value;
                }
                $ind++;
                //$arr[] = $row['COLUMN_NAME'];
            }
            return $arr;
        } else {
            return null;
        }
    }

    public function get_table_records($tbl) {
        $c = "SELECT * FROM `$tbl`";
        $query = mysql_query($c, $this->dbh);
        if ($query == FALSE) {
            $ccount = 0;
        } else {
            $ccount = mysql_num_rows($query);
        }
        if ($ccount > 0) {
            $arr = array();
            $ind = 0;
            while ($qresult = mysql_fetch_row($query)) {
                foreach ($qresult as $key => $value) {
                    $arr[$ind][$key] = $value;
                }
                $ind++;
            }
            return $arr;
        } else {
            return null;
        }
    }

    public function get_tables_drop_down($selected = null) {
        ?>
        <select name="selected_table">
            <?php
            $query = mysql_query('show tables', $this->dbh);
            if (!$query) {
                echo ('<option>No table found!</option>');
            } else {
                if (mysql_num_rows($query) > 0) {
                    while ($row = mysql_fetch_array($query)) {
                        if (PREFIX != '') {
                            $result[] = $row['Tables_in_' . PREFIX . DATABASE];
                        } else {
                            $result[] = $row['Tables_in' . PREFIX . '_' . DATABASE];
                        }
                    }
                    for ($i = 0; $i < count($result); $i++) {
                        echo "<option value=\"" . $result[$i] . "\"";
                        echo ($selected == $result[$i]) ? " selected" : "";
                        echo ">" . $result[$i] . "</option>";
                    }
                } else {
                    echo ('<option>No table avialable!</option>');
                }
            }
            ?>
        </select>
        <?php
    }

    public function run_query($qt, &$error) {
        $query = mysql_query($qt, $this->dbh);
        if ($query == FALSE) {
            $error = mysql_error($this->dbh);
            return 0;
        } else {
            return 1;
        }
    }

}
