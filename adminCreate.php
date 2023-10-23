<?php 
require 'Classes/Table.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table_name = $_POST['table_name'];
    $column_names = explode(',', $_POST['column_names']);
    
    // Construct the SQL query to insert data
    $createTable = new Table();
    $createTable->tableCreate($table_name, $column_names);
}


?>