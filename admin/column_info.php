<?php
$col = $_REQUEST;
?>
<fieldset>
    <legend>Column Editor</legend>
    <form name="col_editor" id="col_editor" action="admin.php" method="post">
        <table class="tableinfo" width="100%">
            <tr>
                <td>Name : </td>
                <td><input type="text" name="column_name" value="<?= $col['COLUMN_NAME'] ?>" /></td>
            </tr>
            <tr>
                <td>Type : </td>
                <td>
                    <?php $helper->get_column_type_drop_down($col['DATA_TYPE']); ?>
                </td>
            </tr>
            <tr>
                <td>Length/Values : </td>
                <td><input type="number" name="length" value="<?= $col['CHARACTER_MAXIMUM_LENGTH'] ?>" /></td>
            </tr>
            <tr>
                <td>IsNull : </td>
                <td>
                    <input type="checkbox" value="<?= ($col['IS_NULLABLE'] == 'YES') ? '1' : '0' ?>" <?= ($col['EXTRA'] == 'auto_increment') ? "disabled " : "" ?> name="IS_NULLABLE" onchange="manageCheckBoxValue(this);">
                </td>
            </tr>
            <?php if (strpos($col['COLUMN_TYPE'], 'int') !== false): ?>
                <tr>
                    <td>Auto Increment (Primary Key ): </td>
                    <td>
                        <input type="checkbox" value="<?= ($col['EXTRA'] == 'auto_increment') ? '1' : '0' ?>" 
                        <?= ($col['EXTRA'] == 'auto_increment') ? "disabled checked" : "" ?>
                               name="extra" onchange="manageCheckBoxValue(this);">
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="image" name="submit" src="<?= RESOURCE_PATH; ?>submit.png" border="0" alt="Submit" />
                </td>
            </tr>
        </table>
        <input type="hidden" name="table" value="<?= $col['TABLE_NAME'] ?>">
        <input type="hidden" name="column" value="<?= $col['COLUMN_NAME'] ?>">
        <input type="hidden" name="database" value="<?= $col['TABLE_SCHEMA'] ?>">
        <input type="hidden" name="column_edit" value="1">
    </form>
</fieldset>