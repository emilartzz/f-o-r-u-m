<?php session_start();

require "tools/water_user.php";

if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}
else {
    if ($_SESSION['uRole'] != 1) {
        header('Location: ./dashboard.php'); 
    }
}

require 'tools/check_account.php';

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">

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

    <div class="container_admin">
        <form action="./tools/admin_edit_user.php" method="get">
            <?php

            require "./tools/db_conn.php";
            
            $sql = "SELECT uID, uFName, uLName, uName, uMail, uAdress, uPhone, uPass, uRole FROM forumusers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
/*            echo "<table class='userTable'><tr><th>ID</th><th>Name</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["uID"] . "</td><td>" . $row["uFName"] . " " . $row["uLName"] . " " . $row["uName"] . " " . $row["uMail"] . " " . $row["uAdress"] . " " . $row["uPhone"] . " " . $row["uRole"] . "</td></tr>";
            }
            echo "</table>";*/

            echo '<select name="admin_select_user" class="admin_select_user">';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['uID'] . '">' . " [" . $row['uID'] . '] ' . $row['uName'] . '</option>';
            }
            echo '</select> ';

            } else {
            echo "0 results";
}
            $conn->close();
            ?>

            <button type="submit" name="a_edit_user" class="editUser">Edit</button>

            
        </form>

        <form action="./tools/disable_or_delete_user.php" method="get" onSubmit="return confirm('Do you want to submit?') ">
            <?php

            require "./tools/db_conn.php";
            
            $sql = "SELECT uID, uFName, uLName, uName, uMail, uAdress, uPhone, uPass, uRole, uDisabled FROM forumusers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

            echo '<select name="admin_select_user" class="disableUser">';
            while ($row = $result->fetch_assoc()) {

                if ($row['uDisabled'] == 0) {
                    $uDisabledColor = "green";
                    $uDisabled = "Active";
                }
                else {
                    $uDisabledColor = "red";
                    $uDisabled = "Disabled";
                }

                echo '<option style="color:' . $uDisabledColor . '" value="' . $row['uID'] . '">' . " [" . $uDisabled . '] ' . $row['uName'] . '</option>';
            }
            echo '</select> ';

            } else {
            echo "0 results";
}
            $conn->close();
            ?>

            <button type="submit" name="a_disable" class="submit_disabled">Toggle</button>
            <button type="submit" name="a_delete" class="submit_delete">Delete</button>

        </form>

        </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>