<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Verkooporder Create</title>
</head>
<body>
<?php require 'nav.php'?>
<?php
    require_once 'Klant.php';
    $klanten = new Klant();
    require_once 'Artikel.php';
    $artikelen = new Artikel();
?>
<div class="content">
    <div class="accountPage">
        <div class="basCard">
            <div class="accountItems">
                <h1>Registreer nieuwe Verkooporder:</h1>
                <div class="accountForm">
                    <form method="post" id="register" action="verkoopCreate.php" class="form">
                        <label for="klantId">Klant ID:</label>
                        <select id="klantId" name="klantId">
                        <?php
                          $klanten = $klanten->getKlanten();
                          foreach ($klanten as $klant) {
                            echo '<option value="' . $klant['klantId'] . '">' . $klant['klantId'] . ' - ' . $klant['klantNaam'] . '</option>';
                        }
                        ?>
                        </select>
                        <br>
                        <label for="artId">Artikel ID:</label>
                        <select id="artId" name="artId">
                            <?php
                                 $artikelen = $artikelen->getArtikelen();
                                 foreach ($artikelen as $artikel) {
                                     echo '<option value="' . $artikel['artId'] . '">' . $artikel['artId'] . ' - ' . $artikel['artOmschrijving'] . '</option>';
                                 }
                            ?>
                        </select>

                        <br>
                        <label for="verkOrdDatum">verkoop order Datum:</label>
                        <input type="DATE" id="verkOrdDatum" name="verkOrdDatum" required>
                        <br>
                        <label for="verkOrdBestAantal">verkoop order Bestel Aantal:</label>
                        <input type="int" id="verkOrdBestAantal" name="verkOrdBestAantal" required>
                        <br>
                        <input type="hidden" name="verkOrdStatus" value="false">
                        <div class="submitButton">
                            <input type="submit" name="verkoopCreate" value="Submit" class="registerClass">
                        </div>
                    </form>
                    <div class="question">
                        <p><a href="levRead.php">Verkooporder Read</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require 'footer.php'?>
</body>
<style>

    select {
        width: 100px;
        margin-left: 80px;
    }

    input {
        margin-bottom: 5px;
        width: 200px;
        padding: 10px 15px;
        display: flex;
        justify-content: center;
        border-radius: 5px;

    }

</style>

<script>
    var form = document.getElementById("register");
    const checkboxMessage = document.getElementById("checkboxMessage");
    const passwordMessage = document.getElementById("passwordMessage");
    const usernameMessage = document.getElementById("usernameMessage");
    const warningCheckbox = document.getElementById("agreement");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const usernameInput = document.getElementById("username");
    // Set maximum username length
    var maxUsernameLength = 12;
    // set cursewords
    const curseWords = ["fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch"];


    // Add event listener for form submit
    form.addEventListener("submit", function(event) {
        // Get the current username
        var username = usernameInput.value;

        // Check if the username is too long
        if (username.length > maxUsernameLength) {
            // Prevent form from being submitted
            event.preventDefault();
            // Show error message
            usernameMessage.innerHTML = 'The username cannot be longer than ' + maxUsernameLength + ' characters';
            // alert("Sorry, the username cannot be longer than " + maxUsernameLength + " characters.");
        } else if (password.value !== confirmPassword.value) {
            passwordMessage.innerHTML = "Passwords do not match. Please try again.";
            event.preventDefault();
        } else {
            for (var i = 0; i < curseWords.length; i++) {
                // Check if the input value contains the curse word
                if (username.indexOf(curseWords[i]) !== -1) {
                    event.preventDefault();

                    // Alert the user that the input contains a curse word
                    usernameMessage.innerHTML ="The username contains a curse word, please enter a different username.";

                    // Clear the input field
                    username.value = "";
                    break;
                }
            }
        }
    });
</script>
</html>