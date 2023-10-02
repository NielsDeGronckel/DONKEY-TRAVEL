<?php
require 'Leveranciers.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $levId = $_POST['levId'];
    $levNaam = $_POST['levNaam'];
    $levContact = $_POST['levContact'];
    $levEmail = $_POST['levEmail'];
    $levAdres = $_POST['levAdres'];
    $levPostcode = $_POST['levPostcode'];
    $levWoonplaats = $_POST['levWoonplaats'];

    //create new instance for the class
    $lev = new Leveranciers();

    // Call the updateLeverancier method on the $lev object, passing in the form data as arguments
    $lev->updateLeverancier($levId, $levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
}
?>