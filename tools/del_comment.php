<?php session_start(); require_once "water_user.php"; require "db_conn.php"; 
// KOLLAR INLOGG
if (!isset($_SESSION['uID'])) {
    header('Location: ../login.php'); 
}
else {
    // TAR INFO OM ÄGAREN TILL KOMMENTAREN
    $sql = "SELECT cOwnerID FROM forumcomments WHERE cID=" . $_GET['comment_id'] . ";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        // KOLLAR SÅ ATT ÄGAREN ÄR DEN SOM VILL TA BORT ELLER EN ADMIN
        if ($_SESSION['uID'] == $row['cOwnerID'] || $_SESSION['uRole'] == 1) {
            // KOLLAR SÅ RÄTT KNAPP VAR KLICKAD
            if (isset($_GET['del_comment'])){
                // TAR BORT KOMMENTAREN
                $sql = "DELETE FROM forumcomments WHERE cID=" . $_GET['comment_id'] . ";";
            // SKICKAR TILLBAKS ANVÄNDAREN TILL TIDIGARE SIDA
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