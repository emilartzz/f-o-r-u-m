<?php 

    session_start();
    if (!isset($_SESSION['uID'])) {
        header("Location: ../login.php");
    }
    if (isset($_GET['submit_comment'])) {

        $cBody = $_GET['cBody'];
        $cPost = $_GET['posts_id'];
        $cOwner = $_SESSION['uName'];
        $cOwnerID = $_SESSION['uID'];
        if (empty($cBody) || empty($cPost) || empty($cOwner)) {
            header("Location: ../forum.php?error=emptyFields");
        }
        else {
            require 'db_conn.php';
            $sql = "INSERT INTO forumcomments (cOwner, cOwnerID, cBody, cPost) VALUES (?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../forum.php?error=sqlError");
                    exit();
                }
                else {

                    mysqli_stmt_bind_param($stmt, "ssss", $cOwner, $cOwnerID, $cBody, $cPost);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../forum.php?success=posted");
                    exit();
                }
        }
        
    } else {
        header("Location: ../forum.php");
    }
    
?>