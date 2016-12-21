<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Query Editor | Admin</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" media="all">
        <script src="jquery.js"></script>
        <script src= "queryHandler.js"></script>
    </head>
    <?php
    include_once 'DBHandler.php';
    include_once 'Helper.php';
    $db = new DBHandler();
    $helper = new Helper();
    global $db;
    global $helper;
    $selected_table = isset($_REQUEST['selected_table']) ? $_REQUEST['selected_table'] : @$_REQUEST['table'];
    ?>
    <body>
        <div id="wrapper">
            <br>
            <span class="logo"><?= SITE_NAME ?></span><br><br>
            <form action="admin.php" id="query_form" method="post">
                <?php $db->get_tables_drop_down($selected_table); ?>
                <input type="submit" value="Get" alt="R" name="run" id="run"/>
            </form>
            <div id="res"><?php
                if (isset($_REQUEST['selected_table'])) {
                    include('admin/table_info.php');
                } else if (isset($_REQUEST['selected_column'])) {
                    include('admin/column_info.php');
                } else if (isset($_REQUEST['add_column'])) {
                    include('admin/add_column.php');
                } else if (isset($_REQUEST['submit_add_column'])) {
                    include('admin/add_column.php');
                    include('admin/table_info.php');
                } else if (isset($_REQUEST['record_edit'])) {
                    include('admin/editor.php');
                    include('admin/table_info.php');
                } else if (isset($_REQUEST['record_delete'])) {
                    include('admin/delete.php');
                    include('admin/table_info.php');
                } else if (isset($_REQUEST['column_edit'])) {
                    include('admin/column_editor.php');
                    include('admin/table_info.php');
                }
                ?></div><br/>
        </div>
    </body>
</html>