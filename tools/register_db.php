<?php
// KOLLAR KNAPP RÄTT? "register_submit"
if (isset($_POST['register_submit'])) {
 
    require "db_conn.php";
    // VARIABLER
    $uFName = $_POST['uFName'];
    $uLName = $_POST['uLName'];
    $uName = $_POST['uName'];
    $uMail = $_POST['uMail'];
    $uAdress = $_POST['uAdress'];
    $uPhone = $_POST['uPhone'];
    $uPass = $_POST['uPass'];
    $uVerPass = $_POST['uVPass'];
    $member = 0;
    // KOLLAR SÅ ALL INFO FINNS OCH ÄR MED RIKTIGA BOKSTÄVER OSV LINE 17-36
    if (empty($uFName) || empty($uLName) || empty($uName) || empty($uMail) || empty($uAdress) || empty($uPhone) || empty($uPass) || empty($uVerPass)){
        header("Location: ../register.php?error=emptyFields&uid=" . $uName . "&mail=" . $uMail);
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../register.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($uMail, FILTER_VALIDATE_EMAIL)){
        header("Location: ../register.php?error=invalidMail&uid=" . $uName);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uName)){
        header("Location: ../register.php?error=invalidUname&mail=" . $uMail);
        exit();
    }
    else if ($uPass !== $uVerPass){
        header("Location: ../register.php?error=passwordCheck&mail=" . $uMail);
        exit();
    }
    else {
        // SELECT UNAME OCH KOLLA OM ANVÄNDARNAMNER ÄR TAGET LINE 39-53
        $sql = "SELECT uName FROM forumusers WHERE uName=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../register.php?error=sqlError");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $uName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0){
                header("Location: ../register.php?error=userTaken&mail=" . $uMail);
                exit();
            }
            // OM INTE TAGET GÅ VIDARE
            else {
                // LÄGG IN ALLT I DATABASEN
                $sql = "INSERT INTO forumusers (uFName, uLName, uName, uMail, uAdress, uPhone, uPass, uRole) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../register.php?error=sqlError");
                    exit();
                }
                else {
                    // HASHA LÖSENORDET MED PASSWORD_HASH
                    $hshpass = password_hash($uPass, PASSWORD_DEFAULT);
                    // BINDA VARIABLERNA TILL INFO SOM SKA IN I DATABASEN
                    mysqli_stmt_bind_param($stmt, "ssssssss", $uFName, $uLName, $uName, $uMail, $uAdress, $uPhone, $hshpass, $member);
                    // EXECUTA ALLT
                    mysqli_stmt_execute($stmt);
                    header("Location: ../login.php?signup=success");
                    exit();
                }

            }
        }

    }
// STÄNG CONNECTION OSV
mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else {
    header("Location: ../register.php");
    exit();

}

?>