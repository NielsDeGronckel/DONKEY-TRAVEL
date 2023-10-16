<?php

//class to automatically show any database table for admins
class Table {

    //methoden -functies
    // constructor
    function __construct() {

    }

    //create new row for generator table
    public function tableCreate($table_name, $column_names) {
        require 'database/pureConnect.php';

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

    //read for the generator
    public function tableRead($tabelnaam) {
        require 'database/pureConnect.php';
     $numberOfFields = <<<EOT
     SELECT count(*)
     FROM information_schema.columns
     WHERE table_schema = 'donkey'  
     AND table_name = '$tabelnaam'
     EOT;
 
     $aantalVelden = $conn->query($numberOfFields)->fetchColumn();
     
     $def = $conn->query("DESCRIBE $tabelnaam");
 
     $s = "<h1>Table: $tabelnaam</h1>";
     $s .= '<div class="parentTable">';
     $s .= '<div class="arrowContainer">';
     $s .= '<a href="#top"><i class="bx bxs-chevrons-up"></i></a>';
     $s .= '<td class="inputId"><button id="add-row-button"><i class="bx bx-plus-circle"></i></button></td>';
 
     $s .= '<a href="#bottom"><i class="bx bxs-chevrons-down"></i></a>';
     $s .= '</div>'; //close arrowContainer
 
 
     // Initialize an array to store maximum column widths based on data type
     $columnWidths = array_fill(0, $aantalVelden, 0);
      $def = $conn->query("DESCRIBE $tabelnaam");
      $s .= '<div class="tableContainer">';
     //  $s .= '<form id="create-row-form" action="adminCreate.php" method="post">';
 
      $s .= "<table border='1'><tr>";
      while ($row = $def->fetch(PDO::FETCH_OBJ)) {
         $columnName = $row->Field;
         $columnNames[] = $columnName; // Store column names in the array
         $s .= "<th>$columnName</th>";
     }
     $s .= "<th>CMD</th>";
     $s .= "</tr>";
     
 
     $s .= '<span id="top"></span>';
     $s .= "<tr id='trDisplay'>";
 
     $s .= '<input type="hidden" name="table_name" value="' . $tabelnaam . '">
     <input type="hidden" name="column_names" value="' . implode(",", $columnNames) . '"> ';
 
     $s .= '<td class="inputId"><span id="add-row-button"><i class="bx bx-list-plus"></i></span></td>';
     // $s .= '<form id="create-row-form">';
     foreach ($columnNames as $key => $columnName) {
         // Skip the first column (primary key)
         if ($key > 0) {
         $s .= '<td class="inputId"><input type="text" name="' . $columnName . '" placeholder="' . $columnName . '"></td>';
         }
         // $s .= '<td><div class="inputField" contenteditable="true" name="' . $columnName . '" placeholder="' . $columnName . '"></div></td>';
     }
     // $s .= '<td class="inputId"><div class="submitTable"><input type="submit" value="Submit"><button id="cancel-create-row">Cancel</button></div></td>';
     $s .= '<td class="inputId"><div class="submitTable"><button type="button" class="greenButton" onclick="createRow(this)">Submit</button><button id="cancel-create-row"><i class="bx bx-minus-circle"></i></button></div></td>';
 
     
 
     $s .= "</tr>";  
    
 
     $def = $conn->query("SELECT * FROM $tabelnaam");
 
 
     while ($row = $def->fetch(PDO::FETCH_NUM)) {
         for ($teller = 0; $teller < $aantalVelden; $teller++) {
             $row[$teller] = $row[$teller] ? $row[$teller] : '-'; // Use '-' when value is empty
         // $columnId = $columnName[0];
         $s .= "<td>
         <button id='$row[$teller]' onclick='editCell({$row[0]}, \"$columnNames[$teller]\", \"$tabelnaam\",\"$columnNames[0]\")' class='editButton' data-columnname='$columnNames[$teller]' data-tablename='$tabelnaam' data-tableid='$columnNames[0]'>
         <span id='cell-{$row[0]}-$columnNames[$teller]'>$row[$teller]</span></button>
     </td>";
         }
         $s .= '<td><a href="delete.php?action=delete&tbl=' . $tabelnaam . '&id=' . $row[0] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this row?\')"><i class="bx bxs-trash"></i></a></td>';
         $s .= "</tr>";  
     }
 
    
   
     $s .= "</table>";
     // $s .= "</form>";  
 
 
     $s .= '<span id="bottom"></span>';
 
     $s .= '</div>'; //table container end div
 
    
     $s .= '</div>'; // Close the parentTable container
     // $s .= '<span id="bottom"></span>';
 
     $s .= '</div>';
     return $s;
     
 }

    //Update the table
    public function tableUpdate( $rowId, $fieldName, $tableName, $updatedText, $tableId) {
        require 'database/pureConnect.php';

        if ($fieldName === 'password' || $fieldName === 'wachtwoord') {
            $updatedText = password_hash($updatedText, PASSWORD_DEFAULT);
        }

        // Construct and execute an SQL query to update the cell content
        $updateQuery = "UPDATE $tableName SET $fieldName = :updatedText WHERE $tableId = :rowId";
        
        try {
            // Prepare and execute the update query
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(":updatedText", $updatedText, PDO::PARAM_STR);
            $stmt->bindParam(":rowId", $rowId, PDO::PARAM_INT);
            $stmt->execute();

            // Send a response to indicate success
            $_SESSION['message'] =  "Cell updated successfully";
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
        }
    }

    // delete the table
    public function tableDelete($table, $primaryKey) {
        require 'database/pureConnect.php';

        try {
            // Identify foreign key constraints for the specified table
            $foreignKeysQuery = "SELECT table_name, column_name
                                 FROM information_schema.key_column_usage
                                 WHERE referenced_table_name = :table";
            
            $stmt = $conn->prepare($foreignKeysQuery);
            $stmt->bindParam(":table", $table, PDO::PARAM_STR);
            $stmt->execute();
    
            $relatedTables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Delete related records in child tables
            foreach ($relatedTables as $relatedTable) {
                $childTable = $relatedTable['table_name'];
                $foreignKeyColumn = $relatedTable['column_name'];
    
                $deleteChildQuery = "DELETE FROM $childTable WHERE $foreignKeyColumn = :id";
                $stmt = $conn->prepare($deleteChildQuery);
                $stmt->bindParam(":id", $primaryKey, PDO::PARAM_INT);
                $stmt->execute();
            }
    
            // Delete the parent record
            $primaryKeyQuery = "SELECT column_name
                                FROM information_schema.columns
                                WHERE table_name = :table
                                  AND column_key = 'PRI'
                                LIMIT 1";
    
            $stmt = $conn->prepare($primaryKeyQuery);
            $stmt->bindParam(":table", $table, PDO::PARAM_STR);
            $stmt->execute();
    
            $primaryKeyRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($primaryKeyRow) {
                $primaryKeyColumn = $primaryKeyRow['column_name'];
    
                $deleteQuery = "DELETE FROM $table WHERE $primaryKeyColumn = :id";
                $stmt = $conn->prepare($deleteQuery);
                $stmt->bindParam(":id", $primaryKey, PDO::PARAM_INT);
                $stmt->execute();
    
                $_SESSION['message'] = 'Row deleted successfully.';
                $Table = ucfirst($table);
                $filename = "adminTable" . $Table . ".php";
                header("Location: " . $filename);
            } else {
                echo "Table does not have a primary key.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>