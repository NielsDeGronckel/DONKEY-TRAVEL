<?php
require_once 'Classes/Table.php';
//delete for all tables for the generator
if (isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['tbl']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $table = $_GET['tbl'];
    $primaryKey = $_GET['id'];

    $deleteAdminTable = new Table();
    $deleteAdminTable->tableDelete($table, $primaryKey);

} else {
    echo "Invalid request.";
}
?>
