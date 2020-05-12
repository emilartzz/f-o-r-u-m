<?php session_start(); 

require_once "tools/water_user.php";

if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}

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

            require "./tools/db_conn.php";
            
            $sql = "SELECT p_id , p_title, p_body, p_owner FROM forumposts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            /*echo "<table class='userTable'><tr><th>ID</th><th>Name</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["uID"] . "</td><td>" . $row["uFName"] . " " . $row["uLName"] . " " . $row["uName"] . " " . $row["uMail"] . " " . $row["uAdress"] . " " . $row["uPhone"] . " " . $row["uRole"] . "</td></tr>";
            }
            echo "</table>";*/
            //$row = $result->fetch_assoc();
            //echo '<p class="p_desc">' . substr($row['p_body'], 0,50) . "...</p>";
            while ($row = $result->fetch_assoc()) {
                //echo ' ' . $row['p_id'] . ' ' . $row['p_title'] . ' ' . $row['p_body'] . ' ' . $row['p_owner'];

                echo '<div class="post_container">';
                echo '<a href="./posts/'. $row['p_id'] . '.php" class="post_title">' . $row['p_title'] . '</a>';
                echo '<p class="post_desc">' . substr($row['p_body'], 0,50) . '</p>';
                echo '</div>';
            }
            } else {
            echo "No Posts";
            }
            $conn->close();
            ?>



            </div>

           <!-- <div class="featured_posts">
                <div class="post_container">
                    <a href="#" class="post_title">Post title goes here</a>
                    <p class="post_desc">Post desc goes here</p>

                    <p class="post_owner">Post owner id goes here</p>


                </div>


                <div class="post_container">
                    <a href="#" class="post_title">Post title goes here</a>
                    <p class="post_desc">Post desc goes here</p>


                </div>
            </div> -->


    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>