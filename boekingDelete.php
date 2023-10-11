<?php

// Require the Chat class file
require 'Classes/Boeking.php';

// Check if the 'action' and 'chatId' parameters are set in the GET request
if(isset($_GET['action']) && isset($_GET['ID'])) {
    // Retrieve the chatId and boeking ID from the GET parameters
    $ID = $_GET['ID'];

    // Check if the 'action' parameter is set to 'delete'
    if($_GET['action'] == 'delete') {
        // Create a new score object
        $boeking = new Boeking();

        // Call the delete boeking method of the boeking object with the boeking ID and matchedUserId parameters
        $boeking->deleteBoeking($ID);
    }
}
