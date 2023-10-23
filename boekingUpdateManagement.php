<?php
require 'Classes/Boeking.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $ID = $_POST['ID'];
    $StartDatum = $_POST['StartDatum'];
    $FKstatussenID = $_POST['FKstatussenID'];
    $FKklantenID = $_POST['FKklantenID'];
    $FKtochtenID = $_POST['FKtochtenID'];

    // Perform the database update
    $boeking = new Boeking();
    $boeking->updateBoekingManagement($ID, $StartDatum, $FKstatussenID, $FKklantenID, $FKtochtenID);

    // Redirect back to the management page or wherever you want
    exit();
} else {
    // If the request is not a POST request, handle it accordingly, e.g., show an error message.
    echo "Invalid request.";
}
