<?php 

require_once("database.php");

if(isset($_POST['submit'])) {
    // Get the input value for artikelid
    $artId = $_POST['artId'];

    // Prepare the SQL statement
    $sql = "SELECT * FROM artikelen WHERE artId = '$artId'";


    // Execute the SQL statement and store the result in a variable
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Loop through each row and print the data
        while($row = $result->fetch_assoc()) {
            $levid = $row["levId"];            
            $inkoopdatum = date('Y-m-d');            
            $sql = "INSERT INTO inkooporders (artid, levid, inkoopdatum) VALUES ('$artId', '$levid', '$inkoopdatum')";
            echo "Artikel ID: " . $row["artId"]. " - artOmschrijving: " . 
            $row["artOmschrijving"]. " - artInkoop: " . $row["artInkoop"]." - artVerkoop: " . 
            $row["artVerkoop"]. "- artVoorraad: " . $row["artVoorraad"]. " - artVerkoop: " . 
            $row["artVerkoop"]. "- artVoorraad: " . $row["artVoorraad"]. " - artMinVoorraad: " . 
            $row["artMinVoorraad"]. "- artMaxVoorraad: " . $row["artMaxVoorraad"]. " - artLocatie: " . 
            $row["artLocatie"]. "- levId: " . $row["levId"]."<br>";
        }
    } else {
        echo "Geen resultaten gevonden.";
    }
}

// Close the database connection
$conn->close();