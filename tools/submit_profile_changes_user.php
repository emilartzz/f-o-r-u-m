<?php

if (isset($_POST['submit_user_profile_changes'])) {

    session_start();
 
    require "db_conn.php";

    $uID = $_SESSION['auID'];
    $ogName = $_SESSION['auName'];
    $uFName = $_POST['auFName'];
    $uLName = $_POST['auLName'];
    $uName = $_POST['auName'];
    $uMail = $_POST['auMail'];
    $uAdress = $_POST['auAdress'];
    $uPhone = $_POST['auPhone'];

    echo ' ' . $_SESSION['auID'] . ' ' . $uFName . ' ' . $uLName . ' ' . $uName . ' ' . $uMail . ' ' . $uAdress . ' ' . $uPhone;

    if(empty($uFName) || empty($uLName) || empty($uName) || empty($uMail) || empty($uAdress) || empty($uPhone)){
        header("Location: ../edit_profile.php?error=emptyFields&uid=" . $uName . "&mail=" . $uMail);
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../edit_profile.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL)){
        header("Location: ../edit_profile.php?error=invalidMail&uid=" . $uName);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../edit_profile.php?error=invalidUname&mail=" . $uMail);
        exit();
    }
    else {

        if ($uName != $ogName) {
            $sql = "SELECT uName FROM forumusers WHERE uName=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../edit_profile.php?error=sqlError1");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $uName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0){
                header("Location: ../edit_profile.php?error=userTaken&mail=" . $uMail);
                exit();
            }
            else {
                
                $sql = "UPDATE forumusers SET uFName='$uFName', uLName='$uLName', uName='$uName', uMail='$uMail', uAdress='$uAdress', uPhone='$uPhone', uRole='$uRole' WHERE uID='$uID'";

                if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
                    header("Location: ../edit_profile.php?success=updated");
                    exit();
                } else {
                echo "Error updating record: " . mysqli_error($conn);
                }

            }
        }
    }
        else {
            
            $sql = "UPDATE forumusers SET uFName='$uFName', uLName='$uLName', uName='$uName', uMail='$uMail', uAdress='$uAdress', uPhone='$uPhone', uRole='$uRole' WHERE uID='$uID'";

            if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            header("Location: ../edit_profile.php?success=updated");
            exit();

            } else {
            echo "Error updating record: " . mysqli_error($conn);
            }

        }



    }

mysqli_close($conn);

}
else {
    header("Location: ../edit_profile.php");
    exit();

}

?>