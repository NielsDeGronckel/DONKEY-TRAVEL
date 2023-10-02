<?php
require 'Verkooporders.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verkOrdId = $_POST['verkOrdId'];
    $klantId = $_POST['klantId'];
    $artId = $_POST['artId'];
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];

    $verkooporder = new Verkooporders();
    $verkooporder->updateVerkooporder($verkOrdId, $klantId, $artId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus);
}
?>
