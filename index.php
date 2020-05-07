<?php session_start(); require_once "tools/water_user.php"; ?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Link Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>

<body>

    <header>

        <div class="nav_brand">
            <h1>F ─ O ─ R ─ U ─ M</h1>
            <?php 
                if (!isset($_SESSION['uID'])) {
                    echo'
                    <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    </ul>
                    ';
                }
                else {
                    echo'
                    <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="';
                    
                    if ($_SESSION['uRole'] === 1){
                        echo'admin.php';
                    }
                    else {
                        echo'dashboard.php';
                    }
                    echo'"><img id="dashboard" src="img/dashboard_vector.svg" alt="Dashboard"></a></li>
                    <li><a href="./tools/logout_db.php"><img id="logout" src="img/logout_vector.svg"></a></li>
                    </ul>
                    ';
                }
                ?>
        </div>

    </header>

    <div class="container_landing">

        <div class="landing_text">

        <?php
                if (!isset($_SESSION['uID'])) {

                echo '
            <h2>Social is the word</h2>
            <p>As humans, social interaction is essential to every aspect of our health.
                Research shows that having a strong network of support or strong community bonds fosters both emotional
                and physical health and is an important component of adult life.</p>';


                
                echo '<a href="register.php">Join now!</a>';
                }
                else {
                    echo '
                   <h2>Welcome ' . $_SESSION['uName'] . '!</h2>
                   <p>As humans, social interaction is essential to every aspect of our health.
                   Research shows that having a strong network of support or strong community bonds fosters both emotional
                   and physical health and is an important component of adult life.</p>';
                   echo '<a href="forum.php">Access the forum!</a>';
                   }

                ?>


        </div>

        <img src="img/social_illustration.svg" alt="People with textboxes around them">

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>