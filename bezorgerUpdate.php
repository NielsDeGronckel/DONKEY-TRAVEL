<?php
require 'Verkooporders.php';
$klantId = $_GET['klantId'];

// $klantId = $_POST['klantId'];
$verkooporder = new Verkooporders();
$verkooporder->updateBezorger($klantId);

?>