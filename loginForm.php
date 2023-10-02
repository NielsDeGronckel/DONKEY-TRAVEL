<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>
    <?php require 'nav.php'?>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Login</h1>
                    <div class="accountForm">
                        <form method="post" action="login.php" class="form">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                            <br>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                            <br><br>
                            <div id="messagePHP"><?php

                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                                ?>
                            </div>
                            <div class="submitButton">
                                <input type="submit" value="Login" class="submitClass">
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php require 'footer.php'?>
</body>
</html>