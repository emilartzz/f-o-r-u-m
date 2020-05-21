<?php session_start(); require_once "tools/water_user.php"; require "tools/db_conn.php"; 


if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php');
}

require 'tools/check_account.php'; 

// SAMMA ^
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | Edit Post</title>

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

    <div class="edit_post_container">

    <form action="./tools/submit_post_changes.php" method="post" onSubmit="return confirm('Confirm changes.')">

        <h4>Edit Post</h4>
            <p>Enter any info below</p>


<?php
// KOLLA OM INLOGG
if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}
else {
    // SELECT INFO FRÅN FORUMPOSTS
    $sql = "SELECT  p_owner FROM forumposts WHERE p_id=" . $_GET['posts_id'] . ";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        // KOLLA OM DET ÄR ÄGAREN ELLER EN ADMIN SOM FÖRSÖKER REDIGERA
        if ($_SESSION['uID'] == $row['p_owner'] || $_SESSION['uRole'] == 1) {
            // OM ANVÄNDAREN KLICKADE DELETE PÅ FÖRRA SIDAN, TA DÅ BORT INLÄGG OCH GÅ TILLBAKS TILL FORUM.PHP
            if (isset($_GET['del_post'])){
                $sql = "DELETE FROM forumposts WHERE p_id=" . $_GET['posts_id'] . ";";
            
            if ($conn->query($sql) === TRUE) {
              header('Location: ./forum.php');
            } else {
              echo "Error deleting record: " . $conn->error;
            }
            
            $conn->close();
            }


        }
        else {
            header('Location: ./forum.php');
        }

    }
    else {
        echo "Error...";
        }
        $conn->close();

}
// ANNARS KÖR REDIGERA STUFF
require "./tools/db_conn.php";

$sql = "SELECT p_id, p_title, p_body, p_owner FROM forumposts WHERE p_id=" . $_GET['posts_id'] . ";";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

$row = $result->fetch_assoc();
// SKRIV UT ALL INFO OM POSTEN
echo '<input type="text" name="post_id" required value="' . $row["p_id"] . '" style="display: none;">';
    echo '<input class="edit_post_title" type="text" name="post_title" required value="' . $row["p_title"] . '">';
    echo '<textarea class="edit_post_body" type="text" name="post_body" required cols="30" rows="10">' . $row["p_body"] . '</textarea>';
    // SKICKA VIDARE
    echo '<button type="submit" name="submit_edit_post" class="edit_post_submit">Save</button>';

} else {
echo "No Posts";
}
$conn->close();
?>

</div>


    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>