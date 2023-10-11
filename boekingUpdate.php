<?php
// Include the Artikel.php file, which contains the Artikel class
require 'Classes/Boeking.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $ID = $_POST['ID'];
    $StartDatum = $_POST['StartDatum'];
    $FKtochtenID = $_POST['FKtochtenID'];

    // Create a new instance of the class
    $Boeking = new Boeking();

    // Call the update method on the object, passing in the form data as arguments
    $Boeking->updateBoeking($ID, $StartDatum, $FKtochtenID);
}
?>
