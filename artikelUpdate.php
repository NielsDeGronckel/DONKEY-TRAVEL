<?php
// Include the Artikel.php file, which contains the Artikel class
require 'Artikel.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $artId = $_POST['artId'];
    $artOmschrijving = $_POST['artOmschrijving'];
    $artInkoop = $_POST['artInkoop'];
    $artVerkoop = $_POST['artVerkoop'];
    $artVoorraad = $_POST['artVoorraad'];
    $artMinVoorraad = $_POST['artMinVoorraad'];
    $artMaxVoorraad = $_POST['artMaxVoorraad'];
    $artLocatie = $_POST['artLocatie'];
    $levId = $_POST['levId'];

    // Create a new instance of the Artikel class
    $Artikel = new Artikel();

    // Call the updateArt method on the $Artikel object, passing in the form data as arguments
    $Artikel->updateArt(
        $artId,
        $artOmschrijving,
        $artInkoop,
        $artVerkoop,
        $artVoorraad,
        $artMinVoorraad,
        $artMaxVoorraad,
        $artLocatie,
        $levId
    );
}
?>
