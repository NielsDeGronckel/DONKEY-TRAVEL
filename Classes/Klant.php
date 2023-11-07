<?php
//Lukas Sliva

class Klant {
    // properties
    protected $ID;
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
        // Check if the username is already taken
        $check_username = $conn->prepare("SELECT * FROM klanten WHERE username=:username");
        $check_username->bindParam(':username', $username);
        $check_username->execute();
        if ($check_username->rowCount() > 0) {
            $_SESSION['message'] = "<p class='messageRed'>Sorry, that username is already taken.</p>";
            header("Location: registerForm.php");
        }

        // Check if the email is already in use
        $check_email = $conn->prepare("SELECT * FROM klanten WHERE email=:email");
        $check_email->bindParam(':email', $email);
        $check_email->execute();
        if ($check_email->rowCount() > 0) {
            $_SESSION['message'] = '<p class="messageRed">Sorry, that email is already in use.';
            header("Location: registerForm.php");
        }

        // Check if the password and confirm password fields match
        if ($password != $confirm_password) {
            $_SESSION['message'] = '<p class="messageRed">Sorry, the passwords do not match</p>';
            header("Location: registerForm.php");    }

        // check if there is any inapropriate word in the username or the email
        $inapropriate_words = array("slet", "cancer", "homo", "gay", "kont", "bil", "ass", "booty", "neuk", "auti", "autist", "flikker", "dildo", "kkr", "lukas", "fuck", "hell","crap", "damn", "ass", "hoe", "hoer", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch");
        foreach($inapropriate_words as $word){
            if (strpos($username, $word) !== false || strpos($email, $word) !== false) {
                $_SESSION['message'] = '<p class="messageRed">Sorry, inapropriate word found in username or email.</p>';
                header("Location: registerForm.php");
            }
        }
        //check if character contains special characters
        if (!preg_match('/^[a-zA-Z0-9]*$/', $username) || preg_match('/[!@#$%^&*()+{}\[\]:;<>,.?~\\]/', $username)) {
            $_SESSION['message'] = '<p class="messageRed">No special characters allowed.</p>';
                header("Location: registerForm.php");
            }
        // If all validation checks pass, insert the new user into the database
        if ($check_username->rowCount() == 0 && $check_email->rowCount() == 0 && $password == $confirm_password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = $conn->prepare("INSERT INTO klanten (username, email, password, telefoon) VALUES (:username, :email, :password, :telefoon)");
            $query->bindParam(':username', $username);
            $query->bindParam(':email', $email);
            $query->bindParam(':telefoon', $telefoon);
            $query->bindParam(':password', $password);
            $query->execute();
            if ($query->rowCount() > 0) {
                $_SESSION['message'] = '<p class="messageGreen">Account created successfully!</p>';

                header("Location: loginForm.php");
            } else {
                $_SESSION['message'] = '<p class="messageRed">An error occurred while creating your account.</p>';

                header("Location: loginForm.php");
            }
        }        
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
            echo '<a href="klantUpdateForm.php?action=update&GETklantId=' . $userId . '"class="updateButton">Update</a>';
            
            // echo $klantObject->klantId . ' - ';
            echo $klantObject->username . ' - ';
            echo $klantObject->email . ' - ';
            echo $klantObject->telefoon;
            echo '</div>';
            echo '<br>';
        }
  
    }

    //read klant info for management system
    public function readKlantManagement() {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT ID, username, email, telefoon, changed FROM klanten');
        $sql->execute();
    
        echo '<table class="table-auto" border="1">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Username</th>';
        echo '<th>Email</th>';
        echo '<th>Telefoon</th>';
        echo '</tr>';
    
        foreach ($sql as $klant) {
            $klantObject = new Klant($klant['ID'], $klant['username'], $klant['email'], $klant['telefoon'], $klant['changed']);
            echo '<tr>';
            echo '<td>' . $klantObject->username . '</td>';
            echo '<td>' . $klantObject->email . '</td>';
            echo '<td>' . $klantObject->telefoon . '</td>';
            echo '<td>' . $klantObject->changed . '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    }
    

    //delete klant using klant ID
public function deleteKlant($klantId) {
    require 'database/pureConnect.php'; // Make sure this file establishes a database connection

    // Delete from Boekingen table
    $sql = $conn->prepare('DELETE FROM Boekingen WHERE FKkLantenID = :klantId');
    $sql->bindParam(':klantId', $klantId);
    $success2 = $sql->execute();

   
    // Delete from klanten table
    $sql = $conn->prepare('DELETE FROM klanten WHERE ID = :klantId');
    $sql->bindParam(':klantId', $klantId);
    $success1 = $sql->execute();

    
    // Check if both deletions were successful
    if ($success1 && $success2) {
        // Deletion was successful, so remove the session if it exists
        session_start();
        if (isset($_SESSION)) {
            session_destroy();
        }

        // Melding
        $message = 'Uw account is succesvol verwijderd! ';
        header("Location: loginForm?message=" . urlencode($message));
    } else {
        // Deletion failed, handle the error or show an appropriate message
        $message = 'Er is een fout opgetreden bij het verwijderen van uw account.';
        header("Location: menuKlant?message=" . urlencode($message));
    }
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
        public function updateKlant($klantId, $usernameKlant, $email, $telefoon, $passwordKlant) {
            require 'database/pureConnect.php';
            if (!empty($passwordKlant)) {
            $passwordKlant = rtrim($passwordKlant);
            $passwordKlant = password_hash($passwordKlant, PASSWORD_DEFAULT);
            }
            $sql = $conn->prepare('UPDATE klanten SET username = :usernameKlant, telefoon = :telefoon, email = :email' . (!empty($passwordKlant) ? ', password = :passwordKlant' : '') . ' WHERE ID = :klantId');
            $sql->bindParam(':klantId', $klantId);
            $sql->bindParam(':usernameKlant', $usernameKlant);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':telefoon', $telefoon);
            if (!empty($passwordKlant)) {
                $sql->bindParam(':passwordKlant', $passwordKlant);
            }

            $sql->execute();

            $_SESSION['message'] = 'Gefeliciteerd ' . $usernameKlant . ', uw account is succesvol bijgewerkt. <br>';
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