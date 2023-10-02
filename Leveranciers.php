<?php

class Leveranciers
{
    //properties
    protected $levNaam;
    protected $levContact;
    protected $levEmail;
    protected $levAdres;
    protected $levPostcode;
    protected $levWoonplaats;

    //methoden -functies
    // constructor
    function __construct($levNaam=NULL, $levContact=NULL, $levEmail=NULL, $levAdres=NULL, $levPostcode=NULL, $levWoonplaats=NULL)
    {
        $this->levNaam = $levNaam;
        $this->levContact = $levContact;
        $this->levEmail = $levEmail;
        $this->levAdres = $levAdres;
        $this->levPostcode = $levPostcode;
        $this->levWoonplaats = $levWoonplaats;
    }

    // setters
    function set_levNaam($levNaam)
    {
        $this->levNaam = $levNaam;
    }

    function set_levContact($levContact)
    {
        $this->levContact = $levContact;
    }

    function set_levEmail($levEmail)
    {
        $this->levEmail = $levEmail;
    }

    function set_levAdres($levAdres)
    {
        $this->levAdres = $levAdres;
    }

    function set_levPostcode($levPostcode)
    {
        $this->levPostcode = $levPostcode;
    }

    function set_levWoonplaats($levWoonplaats)
    {
        $this->levWoonplaats = $levWoonplaats;
    }

    // getter
    function get_levNaam()
    {
        return $this->levNaam;
    }

    function get_levContact()
    {
        return $this->levContact;
    }

    function get_levEmail()
    {
        return $this->levEmail;
    }

    function get_levAdres()
    {
        return $this->levAdres;
    }

    function get_levPostcode()
    {
        return $this->levPostcode;
    }

    function get_levWoonplaats()
    {
        return $this->levWoonplaats;
    }

  
//CRUD functies

    //create leveranciers
    public function createLeverancier()
    {
        require 'database.php';
        $levNaam = $this->get_levNaam();
        $levContact = $this->get_levContact();
        $levEmail = $this->get_levEmail();
        $levAdres = $this->get_levAdres();
        $levPostcode = $this->get_levPostcode();
        $levWoonplaats = $this->get_levWoonplaats();

        //statement maken voor invoer in de tabel
        $sql = $conn->prepare('INSERT INTO leveranciers (levNaam, levContact, levEmail, levAdres, levPostcode, levWoonplaats) VALUES (:levNaam, :levContact, :levEmail, :levAdres, :levPostcode, :levWoonplaats)');

        //Variabelen in de statement zetten
        $sql->bindParam(':levNaam', $levNaam);
        $sql->bindParam(':levContact', $levContact);
        $sql->bindParam(':levEmail', $levEmail);
        $sql->bindParam(':levAdres', $levAdres);
        $sql->bindParam(':levPostcode', $levPostcode);
        $sql->bindParam(':levWoonplaats', $levWoonplaats);

        $sql->execute();

        //melding
        $_SESSION['message'] = "Leverancier " . $levNaam . " is toegevoegd <br>";
        header("Location: levRead.php");
    }

    //read leveranciers and give delete/update buttons with the ID    
    public function readLeveranciers() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM Leveranciers');
        $sql->execute();

        foreach($sql as $lev) {
            $levObject = new Leveranciers($lev['levNaam'], $lev['levContact'], $lev['levEmail'], $lev['levAdres'], $lev['levPostcode'], $lev['levWoonplaats']);
            echo '<br>';
            echo '<div class="readList">';
            echo '<a href="levDelete.php?action=delete&levId=' . $lev['levId'] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this lev?\')">Delete</a>';
            echo '<a href="levUpdateForm.php?action=update&levId=' . $lev['levId'] . '"class="updateButton">Update</a>';

            // echo $levObject->levId . ' - ';
            echo $levObject->levNaam . ' - ';
            echo $levObject->levContact . ' - ';
            echo $levObject->levEmail . ' - ';
            echo $levObject->levAdres . ' - ';
            echo $levObject->levPostcode . ' - ';
            echo $levObject->levWoonplaats . ' - ';
            echo '</div>';
            echo '<br>';
        }

    }

    //delete leveranciers using leveranciers ID
    public function deleteLeverancier($levId) {
        require 'database.php';
        $sql = $conn->prepare('DELETE FROM leveranciers WHERE levId = :levId');
        $sql->bindParam(':levId', $levId);
        $sql->execute();
    
        //melding
        $_SESSION['message'] = 'Leverancier ' . $levId . ' is verwijderd. <br>';
        header("Location: levRead.php");
    }
    
    //find leverancier using leverancier Id for the update form
    public function findLeverancier($levId) {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM leveranciers WHERE levId = :levId');
        $sql->bindParam(':levId', $levId);
        $sql->execute();
    
        $leverancier = $sql->fetch();
        return $leverancier;
    }

    //get the leverancier name and ID for the option values in verkoop order create/update
    public function getLeveranciers() {
        require 'pureConnect.php';

        $sql = $conn->prepare("SELECT levId, levNaam FROM leveranciers");
        $sql->execute();
        $leveranciers = array();
        while ($row = $sql->fetch()) {
            $leveranciers[] = $row;
        }
        return $leveranciers;
    }
    

    //search leverancier using leverancier ID
    public function searchLeverancier($levId) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM leveranciers WHERE levId = :levId');
        $sql->bindParam(':levId', $levId);
        $sql->execute();
    
        $leverancier = $sql->fetch();
        if ($leverancier) {
            $result = array();
            $result['levNaam'] = $leverancier['levNaam'];
            $result['levContact'] = $leverancier['levContact'];
            $result['levEmail'] = $leverancier['levEmail'];
            $result['levAdres'] = $leverancier['levAdres'];
            $result['levPostcode'] = $leverancier['levPostcode'];
            $result['levWoonplaats'] = $leverancier['levWoonplaats'];
            $_SESSION['result'] = $result;
            header("Location: levRead.php");
            exit;
    
        } else {
            header("Location: levRead.php");
            $_SESSION['searchMsg'] = "No result found for this Postcode.";
    
        }
    
    }

    //search leverancier using leverancier naam
    public function searchLeverancierNaam($levNaam) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM leveranciers WHERE levNaam = :levNaam');
        $sql->bindParam(':levNaam', $levNaam);
        $sql->execute();
    
        $leverancier = $sql->fetch();
        if ($leverancier) {
            $result = array();
            $result['levNaam'] = $leverancier['levNaam'];
            $result['levContact'] = $leverancier['levContact'];
            $result['levEmail'] = $leverancier['levEmail'];
            $result['levAdres'] = $leverancier['levAdres'];
            $result['levPostcode'] = $leverancier['levPostcode'];
            $result['levWoonplaats'] = $leverancier['levWoonplaats'];
            $_SESSION['result'] = $result;
            header("Location: levRead.php");
            exit;
    
        } else {
            header("Location: levRead.php");
            $_SESSION['searchMsg'] = "No result found for this name.";
    
        }
    
    }

    //Update leverancier using the leverancier ID
    public function updateLeverancier($levId, $levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        require 'database.php';
        $sql = $conn->prepare('UPDATE leveranciers SET levNaam = :levNaam, levContact = :levContact, levEmail = :levEmail, levAdres = :levAdres, levPostcode = :levPostcode, levWoonplaats = :levWoonplaats WHERE levId = :levId');
        $sql->bindParam(':levId', $levId);
        $sql->bindParam(':levNaam', $levNaam);
        $sql->bindParam(':levContact', $levContact);
        $sql->bindParam(':levEmail', $levEmail);
        $sql->bindParam(':levAdres', $levAdres);
        $sql->bindParam(':levPostcode', $levPostcode);
        $sql->bindParam(':levWoonplaats', $levWoonplaats);
    
        $sql->execute();
    
        $_SESSION['message'] = 'Leverancier ' . $levNaam . ' is bijgewerkt <br>';
        header("Location: levRead.php");
    }
}


?>