<?php
require 'leveranciers.php';
$levId = $_POST['levId'];
$lev1 = new Leveranciers();
$lev1->searchLeverancier($levId);
?>