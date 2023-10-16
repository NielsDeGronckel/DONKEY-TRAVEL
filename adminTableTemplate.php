<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Table <?php $title ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/admin.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4773475340562413"
     crossorigin="anonymous"></script>
</head>
<body>
<?php include("nav.php"); ?>
<main>
    <div class="content">
        <div class="adminContent">
            <div class="adminCard">

                <!-- <h1>Admin</h1> -->
                <?php if ($_SESSION) {
                if ($_SESSION['username'] == 'admin') {?>
                <div class="adminTable">

                    <?php
                        require_once 'Classes/Table.php';
                        $tableGenerator = new Table();
                        $tableEcho = $tableGenerator->tableRead($tableName);
                        echo $tableEcho;
                    ?>
                     <div id="messagePHP"><?php

                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>
                        </div>
                    </div>
                   
                    <!-- <div class="adminNav">
                        <a href="adminTablePlayers.php">Klanten</a>
                        <a href="adminTableScores.php">Boekingen</a>
                        <a href="adminTableNotifications.php">Tochten</a>
                        <a href="adminTableRank.php">Status</a>
                    </div> -->
                </div>
            <?php
                }}else {
                    echo 'Access to this content is restricted. Please sign in or request permission.';
                }
            ?>
        </div>
    </div>
</main>
<style>
    .deleteButton, .deleteButton:hover {
        background-color: transparent;
    }
    .deleteButton .bxs-trash:hover {
        color: red;
    }
</style>
<script src="assets/adminUpdateCell.js"></script>
<script src="assets/main.js"></script>
</body>
</html>