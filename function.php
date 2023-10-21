<?php
if(isset($_SESSION['username'])) {

    // Retrieve user's 'functie' from the database
    $username = $_SESSION['username'];
    $query = "SELECT rights FROM klanten WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['rights']) {   
        $_SESSION['rights'] = $row['rights'];
    }
    $rights = $row['rights'] ?? NULL;
}
?>