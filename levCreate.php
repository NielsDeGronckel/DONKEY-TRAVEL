<?php
require 'Leveranciers.php';

if (isset($_POST['register'])) {

    // Get the submitted form data
    $levNaam = $_POST['levNaam'];
    $levContact = $_POST['levContact'];
    $levEmail = $_POST['levEmail'];
    $levAdres = $_POST['levAdres'];
    $levPostcode = $_POST['levPostcode'];
    $levWoonplaats = $_POST['levWoonplaats'];

    // check if there is any inapropriate word in the username or the email
    $inapropriate_words = array("fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch");
    foreach($inapropriate_words as $word){
        if (strpos($levNaam, $word) !== false || strpos($levEmail, $word) !== false) {
            echo "Sorry, inapropriate word found.";

        }
    }

    // If all validation checks pass, insert the new user into the database
    $lev1 = new Leveranciers($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
    $lev1->createLeverancier();

}
?>