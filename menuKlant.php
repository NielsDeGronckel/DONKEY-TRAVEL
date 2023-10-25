<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Klant</title>
</head>
<body>
<?php require_once 'inlogCheck.php'?>
    <?php require 'nav.php'?>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Klant Menu</h1>
                    <p>Welkom <?php echo $_SESSION['username']; ?></p>
                    <p>U bent nu ingelogd, in de navigatiebalk bovenin kunt u verder.</p>

                    <div class="divRead">
                        <p>Uw account:</p>
                        <div class="read">
                            <?php
                                require 'Classes/Klant.php';
                                $klanten = new Klant();
                                $klanten->ReadKlant($_SESSION['klantId']);
                            ?>
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
</html>