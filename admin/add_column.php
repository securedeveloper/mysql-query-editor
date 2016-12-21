<?php
if (isset($_REQUEST['submit_add_column'])) {
    $query = "ALTER TABLE `" . $_REQUEST['table'] . "` ADD `" . $_REQUEST['column_name'] . "` " . $_REQUEST['data_type'];
    if (isset($_REQUEST['length']) && is_numeric($_REQUEST['length']) && ((int) $_REQUEST['length']) > 0)
        $query .= " (" . $_REQUEST['length'] . ")";
    if (isset($_REQUEST['IS_NULLABLE']))
        $query .= " NULL";
    else
        $query .= " NOT NULL";
    if (isset($_REQUEST['extra']))
        $query .= "  AUTO_INCREMENT PRIMARY KEY";
    if ($db->run_query($query, $error) == 1) {
        echo '<span class="success">Table altered successfully</span>';
    } else {
        echo '<span class="error">Table alterations failed.<br>' . $error . '</span>';
    }
    $selected_table = $_REQUEST['table'];
    global $selected_table;
} else {
    $col = $_REQUEST;
    ?>
    <fieldset>
        <legend>Column Editor</legend>
        <form name="col_editor" id="col_editor" action="admin.php" method="post">
            <table class="tableinfo" width="100%">
                <tr>
                    <td>Name : </td>
                    <td><input type="text" name="column_name" value="" /></td>
                </tr>
                <tr>
                    <td>Type : </td>
                    <td>
                        <?php $helper->get_column_type_drop_down(''); ?>
                    </td>
                </tr>
                <tr>
                    <td>Length/Values : </td>
                    <td><input type="number" name="length" value="" min="1" /></td>
                </tr>
                <tr>
                    <td>IsNull : </td>
                    <td>
                        <input type="checkbox" value="0" name="IS_NULLABLE" onchange="manageCheckBoxValue(this);">
                    </td>
                </tr>
                <tr>
                    <td>Auto Increment (Primary Key ): </td>
                    <td>
                        <input type="checkbox" value="0" name="extra" onchange="manageCheckBoxValue(this);">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="image" name="submit" src="<?= RESOURCE_PATH; ?>submit.png" border="0" alt="Submit" />
                    </td>
                </tr>
            </table>
            <input type="hidden" name="table" value="<?= $col['table'] ?>">
            <input type="hidden" name="submit_add_column" value="1">
        </form>
    </fieldset>
<?php } ?>