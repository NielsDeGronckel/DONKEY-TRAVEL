<?php
require 'Verkooporders.php';

if (isset($_POST['verkoopCreate'])) {

    // Get the submitted form data
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    // If all validation checks pass, insert the new user into the database
    $verkoop1 = new Verkooporders($klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus);
    $verkoop1->createVerkooporders();

}
?>