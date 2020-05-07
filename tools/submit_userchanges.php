<?php

if (isset($_POST['admin_submit_userchanges'])) {

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
    $uRole = $_POST['aRole'];

    echo ' ' . $_SESSION['auID'] . ' ' . $uFName . ' ' . $uLName . ' ' . $uName . ' ' . $uMail . ' ' . $uAdress . ' ' . $uPhone . ' ' . $uRole;

    if (empty($uFName) || empty($uLName) || empty($uName) || empty($uMail) || empty($uAdress) || empty($uPhone)){
        header("Location: ../admin.php?error=emptyFields&uid=" . $uName . "&mail=" . $uMail);
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../admin.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL)){
        header("Location: ../admin.php?error=invalidMail&uid=" . $uName);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../admin.php?error=invalidUname&mail=" . $uMail);
        exit();
    }
    else {

        if ($uName != $ogName) {
            $sql = "SELECT uName FROM forumusers WHERE uName=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../admin.php?error=sqlError1");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $uName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0){
                header("Location: ../admin.php?error=userTaken&mail=" . $uMail);
                exit();
            }
            else {
                
                $sql = "UPDATE forumusers SET uFName='$uFName', uLName='$uLName', uName='$uName', uMail='$uMail', uAdress='$uAdress', uPhone='$uPhone', uRole='$uRole' WHERE uID='$uID'";

                if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
                    header("Location: ../admin.php?success=updated");
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
            header("Location: ../admin.php?success=updated");
            exit();

            } else {
            echo "Error updating record: " . mysqli_error($conn);
            }

        }


        

    }

mysqli_close($conn);

}
else {
    header("Location: ../admin.php");
    exit();

}

?>