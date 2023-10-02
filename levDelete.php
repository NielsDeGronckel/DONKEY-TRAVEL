<?php
require 'Leveranciers.php';
if(isset($_GET['action']) && isset($_GET['levId'])) {
    $levId = $_GET['levId'];
    if($_GET['action'] == 'delete') {
        // call the deleteKlant function here with the $klantId parameter
        $lev = new Leveranciers();
        $lev->deleteLeverancier($levId);
    }

}
?>