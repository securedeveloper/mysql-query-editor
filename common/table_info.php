<?php
if (!isset($selected_table)) {
    $selected_table = $_REQUEST['selected_table'];
}

$cols = $db->get_table_columns($selected_table);
if (isset($cols) && count($cols) > 0) :
    $records = $db->get_table_records($selected_table);
    $base_url = "index.php?table=" . $selected_table;
    $vind = 0;
    ?>
    <br>
    <a href="<?= $base_url ?>&add_record=1">ADD NEW RECORD</a>
    <table class="tableinfo" width="100%">
        <tr>
            <?php foreach ($cols as $k => $col) : ?>
                <th><?= $col['COLUMN_NAME']; ?> </th>
            <?php endforeach; ?>
    <!--            <th>Actions</th>-->
        </tr>
        <?php if (isset($records) && count($records) > 0) : ?>
            <?php
            foreach ($records as $k => $v) : $rind = 0;
                $is_editable = true;
                $primary_key = "";
                ?>
                <tr>
                <form id="form<?= $vind; ?>" action="index.php" method="post">
                    <?php foreach ($v as $key => $value) : ?>
                        <td>
                            <span class="viewer<?= $vind ?>"><?= $value; ?></span>
                            <span class="editor<?= $vind ?>" style="display: none;"><?php $helper->get_editor_for($cols[$rind], $value, $rind++, $is_editable, $primary_key); ?></span>
                        </td>
                    <?php endforeach; ?>
            <!--                    <td> 
            <span class="viewer<?= $vind ?>">
            <a href="javascript:void(0);" onclick="changeVisibility('<?= $vind ?>');" title="Edit Record"><img src="<?= RESOURCE_PATH; ?>edit.png"></a> 
                    <?php if ($is_editable == false) : ?>
                                <a href="javascript:void(0);" title="Delete Record" onclick="alert('This record can not be deleted');"><img src="<?= RESOURCE_PATH; ?>delete.png"></a>
                    <?php else: ?>
                                <a href="<?= $base_url; ?>&record_delete=1&primary_key=<?= $primary_key ?>" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete Record"><img src="<?= RESOURCE_PATH; ?>delete.png"></a>
                    <?php endif; ?>
            </span>
            <span class="editor<?= $vind ?>" style="display: none;">
                    <?php if ($is_editable == false) : ?>
                                <img src="<?= RESOURCE_PATH; ?>caution.png" alt="Can't be edited" title="Non editable"/>
                    <?php else: ?>
                                <input type="image" name="submit" src="<?= RESOURCE_PATH; ?>save.png" border="0" alt="Submit" />
                    <?php endif; ?>
            <a href="javascript:void(0);" onclick="changeVisibility('<?= $vind ?>');" title="Cancel Editing"><img src="<?= RESOURCE_PATH; ?>cancel_edit.png"></a>
            </span>
            </td>-->
                </form>
            </tr>
            <?php
            $vind++;
        endforeach;
        ?>
    <?php else: ?>
    <?php endif; ?>
    </table>
    <?php
else:
    echo '<h1>Selected table is empty</h1>';
endif;