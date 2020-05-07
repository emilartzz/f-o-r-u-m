<?php session_start(); require_once "tools/water_user.php"; ?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | Register</title>

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

    <a class="go_dashboard_back" href="./dashboard.php">Back</a>

        <form action="./tools/submit_profile_changes_user.php" method="post">

            <h4>Edit Profile</h4>
            <p>Enter your details below</p>

            <?php 
 
            require "./tools/db_conn.php";
            $uID = $_SESSION['uID'];
            $sql = "SELECT uID, uFName, uLName, uName, uMail, uAdress, uPhone, uPass, uRole FROM forumusers WHERE uID=$uID";
            $result = $conn->query($sql);
            

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

            $_SESSION['auID'] = $row['uID'];
            $_SESSION['auName'] = $row['uName'];
            echo '<input class="flname" type="text" name="auFName" id="FName" placeholder="First name" required value="' . $row["uFName"] . '">';
            echo '<input class="flname" type="text" name="auLName" id="LName" placeholder="Last name" style="margin-left: 4px;" required value="' . $row["uLName"] . '">';
            echo '<input type="text" name="auName" id="Name" placeholder="Username" required value="' . $row["uName"] . '">';
            echo '<input type="email" name="auMail" id="Mail" placeholder="forum@example.com" required value="' . $row["uMail"] . '">';
            echo '<input type="text" name="auAdress" id="Adress" placeholder="Adress" required value="' . $row["uAdress"] . '">';
            echo '<input type="tel" name="auPhone" id="Phone" placeholder="+46123456789" required value="' . $row["uPhone"] . '">';
            }
            ?>

            <button type="submit" name="submit_user_profile_changes">Confirm</button>


        </form>
        <img id="edit_profile" src="img/edit_profile_illustration.svg" alt="Dashboard"></a>
        <!-- <img class="edit_profile_pic" src="./img/userpics/.png" alt="Contact illustration"> -->

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>