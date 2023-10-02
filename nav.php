<!-- Lukas Sliva 08/02/2023 -->



<nav>
    <div class="logo">
        <a class="bas" href="index.php">Donkey-Travel</a>
        <p class="bbb">Huifkar trips!</p>
        <!-- <img src="img/basLogo.png" alt="Bas Logo"> -->
    </div>

    <div class="navContainer">
        <div> <a href="index.php" class="navLink">Home</a>
            <?php
                require 'database.php';

                // Check if user is logged in
                if(isset($_SESSION['username'])) {
                    require 'function.php';
                

                    // Display different navigation bar based on user's 'functie'
                    switch($functie) {
                        case "ceo":
                            // Display navigation bar for afdelingsHoofd
                            echo '<a href="registerForm.php" class="navLink">Register</a>'; 
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">All</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="klantRead.php" class="navLink">Klant</a>'; 
                            echo '<a href="artikelRead.php" class="navLink">Artikel</a>'; 
                            echo '<a href="levRead.php" class="navLink">Leverancier</a>'; 
                            echo '<a href="inkoopRead.php" class="navLink">Inkooporders</a>'; 
                            echo '<a href="verkooporderRead.php" class="navLink">Verkooporders</a>'; 
                            echo '<a href="menuBezorger.php" class="navLink">Bezorger</a>'; 
                            echo '</div>';
                            echo '</div>';
                            break;
                        case "afdelingsHoofd":
                            // Display navigation bar for afdelingsHoofd
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">All</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="klantRead.php" class="navLink">Klant</a>'; 
                            echo '<a href="artikelRead.php" class="navLink">Artikel</a>'; 
                            echo '<a href="levRead.php" class="navLink">Leverancier</a>'; 
                            echo '<a href="inkoopRead.php" class="navLink">Inkooporders</a>'; 
                            echo '<a href="verkooporderRead.php" class="navLink">Verkooporders</a>'; 
                            echo '</div>';
                            echo '</div>';
                            break;
                    case "magazijnMedewerker":
                        // Display navigation bar for magazijnmedewerker
                        echo '<a href="artikelSearch.php" class="navLink">Artikel</a>';
                        echo '<a href="verkoopordersUpdateForm.php" class="navLink">Update verkooporders</a>'; 
                        break;
                    case "magazijnMeester":
                        // Display navigation bar for magazijnMeester
                        echo '<a href="artikelCreateForm.php" class="navLink">Artikel</a>'; 
                        break;
                    case "bezorger":
                        // Display navigation bar for bezorger
                        echo '<a href="menuBezorger.php" class="navLink">Bezorger menu</a>'; 

                        break;
                    case "verkoper":
                        // Display navigation bar for verkoper
                        echo '<a href="klantCreateForm.php" class="navLink">Klant</a>'; 
                        echo '<a href="artikelRead.php" class="navLink">Artikel</a>'; 
                        echo '<a href="verkoopCreateForm.php" class="navLink">Verkooporders</a>'; 


                        break;
                    case "inkoper":
                        // Display navigation bar for inkoper
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Inkoop</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="inkoopCreateForm.php" class="navLink">Create</a>'; 
                        echo '<a href="inkoopRead.php" class="navLink">Read</a>'; 
                        echo '</div>';
                        echo '</div>'; 
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Leverancier</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="levCreateForm.php" class="navLink">Create</a>'; 
                        echo '<a href="levRead.php" class="navLink">Read</a>';
                        echo '</div>';
                        echo '</div>'; 
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Artikel</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="artikelCreateForm.php" class="navLink">Create</a>'; 
                        echo '<a href="artikelRead.php" class="navLink">Read</a>'; 
                        echo '<a href="artVoorraad.php" class="navLink">Artikel Voorraad</a>'; 
                        echo '</div>';
                        echo '</div>'; 
                        



                        break;
                    default:
                        // Display default navigation bar
                        break;
                    }

                } else {

                    // Display navigation bar for non-logged-in users
                    ?>
                    <a href="about.php" class="navLink">About</a>
                    <a href="contact.php" class="navLink">Contact</a>
                    <?php

                }

            ?>
        </div>  
    </div>
    <div class="navLogin">
        <?php if(isset($_SESSION['username'])):?>
            <a href="account.php" class="navLinkLogin"><?php echo $_SESSION['username']; ?>: <i class='bx bxs-user-detail' ></i></a>
            <a href="logout.php" class="navLinkLogin">Logout: <i class='bx bxs-user-minus' ></i></a>
            <?php else: ?>
            <a href="loginForm.php" class="navLinkLogin">Login: <i class='bx bxs-user' ></i></a>
            <!-- <a href="registerForm.php" class="navLinkLogin">Register: <i class='bx bxs-user-plus'></i></a> -->
        <?php endif; ?>
 
    </div>
</nav>
<!-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> -->
