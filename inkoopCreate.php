<?php
require 'Inkooporders.php';

if (isset($_POST['inkoopCreate'])) {

    // Get the submitted form data
    $levId = $_POST['levId'];
    $artId = $_POST['artId'];
    $inkOrdDatum = $_POST['inkOrdDatum'];
    $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
    $inkOrdStatus = boolval($_POST['inkOrdStatus']);
    // $inkOrdStatus = boolval($_POST['myBoolean']);


    // If all validation checks pass, insert the new Inkooporder into the database
    $inkooporder1 = new Inkooporder();
    $inkooporder1->createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus);


}
?>
