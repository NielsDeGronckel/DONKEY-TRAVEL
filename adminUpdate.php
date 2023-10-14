<?php

require_once 'Classes/Table.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the AJAX request
    $rowId = $_POST['rowId'];
    $fieldName = $_POST['fieldName'];
    $tableName = $_POST['tableName'];
    $updatedText = $_POST['updatedText'];
    $tableId = $_POST['tableId'];

    $updateAdminTable = new Table();
    $updateAdminTable->tableUpdate( $rowId, $fieldName, $tableName, $updatedText, $tableId);

} else {
    // Handle invalid requests
    echo "Invalid request method";
}
?>
