<?php session_start(); require_once "water_user.php"; require "db_conn.php"; 

if (!isset($_SESSION['uID'])) {
    header('Location: ../login.php'); 
}
else {

    $sql = "SELECT cOwnerID FROM forumcomments WHERE cID=" . $_GET['comment_id'] . ";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if ($_SESSION['uID'] == $row['cOwnerID'] || $_SESSION['uRole'] == 1) {
            
            if (isset($_GET['del_comment'])){
                $sql = "DELETE FROM forumcomments WHERE cID=" . $_GET['comment_id'] . ";";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>window.history.back();</script>';
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