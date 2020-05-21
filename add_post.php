<?php session_start(); require_once "tools/water_user.php"; 

if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}

require 'tools/check_account.php';

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | New Post</title>

    <!-- Link Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

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

    <div class="new_post_container">
        <!-- DEFAULT STUFF SÅSOM POST BODY OSV I ETT FORM  BASIC STUFF -->
        <form action="./tools/new_post_db.php" method="post">

            <h4>New Post</h4>
            <p>A brand new Posty post</p>
            
            <input type="text" name="new_p_title" placeholder="Title">
            <textarea name="new_p_body" cols="30" rows="10" placeholder="Main Text"></textarea>

            <button type="submit" name="post_new">Post</button>


        </form>

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>