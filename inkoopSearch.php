<?php
require 'Inkooporders.php';
$inkOrdId = $_POST['inkOrdId'];
$inkOrd1 = new Inkooporder();
$inkOrd1->searchInkooporder($inkOrdId);

?>