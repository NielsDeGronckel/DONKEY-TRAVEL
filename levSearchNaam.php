<?php
require 'leveranciers.php';
$levNaam = $_POST['levNaam'];
$lev1 = new Leveranciers();
$lev1->searchLeverancierNaam($levNaam);
?>