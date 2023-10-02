<?php
require 'Artikel.php';
$artId = $_POST['artId'];
$artikel1 = new Artikel();
$artikel1->searchArt($artId);

?>