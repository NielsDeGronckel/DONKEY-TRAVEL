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
                    <form method="post" action="login.php">
                        <div class="labelInput">
                        <label class="iconField" for="username"><i class='bx bxs-user'></i></label>
                        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_SESSION['usernamePost']) ? $_SESSION['usernamePost'] : ''; ?>" required>
                        </div>
                        <div class="labelInput">
                        <label class="iconField" for="password"><i class='bx bxs-lock-alt' ></i></label>
                        <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_SESSION['passwordPost']) ? $_SESSION['passwordPost'] : ''; ?>" required>
                        </div>
                        <input type="submit" value="Login" class="submitButton">
                        <p class="redirect">New here? <a href="registerForm.php">Sign up now<i class='bx bxs-right-arrow-alt'></i></a></p>
                    </form> 
                    <div class="messagePHP"><?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        
                        ?></div>
                        <?php if (isset($_GET['message'])) { ?>
                        <div class="message">
                            <?php echo $_GET['message']; ?>
                        </div>
                    <?php } ?>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
            .registerForm {
            padding: 10px;
            margin: 10px;
        }
        

        input {
             width: 200px;
            padding: 10px 15px;
            margin: 5px 0;
            box-sizing: border-box;
            /* background-image: url('img/gif.gif'); */
        }

        #agreement {
            width: 30px;
        }

      
        select, input {
        width: 200px;
        padding: 10px 15px;
        margin: 5px 0;
        box-sizing: border-box;
        /* background-image: url('img/gif.gif'); */
        background-color: #ffffff7d ;

        border-radius: 10px;
    }
    #update:hover {
        /* input[type="submit"] { */
        background-color: #f23f5f;
    }
    select option {
        /* background-color: #ffc0cb; */
    }
    ::placeholder {
            color: black; /* Text color for the placeholder */
        }

</style>


    <?php require 'footer.php'?>
</body>
</html>