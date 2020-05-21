<?php

require "db_conn.php";
// VARIABLER OSV
$uID=$_SESSION['uID'];
$uMail=$_SESSION['uMail'];
$uName=$_SESSION['uName'];
// KOLLAR DISABLE VÄRDET I DATABASEN
$sql = "SELECT uDisabled FROM forumusers WHERE uName=? AND uMail=? AND uID=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlError");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "sss", $uName, $uMail, $uID);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($results)) {
                // OM ANVÄNDAREN HAR 1 SOM DISABLED SÅ ÄR DEN DISABLED OCH SKA DÄRFÖR VARA UTLOGGAD. SKICKAR DÅ TILLBAKS TILL INDEX OCH DESTROY SESSION
                if ($row['uDisabled'] == 1) {
                    session_start();
                    session_unset();
                    session_destroy();
                    header("Location: ../index.php?error=accountDisabled");
                }
            }
        }

?>