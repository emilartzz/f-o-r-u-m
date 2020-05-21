<?php session_start(); require "db_conn.php";
// KOLLAR INLOGG
if (!isset($_SESSION['uID'])) {
    header('Location: ./login.php'); 
}
else {  // KOLLAR RÄTT KNAPP TRYCKT
        if (isset($_POST['submit_edit_post'])) {
                // VARIABLER OCH INFO FRÅN FÖRRA SIDA (FORM)
                $pTitle=$_POST['post_title'];
                $pBody=$_POST['post_body'];
                $pID=$_POST['post_id'];
                // KOLLAR OM NÅGOT ÄR TOMT
                if (empty($pTitle) || empty($pBody) || empty($pID)) {
                    header('Location: ./edit_post.php?error=missingFields');
                }
                // UPDATERAR INFO OM POST
                $sql = "UPDATE forumposts SET p_title = '$pTitle', p_body = '$pBody' WHERE p_id=$pID";
                
                // KOLLAR SÅ ALLT FUNKAR
                if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
                    header('Location: ../forum.php?success=submit');
                    exit();
                } else {
                echo "Error updating record: " . mysqli_error($conn);
                }
            
            }
            else {
                header('Location: ./forum.php');
            }


    }

?>