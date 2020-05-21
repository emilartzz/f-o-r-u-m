<?php session_start(); 

require 'tools/check_account.php';

require_once "tools/water_user.php";

if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}
// SAMMA SOM INNAN ^

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-O-R-U-M | Forum</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Link Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>

<body>

    <header>

        <div class="nav_brand">
            <h1> F ─ O ─ R ─ U ─ M</h1>

            <ul class="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="<?php 
                
                    if ($_SESSION['uRole'] === 1){
                        echo'admin.php';
                    }
                    else {
                        echo'dashboard.php';
                    } ?>
                    
                    "><img id="dashboard" src="img/dashboard_vector.svg" alt="Dashboard"></a></li>
                <li><a href="./tools/logout_db.php"><img id="logout" src="img/logout_vector.svg"></a></li>
            </ul>
        </div>

    </header>

    <div class="container_forum">
        <a href="./add_post.php" class="newPost">New Post</a>
        <div class="featured_posts">

            <?php
            // KRÄV DB_CONN FILEN FÖR ATT KUNNA KOPPLA TILL DATABAS
            require "./tools/db_conn.php";
            // SELECT SAKER FÖR ATT KUNNA VISA POSTS
            $sql = "SELECT p_id , p_title, p_body, p_owner FROM forumposts";
            // SPARA INFO
            $result = $conn->query($sql);
            // OM RADER ÄR MER ÄN 0 GÖR DETTA
            if ($result->num_rows > 0) {
            // MATA UT ALLA POSTS
            while ($row = $result->fetch_assoc()) {

                echo '<form action="./posts.php" method="get">';
                echo '<div class="post_container">';
                echo '<input type="text" name="posts_id" style="display: none;" value="' . $row['p_id'] . '">';

                echo '<button type="submit" name="show_post" class="post_title">' . $row['p_title'] . '</button>';
                echo '<p class="post_desc">' . substr($row['p_body'], 0,50) . '...</p>';
                echo '</div></form>';
            }
            // SKRIV ANNARS UT "NO POSTS"
            } else {
            echo "No Posts";
            }
            $conn->close();
            ?>

            </div>


    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>