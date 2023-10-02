

<?php
require 'Verkooporders.php';
$klantId = $_POST['klantId'];


$verkooporder1 = new Verkooporders();
$verkooporder1->searchBezorger2($klantId);


?>