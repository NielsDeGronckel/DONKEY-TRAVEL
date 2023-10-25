<?php
require 'Classes/Klant.php';
if(isset($_GET['action']) && isset($_GET['klantId'])) {
    $klantId = $_GET['klantId'];
    if($_GET['action'] == 'delete') {
        // call the deleteKlant function here with the $klantId parameter
        $klant = new Klant();
        $klant->deleteKlant($klantId);
    } 

}
?>