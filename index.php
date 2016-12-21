<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Query Editor</title>
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
            <form action="index.php" id="query_form" method="post">
                <?php $db->get_tables_drop_down($selected_table); ?>
                <input type="submit" value="Get" alt="R" name="run" id="run"/>
            </form>
            <div id="res"><?php
                if (isset($_REQUEST['selected_table'])) {
                    include('common/table_info.php');
                } else if (isset($_REQUEST['add_record'])) {
                    include('common/add_record.php');
                } else if (isset($_REQUEST['submit_add_record'])) {
                    include('common/add_record.php');
                    include('common/table_info.php');
                } else if (isset($_REQUEST['record_edit'])) {
                    include('common/editor.php');
                    include('common/table_info.php');
                } else if (isset($_REQUEST['record_delete'])) {
                    include('common/delete.php');
                    include('common/table_info.php');
                }
                ?></div><br/>
            <input type="submit" value="SHOW" alt="h" id="hideshow" onclick="chageDisplay('functions', 'hideshow');">
            <div id="functions" style="display: none;">
                <form action="index.php" id="query_form" method="post">
                    <textarea id="q" class="s_query" name="q" placeholder="Your query here..."><?php echo isset($_REQUEST['q']) ? $_REQUEST['q'] : 'select * from table'; ?></textarea><br/>
                    <input type="submit" value="RUN" alt="R" id="run"/>
                </form>
                <div id="res"><?php
                if (isset($_REQUEST['q'])) {
                    include('Query.php');
                }
                ?></div><br/>
                    <?php include('availableFunctions.php'); ?>
            </div>
        </div>
    </body>
</html>