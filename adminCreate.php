<?php 
require 'database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table_name = $_POST['table_name'];
    $column_names = explode(',', $_POST['column_names']);
    
    // Construct the SQL query to insert data
    $insert_values = [];
    foreach ($column_names as $column) {
        $value = isset($_POST[$column]) ? $_POST[$column] : null;
        
        // Check if the column name contains 'password'
        if (strpos($column, 'password') !== false) {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $insert_values[] = $value;
    }

    // Create the SQL query dynamically
    $sql = "INSERT INTO $table_name (" . implode(', ', $column_names) . ") VALUES (" . rtrim(str_repeat('?, ', count($column_names)), ', ') . ")";
        
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($insert_values);
        $_SESSION['message'] =  "Data inserted successfully";
        $Table = ucfirst($table_name);
        $filename = "adminTable" . $Table;
        header("Location: " . $filename . "#bottom");    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>