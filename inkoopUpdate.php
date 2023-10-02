<?php
require 'Inkooporders.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $inkOrdId = $_POST['inkOrdId'];
    $levId = $_POST['levId'];
    $artId = $_POST['artId'];
    $inkOrdDatum = $_POST['inkOrdDatum'];
    $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
    $inkOrdStatus = $_POST['inkOrdStatus'];

    //create new instance for the class
    $inkooporder = new Inkooporder();

    // Call the updateLeverancier method on the $lev object, passing in the form data as arguments
    $inkooporder->updateInkooporder($inkOrdId, $levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus);
}
?>