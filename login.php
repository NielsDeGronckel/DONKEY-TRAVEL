<?php
require 'database/database.php';
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['usernamePost'] = $_POST['username'];
$_SESSION['passwordPost'] = $_POST['password'];

try {
    // Set PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM klanten WHERE username = :username");
    $stmt->bindParam(':username', $username);

    // Execute statement
    $stmt->execute();

    // Fetch all rows
    $results = $stmt->fetch();

    if (!empty($results)) {
        $hashed_password = $results['password'];

        // var_dump($hashed_password);
    
        if (password_verify($password, $hashed_password)) {
            // $username = 'rando';
            $_SESSION['username'] = $username;
            require_once 'Classes/Klant.php';
            
            $klantIdSession = new Klant();
            $klantId = $klantIdSession->getKlantIdSession($_SESSION['username']);
            // echo "<pre> test " . print_r($klantId, true) . "</pre>";
            if ($klantId !== null) {
                $_SESSION['klantId'] = $klantId;
                // echo 'Test::::', $_SESSION['klantId'];
            } else {
                echo 'Error: Klant ID not found';
            }
            header("Location: account");

        } else {
            $_SESSION['message'] = 'Invalid log in credentials. Please try again.';
            header("Location: loginForm");
        }
    } else {
        $_SESSION['message'] = "Account doesn't exist. Please try again.";
        header("Location: loginForm");
    }
    // var_dump($_SESSION['message']);
} catch (PDOException $e) {
    // Handle any PDO exceptions here, e.g., log or display the error
    echo 'PDO Exception: ' . $e->getMessage();
} catch (Exception $e) {
    // Handle any other exceptions here, e.g., log or display the error
    echo 'Exception: ' . $e->getMessage();
}
?>
