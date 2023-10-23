<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Klant Read</title>
</head>
<body>
    <?php require 'nav.php'?>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="CardContent">
                    <h1>Read Klant</h1>
                    <p>Zoek klant op ID of Postcode:</p>
                    <form action="klantSearch.php" method='POST'>
                        <label for="klantPostcode">Postcode:</label>
                        <input type="text" id ='klantPostcode' name='klantPostcode'>
                        <input type="submit">

                    </form>
                    <form action="klantSearchId.php" method='POST'>
                        <label for="klantId">ID:</label>
                        <input type="text" id ='klantId' name='klantId'>
                        <input type="submit">

                    </form>
                    <?php
                    // require 'database.php';
                    if (isset($_SESSION['result'])) {
                        $result = $_SESSION['result'];
                        echo '<div class=""';
                        echo "Klantnaam: " . $result['username'] . "<br>"; // Update to 'username'
                        echo "Email: " . $result['email'] . "<br>"; // Update to 'email'
                        echo "telefoon: " . $result['telefoon'] . "<br>"; // Update to the appropriate property
                        echo "password: " . $result['password'] . "<br>"; // Update to the appropriate property
                        echo "rights: " . $result['rights'] . "<br>"; // Update to the appropriate property
                        echo "changed: " . $result['changed'] . "<br>"; // Update to the appropriate property
                        echo '</div>';
                        // unset the session variable once it's been displayed
                        unset($_SESSION['result']);
                    } else if (isset($_SESSION['searchMsg'])) {
                        echo $_SESSION['searchMsg'];
                        unset($_SESSION['searchMsg']);
                    }
                    ?>


                    <div class="divRead">
                        <p>Dit zijn alle klant gegevens uit de database:</p>
                        <div class="read">
                            <?php
                                require 'Klant.php';
                                $klanten = new Klant();
                                $klanten->ReadKlant();
                            ?>
                            <div class="redirect">
                                <a href="klantCreateForm.php">Create klant</a>
                            </div>
                        </div>
                        <div id="messagePHP"><?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require 'footer.php'?>
</body>
<style>
    
input {
    margin-bottom: 5px;
    width: 200px;
    padding: 10px 15px;
    display: flex;
    justify-content: center;
    border-radius: 5px;

}

#messagePHP {
    color: white;
}

a {
    margin: 5px;
    padding: 5px;
    border-radius: 5px;
}
a:hover {
    background-color: white;
    color: black;
}
.CardContent {
    padding: 10px;
    margin: 10px;
}

</style>

<script>
</script>
</html>