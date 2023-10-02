<?php
    require 'database.php';

  // Check if user is logged in
  if(isset($_SESSION['username'])) {

    // Retrieve user's 'functie' from the database
    $username = $_SESSION['username'];
    $query = "SELECT functie FROM medewerkers WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $functie = $row['functie'];
  

    // Display different navigation bar based on user's 'functie'
    switch($functie) {
      case "magazijnmedewerker":
        // Display navigation bar for magazijnmedewerker
        break;
      case "bezorger":
        // Display navigation bar for bezorger
        break;
      case "verkoper":
        // Display navigation bar for verkoper
        break;
      case "inkoper":
        // Display navigation bar for inkoper
        break;
      default:
        // Display default navigation bar
        break;
    }

  } else {

    // Display navigation bar for non-logged-in users
    ?>
    <div>
      <a href="about.php" class="navLink">About</a>
    </div>
    <div>
      <a href="contact.php" class="navLink">Contact</a>
    </div>
    <?php

  }
?>
