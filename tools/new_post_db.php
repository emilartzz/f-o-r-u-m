<?php 

    session_start();
    if (!isset($_SESSION['uID'])) {
        header("Location: ../login.php");
    }
    if (isset($_POST['post_new'])) {

        $title = $_POST['new_p_title'];
        $body = $_POST['new_p_body'];
        if (empty($title) || empty($body)) {
            header("Location: ../add_post.php?error=emptyFields");
        }
        else {
            require 'db_conn.php';
            $sql = "INSERT INTO forumposts (p_title, p_body, p_owner) VALUES (?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../register.php?error=sqlError");
                    exit();
                }
                else {

                    mysqli_stmt_bind_param($stmt, "sss", $title, $body, $_SESSION['uID']);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../login.php?success=posted");
                    exit();
                }
        }
        
    } else {
        header("Location: ../add_post.php");
    }
    






















?>