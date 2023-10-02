<?php

require 'Inkooporders.php';
if(isset($_GET['action']) && isset($_GET['inkOrdId'])) {
    $inkOrdId = $_GET['inkOrdId'];
    if($_GET['action'] == 'delete') {
        // call the delete function here with the $klantId parameter
        $inkOrd = new Inkooporder();
        $inkOrd->deleteInkooporder($inkOrdId);
    } 

}
?>