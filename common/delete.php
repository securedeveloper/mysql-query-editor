<?php

$data = $_REQUEST;
$query = "DELETE FROM `" . $data['table'] . "` ";
if (isset($data['table']))
    unset($data['table']);
if (isset($data['database']))
    unset($data['database']);
if (isset($data['has_primary_key']))
    unset($data['has_primary_key']);
if (isset($data['submit_x']))
    unset($data['submit_x']);
if (isset($data['submit_y']))
    unset($data['submit_y']);
if (isset($data['record_edit']))
    unset($data['record_edit']);
$primary_key = $data['primary_key'];
unset($data['primary_key']);
$query .= " WHERE `" . $primary_key . "`='" . $data[$primary_key] . "'";
$error = "";
if ($db->run_query($query, $error) == 1) {
    echo '<span class="success">Record deleted successfully!</span>';
} else {
    echo '<span class="error">Record deletion failed <br>' . $error . '</span>';
}
$selected_table = $_REQUEST['table'];
global $selected_table;
