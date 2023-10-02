<?php
require 'Klant.php';
$klantPostcode = $_POST['klantPostcode'];
$klant1 = new Klant();
$klant1->searchKlant($klantPostcode);

?>