<?php
require 'Classes/Boeking.php';

if (isset($_POST['create'])) {

    // Get the submitted form data
    $StartDatum = $_POST['datepicker'];
    $FKtochtenID = $_POST['tochtId'];
    $FKklantID = $_POST['klantId'];



    $boeking1 = new Boeking();
    $boeking1->createBoeking($StartDatum, $FKtochtenID, $FKklantID);

   
}
    ?> 