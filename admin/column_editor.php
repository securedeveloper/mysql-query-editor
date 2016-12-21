<?php

$error = "";
$query = "ALTER TABLE `" . $_REQUEST['table'];
$query .= "` CHANGE `" . $_REQUEST['column'];
$query .= "` `" . $_REQUEST['column_name'];
$len = (int) $_REQUEST['length'];
if ($len == 0)
    $len = 11;
$query .= "` " . strtoupper($_REQUEST['data_type']) . "(" . $len . ") ";
if (isset($_REQUEST['extra']) && $_REQUEST['extra'] == '1') {
    $err = "";
    $q1 = "ALTER TABLE `" . $_REQUEST['table'] . "` ADD PRIMARY KEY(`" . $_REQUEST['column'] . "`)";
    $q2 = "ALTER TABLE `" . $_REQUEST['table'] . "` MODIFY COLUMN `" . $_REQUEST['column'] . "` INT NOT NULL AUTO_INCREMENT";
    $db->run_query($q1, $err);
    $db->run_query($q2, $err);
}
if ($db->run_query($query, $error) == 1) {
    echo '<span class="success">Table altered successfully</span>';
} else {
    echo '<span class="error">Table alterations failed.<br>' . $error . '</span>';
}
$selected_table = $_REQUEST['table'];
global $selected_table;
