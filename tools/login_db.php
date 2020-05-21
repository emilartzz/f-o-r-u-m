<?php
// KOLLAR RÄTT KNAPP
if (isset($_POST['login_submit'])) {
    require "db_conn.php";
    // VARIABLER
    $uName = $_POST['uName'];
    $uMail = $_POST['uMail'];
    $uPass = $_POST['uPass'];
    // KOLLAR TOMT
    if (empty($uMail) || empty($uPass)) {
        header("Location: ../login.php?error=emptyFields");
        exit();
    }
    else {
        // SELECT OCH KOLLA OM DET FUNKAR
        $sql = "SELECT * FROM forumusers WHERE uName=? OR uMail=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlError");
            exit();
        }
        else {
            // KOLLA OM ANVÄNDARNAMNET OCH LÖSENORDET PASSAR
            mysqli_stmt_bind_param($stmt, "ss", $uMail, $uMail);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($results)) {
                $hshPass = password_verify($uPass, $row['uPass']);
                // PASSAR DET INTE GÅR MAN TILLBAKS TILL LOGIN MED FELMEDDELANDE WRONG PASS OR USER ("wrongPassOrUser")
                if ($hshPass === false) {
                    header("Location: ../login.php?error=wrongPassOrUser");
                    exit();
                }
                else if ($hshPass === true) {
                    // STARTA EN SESSION MED MASSA "SESSION VARIABLAR"
                    session_start();
                    $_SESSION['uID'] = $row['uID'];
                    $_SESSION['uFName'] = $row['uFName'];
                    $_SESSION['uLName'] = $row['uLName'];
                    $_SESSION['uName'] = $row['uName'];
                    $_SESSION['uMail'] = $row['uMail'];
                    $_SESSION['uAdress'] = $row['uAdress'];
                    $_SESSION['uPhone'] = $row['uPhone'];
                    $_SESSION['uRole'] = $row['uRole'];
                    // KOLLA ÄVEN OM ANVÄNDAREN ÄR BLOCKAD/DISABLED
                    require 'check_account.php';

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../login.php?error=wrongPass");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=noUser");
                exit();
            }
        }
    }
}
else {
    header("Location: ../index.php");
    exit();
}

?>