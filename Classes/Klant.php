<?php
//Lukas Sliva

class Klant {
    // properties
    protected $username;
    protected $email;
    protected $telefoon;
    protected $password;
    protected $changed;

    // constructor
    function __construct($username=NULL, $email=NULL, $telefoon=NULL, $password=NULL, $changed=NULL) {
        $this->username = $username;
        $this->email = $email;
        $this->telefoon = $telefoon;
        $this->password = $password;
        $this->changed = $changed;
    }

    // setters
    function set_username($username) {
        $this->username = $username;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function set_telefoon($telefoon) {
        $this->telefoon = $telefoon;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function set_changed($changed) {
        $this->changed = $changed;
    }

    // getters
    function get_username() {
        return $this->username;
    }
    function get_email() {
        return $this->email;
    }
    function get_telefoon() {
        return $this->telefoon;
    }
    function get_password() {
        return $this->password;
    }
    function get_changed() {
        return $this->changed;
    }


    
    //CRUD functies
    // Retrieves the userId from the database based on the provided email and stores it in a session variable
    public function getKlantIdSession($qqleq) {
        // echo 'Username: ' . $qqleq . '<br>';
        // echo '<br>';
        require_once 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT ID FROM klanten WHERE username = :username');
        $sql->bindParam(':username', $qqleq);
        // $sql->execute([":username" => $pusername]);
        $sql->execute();
        // Fetch the result of the query
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        // echo "<pre> Row: " . print_r($row, true) . "</pre>";

        if ($row) {
            return $row['ID'];
        } else {
            return null; // Return null when Klant ID is not found
        }
    }
    
    //create new klant
    public function createKlant() {
        require 'database/pureConnect.php';
        $klantNaam = $this->get_klantNaam();
        $klantEmail = $this->get_klantEmail();
        $klantAdres = $this->get_klantAdres();
        $klantPostcode = $this->get_klantPostcode();
        $klantWoonplaats = $this->get_klantWoonplaats();
    
        //statement maken voor invoer in de tabel
        $sql = $conn->prepare('INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)');
    
        //Variabelen in de statement zetten
        $sql->bindParam(':klantNaam', $klantNaam);
        $sql->bindParam(':klantEmail', $klantEmail);
        $sql->bindParam(':klantAdres', $klantAdres);
        $sql->bindParam(':klantPostcode', $klantPostcode);
        $sql->bindParam(':klantWoonplaats', $klantWoonplaats);
    
        $sql->execute();
    
        //melding
        $_SESSION['message'] = "Klant " . $klantNaam . " is toegevoegd! <br>";
        header("Location: klantRead.php");
        
    }

    //read klant and give delete/update buttons with the ID    
    public function readKlant($userId) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT username, email, telefoon FROM klanten where ID = :userId');
        $sql->bindParam(':userId', $userId);
        $sql->execute();
    
        foreach($sql as $klant) {
            $klantObject = new Klant($klant['username'], $klant['email'], $klant['telefoon'],);
            echo '<br>';
            echo '<div class="readList">';
            echo '<a href="klantDelete.php?action=delete&klantId=' . $userId . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this klant?\')">Delete</a>';            
            echo '<a href="klantUpdateForm.php?action=update&klantId=' . $userId . '"class="updateButton">Update</a>';
            
            // echo $klantObject->klantId . ' - ';
            echo $klantObject->username . ' - ';
            echo $klantObject->email . ' - ';
            echo $klantObject->telefoon . ' - ';
            echo '</div>';
            echo '<br>';
        }
  
    }

    //delete klant using klant ID
    public function deleteKlant($klantId) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('DELETE FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();
    
        //melding
        $_SESSION['message'] = 'Klant ' . $klantNaam . ' is verwijderd. <br>';
        header("Location: klantRead.php");
    }

    //find klant using klant Id for the update form
    public function findKlant($klantId) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM klanten WHERE ID = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();
    
        $klant = $sql->fetch();
        return $klant;
    }

        //Update klant using the klant ID
        public function updateKlant($klantId, $username, $email, $telefoon, $password ) {
            require 'database/pureConnect.php';
            $sql = $conn->prepare('UPDATE klanten SET username = :username, telefoon = :telefoon, email = :email, password = :password WHERE ID = :klantId');
            $sql->bindParam(':klantId', $klantId);
            $sql->bindParam(':username', $username);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':telefoon', $telefoon);
            $sql->bindParam(':password', $password);
            
            $sql->execute();
        
            $_SESSION['message'] = 'Gefeliciteerd ' . $username . ', uw account is succesvol bijgewerkt. <br>';
            header("Location: menuKlant");
        }

    //get the klant naam and ID for the option values for the verkoop order create/update
    // public function getKlanten() {
    //     require 'database/pureConnect.php';
    //     $sql = $conn->prepare('SELECT klantId, klantNaam FROM klanten');
    //     $sql->execute();

    //     $klanten = array();
    //     while ($row = $sql->fetch()) {
    //         $klanten[] = $row;
    //     }
    //     return $klanten;
    // }

    
     //get tocht omschrijving, aantal dagen using tochtId for the boeking read
     public function getKlantenWithId($id) {
        require 'database/pureConnect.php';
    
        $sql = $conn->prepare("SELECT username, email, telefoon FROM klanten WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $klant = $sql->fetch(PDO::FETCH_ASSOC);
        // var_dump($tocht);
        return $klant;
    }
    // Get the klanten ID, username, email, and telefoon for the option values in boeking create/update
    public function getKlanten() {
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare("SELECT ID, username, email, telefoon FROM klanten");
        $sql->execute();
        $klanten = array();
        while ($row = $sql->fetch()) {
            $klanten[] = $row;
        }
        return $klanten;    
    }

    // Get klant details using klant ID for the boeking read
    public function getKlantWithId($id) {
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare("SELECT username, email, telefoon FROM klanten WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $klant = $sql->fetch(PDO::FETCH_ASSOC);
        return $klant;
    }
}

?>