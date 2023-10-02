<?php
require 'database.php';
$username = $_POST['username'];
$password = $_POST['password'];


    // Set PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM medewerkers WHERE username = :username");
    $stmt->bindParam(':username', $username);

    // Execute statement
    $stmt->execute();

    // Fetch all rows
    $results = $stmt->fetch();

    if (!empty($results)) {
        $hashed_password = $results['password'];

        var_dump($hashed_password);
    
        if (password_verify($password, $hashed_password)) {

            $_SESSION['username'] = $username;
            // Check if user is logged in
                require 'function.php';
                // Display different navigation bar based on user's 'functie'
                switch($functie) {
                    case "ceo":
                        // Display navigation bar for afdelingsHoofd
                        header("location: menuAfdelingsHoofd.php");
                        break;
                    case "afdelingsHoofd":
                        // Display navigation bar for afdelingsHoofd
                        header("location: menuAfdelingsHoofd.php");
                        break;
                    case "magazijnMedewerker":
                        // Display navigation bar for magazijnmedewerker
                        header("location: menuMagazijnMedewerker.php");

                        break;
                    case "magazijnMeester":
                        // Display navigation bar for magazijnMeester
                        header("location: menuMagazijnMeester.php");
                        break;
                    case "bezorger":
                        // Display navigation bar for bezorger
                        header("location: menuBezorger.php");

                        break;
                    case "verkoper":
                        // Display navigation bar for verkoper
                        header("location: menuVerkoper.php");

                        break;
                    case "inkoper":
                        // Display navigation bar for inkoper
                        header("location: menuInkoper.php");

                        break;
                    default:
                        // Display default navigation bar
                        break;

                }
        } else {
            $_SESSION['message'] = 'Invalid log in credentials. Please try again.';
            header("Location: loginForm.php");
        }
    } else {
        $_SESSION['message'] = "Account doesn't exist. Please try again.";
        header("Location: loginForm.php");
    };

    var_dump($_SESSION['message']);
?>