<?php session_start(); 

require_once "tools/water_user.php";

if (isset($_SESSION['uID'])) {
    header('Location: ./forum.php'); 
}

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | Login</title>

    <!-- Link Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

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

                <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
        </div>

    </header>

    <div class="container_register_login_contact">

        <form action="./tools/login_db.php" method="post">

            <h4>Login</h4>
            <p>Enter your details below</p>

            <input type="text" name="uMail" id="Name" placeholder="Username">

            <input class="pass" type="password" name="uPass" id="Pass" placeholder="Password">

            <button type="submit" name="login_submit">Login</button>


        </form>

        <img src="./img/login_illustration.svg" alt="Login illustration">

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>