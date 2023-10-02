<?php
require 'Klant.php';
$klantId = $_POST['klantId'];
$klant1 = new Klant();
$klant1->searchBezorger($klantId);

?>