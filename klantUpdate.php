<?php
require 'Klant.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $klantId = $_POST['klantId'];
    $klantNaam = $_POST['klantNaam'];
    $klantEmail = $_POST['klantEmail'];
    $klantAdres = $_POST['klantAdres'];
    $klantPostcode = $_POST['klantPostcode'];
    $klantWoonplaats = $_POST['klantWoonplaats'];

    //create new instance for the class
    $klant = new Klant();
    
    // Call the updateLeverancier method on the $lev object, passing in the form data as arguments
    $klant->updateKlant($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats);
}
?>