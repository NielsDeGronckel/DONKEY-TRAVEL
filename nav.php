
<nav>
    <div class="logo">
        <a class="bas" href="index">Donkey-Travel</a>
        <p class="bbb">Huifkar trips!</p>
        <!-- <img src="img/basLogo.png" alt="Bas Logo"> -->
    </div>

    <div class="navContainer">
        <div> <a href="index" class="navLink">Home</a>
            <?php
                require 'database/database.php';

                // Check if user is logged in
                if(isset($_SESSION['username'])) {
                    require 'function.php';
                

                    // Display different navigation bar based on user's 'functie'
                    switch($rights) {
                        case "admin":
                            echo '<a href="registerForm" class="navLink">Register</a>'; 
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">All</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="klantRead" class="navLink">Klant</a>'; 
                            echo '<a href="boekingRead" class="navLink">Boekingen</a>'; 
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">Admin</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="adminTableBoekingen" class="navLink">Boekingen</a>'; 
                            echo '<a href="adminTableTochten" class="navLink">Tochten</a>'; 
                            echo '<a href="adminTableKlanten" class="navLink">Klanten</a>'; 
                            echo '</div>';
                            echo '</div>';
                            break;

                        case "ceo":
                            // Display navigation bar for afdelingsHoofd
                            echo '<a href="registerForm" class="navLink">Register</a>'; 
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">All</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="klantRead" class="navLink">Klant</a>'; 
                            echo '<a href="artikelRead" class="navLink">Artikel</a>'; 
                            echo '<a href="levRead" class="navLink">Leverancier</a>'; 
                            echo '<a href="inkoopRead" class="navLink">Inkooporders</a>'; 
                            echo '<a href="verkooporderRead" class="navLink">Verkooporders</a>'; 
                            echo '<a href="menuBezorger" class="navLink">Bezorger</a>'; 
                            echo '</div>';
                            echo '</div>';
                            break;
                        case "afdelingsHoofd":
                            // Display navigation bar for afdelingsHoofd
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">All</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="klantRead" class="navLink">Klant</a>'; 
                            echo '<a href="artikelRead" class="navLink">Artikel</a>'; 
                            echo '<a href="levRead" class="navLink">Leverancier</a>'; 
                            echo '<a href="inkoopRead" class="navLink">Inkooporders</a>'; 
                            echo '<a href="verkooporderRead" class="navLink">Verkooporders</a>'; 
                            echo '</div>';
                            echo '</div>';
                            break;
                    case "magazijnMedewerker":
                        // Display navigation bar for magazijnmedewerker
                        echo '<a href="artikelSearch" class="navLink">Artikel</a>';
                        echo '<a href="verkoopordersUpdateForm" class="navLink">Update verkooporders</a>'; 
                        break;
                    case "magazijnMeester":
                        // Display navigation bar for magazijnMeester
                        echo '<a href="artikelCreateForm" class="navLink">Artikel</a>'; 
                        break;
                    case "bezorger":
                        // Display navigation bar for bezorger
                        echo '<a href="menuBezorger" class="navLink">Bezorger menu</a>'; 

                        break;
                    case "verkoper":
                        // Display navigation bar for verkoper
                        echo '<a href="klantCreateForm" class="navLink">Klant</a>'; 
                        echo '<a href="artikelRead" class="navLink">Artikel</a>'; 
                        echo '<a href="verkoopCreateForm" class="navLink">Verkooporders</a>'; 


                        break;
                    case "inkoper":
                        // Display navigation bar for inkoper
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Inkoop</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="inkoopCreateForm" class="navLink">Create</a>'; 
                        echo '<a href="inkoopRead" class="navLink">Read</a>'; 
                        echo '</div>';
                        echo '</div>'; 
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Leverancier</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="levCreateForm" class="navLink">Create</a>'; 
                        echo '<a href="levRead" class="navLink">Read</a>';
                        echo '</div>';
                        echo '</div>'; 
                        echo '<div class="dropdown">';
                        echo '<button class="dropbtn">Artikel</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="artikelCreateForm" class="navLink">Create</a>'; 
                        echo '<a href="artikelRead" class="navLink">Read</a>'; 
                        echo '<a href="artVoorraad" class="navLink">Artikel Voorraad</a>'; 
                        echo '</div>';
                        echo '</div>'; 
                    
                        break;
                        case NULL:
                            // Display navigation bar for klant
                            echo '<a href="menuKlant" class="navLink">Dashboard</a>'; 
                            echo '<div class="dropdown">';
                            echo '<button class="dropbtn">Boekingen</button>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="boekingCreateForm" class="navLink">Aanvragen</a>'; 
                            echo '<a href="boekingRead" class="navLink">Inzien</a>'; 
                            echo '</div>';
                            echo '</div>';     
                            break;
                        case "klant":
                            // Display navigation bar for klant
                            echo '<a href="klantCreateForm" class="navLink">Klant</a>'; 
                            echo '<a href="artikelRead" class="navLink">Artikel</a>'; 
                            echo '<a href="verkoopCreateForm" class="navLink">Verkooporders</a>';     
                            break;
                    default:
                        // Display default navigation bar
                        break;
                    }

                } else {

                    // Display navigation bar for non-logged-in users
                    ?>
                    <a href="about" class="navLink">About</a>
                    <a href="contact" class="navLink">Contact</a>
                    <?php

                }

            ?>
        </div>  
    </div>
    <div class="navLogin">
        <?php if(isset($_SESSION['username'])):?>
            <a href="account" class="navLinkLogin"><?php echo $_SESSION['username']; ?>: <i class='bx bxs-user-detail' ></i></a>
            <a href="logout" class="navLinkLogin">Logout: <i class='bx bxs-user-minus' ></i></a>
            <?php else: ?>
            <a href="loginForm" class="navLinkLogin">Login: <i class='bx bxs-user' ></i></a>
            <a href="registerForm" class="navLinkLogin">Register: <i class='bx bxs-user-plus'></i></a>
        <?php endif; ?>
 
    </div>
</nav>
<!-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> -->
