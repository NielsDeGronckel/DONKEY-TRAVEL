<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update klant</title>
</head>
<body>
<?php require_once 'inlogCheck.php'?>
<?php 
$getKlantId = intval($_GET['GETklantId']);

session_start();

if ($_SESSION['klantId'] !== $getKlantId) { 
    header("Location: restrictedContent");        
        } else {  
            session_abort();
?>
    <?php 
    require 'nav.php';
    ?>

    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Update uw account:</h1>
                    <div class="accountForm">
                        <?php
                            require 'Classes/Klant.php';
                            $klant1 = new Klant();
                            $klant = $klant1->findKlant($_GET['GETklantId']);
                            // var_dump($klantId);
                        ?>
                       <form method="POST" action="klantUpdate.php">
                            <input type="hidden" name="klantId" value="<?php echo $klant['ID']; ?>">
                            <label>Naam:</label>
                            <input type="text" name="usernameKlant" value="<?php echo $klant['username']; ?>"><br>
                            <label>Email:</label>
                            <input type="email" name="email" value="<?php echo $klant['email']; ?>"><br>
                            <label>Telefoon:</label>
                            <input type="telefoon" name="telefoon" value="<?php echo $klant['telefoon']; ?>"><br>
                            <label>Nieuw wachtwoord:</label>
                            <input type="password" name="passwordKlant"><br>
                            <div class="formEnd">
                                <input type="submit" value="Submit">                      
                                <p><a id="cancel" href="menuKlant">Cancel</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require 'footer.php'?>
    <?php } ?>
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
</style>
</html>