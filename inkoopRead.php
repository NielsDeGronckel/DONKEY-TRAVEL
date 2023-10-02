<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Inkooporder Create</title>
</head>
<body>
    <?php require 'nav.php'?>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="CardContent">
                    <h1>Read Inkooporder</h1>
                    <p>Zoek inkooporder op inkoop order id:</p>
                    <form action="inkoopSearch.php" method='POST'>
                        <label for="inkOrdId">inkoop order Id:</label>
                        <input type="text" id ='inkOrdId' name='inkOrdId'>
                        <input type="submit">

                    </form>
                    <?php
                 
                        // require 'database.php';
                        if (isset($_SESSION['result'])) {
                            $result = $_SESSION['result'];
                            echo "LevId: " . $result['levId'] . "<br>";
                            echo "ArtId: " . $result['artId'] . "<br>";
                            echo "InkOrdDatum: " . $result['inkOrdDatum'] . "<br>";
                            echo "InkOrdBestAantal: " . $result['inkOrdBestAantal'] . "<br>";
                            echo "InkOrdStatus: " . $result['inkOrdStatus'] . "<br>";
                            // unset the session variable once it's been displayed
                            unset($_SESSION['result']);
                        } else if (isset($_SESSION['searchMsg'])) {
                            echo $_SESSION['searchMsg'];
                            unset($_SESSION['searchMsg']);
                        }
                    ?>
                    <div class="divRead">

                            <p>Dit zijn alle inkooporder gegevens uit de database:</p>
                            <div class="read">
                                <?php 
                                    require 'Inkooporders.php';
                                    $inkooporder1 = new Inkooporder();
                                    $inkooporder1->readInkooporder();
                                ?>
                                <div class="redirect">
                                    <a href="inkoopCreateForm.php">Create inkooporder</a>
                                </div>
                            </div>
                            <div id="messagePHP">
                                <?php
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
    </div>
    <?php require 'footer.php'?>
    <style>
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
</body>
</html>
