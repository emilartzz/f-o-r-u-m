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
    <title>F-O-R-U-M | Register</title>

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

        <form action="./tools/register_db.php" method="post">

            <h4>Register</h4>
            <p>Enter your details below</p>

            <input class="flname" type="text" name="uFName" id="FName" placeholder="First name" required>
            <input class="flname" type="text" name="uLName" id="LName" placeholder="Last name" required>

            <input type="text" name="uName" id="Name" placeholder="Username" required>
            <input type="email" name="uMail" id="Mail" placeholder="forum@example.com" required>
            <input type="text" name="uAdress" id="Adress" placeholder="Adress" required>
            <input type="number" name="uPhone" id="Phone" placeholder="+46123456789" required>

            <input class="pass" type="password" name="uPass" id="Pass" placeholder="Password" required>
            <input class="pass" type="password" name="uVPass" id="VPass" placeholder="Retype password" required>

            <button type="submit" name="register_submit">Register</button>


        </form>

        <img src="./img/register_illustration.svg" alt="Register illustration">

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>