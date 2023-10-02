<?php

require 'Artikel.php';
if(isset($_GET['action']) && isset($_GET['artId'])) {
    $artId = $_GET['artId'];
    if($_GET['action'] == 'delete') {
        // call the deleteart function here with the $artId parameter
        $art = new Artikel();
        $art->deleteArt($artId);
    }
}
?>