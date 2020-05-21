<?php 
// STARTA INFO
session_start(); 

// SKICKA UT ETT WATERMARK MED ANVÄNDARENS INFO
require_once "tools/water_user.php";

// KOLLA OM ANVÄNDARE INLOGGAD
if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php');
}
// KOLLA OM ANVÄNDAREN ÄR "DISABLED"
require 'tools/check_account.php';

$p_id;


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

    <div class="show_post_container">

        <div class="selected_post">

            <?php

            require_once "./tools/db_conn.php";

            $p_id = $_GET['posts_id'];

            $sql = "SELECT  p_id, p_title, p_body, p_owner FROM forumposts WHERE p_id=" . $_GET['posts_id'] . ";";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

                echo '<form action="./edit_post.php" method="get">';
                echo '<input type="text" name="posts_id" style="display: none;" value="' . $row['p_id'] . '">';
                echo '<div class="post_container">';
                echo '<a href="#" class="post_title">' . $row['p_title'] . '</a>';
                echo '<p class="post_body">' . $row['p_body'] . '</p>';
                if ($row['p_owner'] == $_SESSION['uID'] || $_SESSION['uRole'] == 1) {
                    echo '<button type="submit" name="edit_post" class="edit_post">Edit Post</button>';
                    echo '<button type="submit" name="del_post" class="del_post">Delete Post</button>';   
                }
                echo '</div></form>';

            } else {
            echo "No Posts";
            }
            ?>

        </div>

    </div>

    <div class="comments">
        
            <div class="add_comment">
        
            <form action="./tools/post_comment.php" method="get">

                <h3>Comment</h3>
                <input type="text" name="posts_id" style="display: none;" value="<?php echo $row['p_id'] ?>">

                <textarea name="cBody" id="" cols="50" rows="4"></textarea>

                <input type="submit" name="submit_comment" value="Submit" id="submit_comment">
            
            
            </form>
        
        </div>

        <div class="posted_comments">

        <?php

        require_once "./tools/db_conn.php";
                    
        $sql = "SELECT cID, cOwner, cOwnerID, cBody, cPost FROM forumcomments WHERE cPost=$p_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
           
            echo '<form action="./tools/del_comment.php" method="get">';
            echo '<div class="posted_comments_each">';
            echo '<input type="text" name="comment_id" style="display: none;" value="' . $row['cID'] . '">';
            echo '<input type="text" name="cOwnerID" style="display: none;" value="' . $row['cOwnerID'] . '">';
            echo '<a href="#" class="comment_owner">' . $row['cOwner'] . '</a>';
            echo '<p class="comment_body">' . $row['cBody'] . '</p>';
            if ($row['cOwnerID'] == $_SESSION['uID'] || $_SESSION['uRole'] == 1) {
                 echo '<button type="submit" name="del_comment" class="del_comment">Delete</button>';   
            }
            echo '</div></form>';
        }
        } else {
        echo "No Comments";
        }

        ?>

        </div>

    </div>

    <!-- Link Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>