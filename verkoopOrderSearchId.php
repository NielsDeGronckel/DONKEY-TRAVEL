<?php
require 'Verkooporders.php';
$verkOrdId = $_POST['verkOrdId'];
$verkooporder = new Verkooporders();
$verkooporder->searchVerkooporder($verkOrdId);

?>