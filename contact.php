<?php session_start(); require_once "tools/water_user.php"; 

if (isset($_SESSION['uID'])) {
    require 'tools/check_account.php';
}

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | Contact</title>

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

    <div class="container_register_login_contact">
                                <!-- ONSUMBIT KOLLA OM MAN VERKLIGEN VILL SKICKA -->
        <form action="#" onSubmit="alert('Work in progress, Feature coming soon!');" method="post">

            <h4>Contact</h4>
            <p>Enter your details below</p>

            <input class="flname" type="text" name="cFName" id="rFName" placeholder="First name">
            <input class="flname" type="text" name="cLName" id="rLName" placeholder="Last name">

            <input type="email" name="cMail" id="Mail" placeholder="forum@example.com">

            <textarea name="cMessage" id="cMessage" cols="30" rows="10" placeholder="Message" required></textarea>

            <button type="submit" name="contact_submit">Submit</button>


        </form>

        <img src="./img/contact_illustration.svg" alt="Contact illustration">

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>