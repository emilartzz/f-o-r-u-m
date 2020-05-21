<?php

session_start();

require "db_conn.php";
// KOLLA ANVÄNDARE LOGGAD IN
if (!isset($_SESSION['uID'])) {
    header("Location: ../login.php");
}
// KOLLA SÅ ANVÄNDAREN ÄR ADMIN
if ($_SESSION['uRole'] != 1) {
    header('Location: ../dashboard.php'); 
}
// KOLLAR OM DISABLE ÄR KLICKAT
if (isset($_POST['a_disable'])) {

    $uID = $_POST['admin_select_user_2'];
    // SELECT DISABLED OSV
    $sql = "SELECT uDisabled FROM forumusers WHERE uID=$uID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        // ENKEL LÖSNING PÅ ATT GE ETT MOTSATT VÄRDE TILL NUVARANDE
        if ($row['uDisabled'] == 0) {
            $uDis = 1;
        }
        else {
            $uDis = 0;
        }

            // UPDATERA NUVARANDE UDISABLED I DATABASEN TILL MOTSATTA VÄRDE
    $sql = "UPDATE forumusers SET uDisabled= $uDis WHERE uID=$uID";
                
        // KOLLAR SÅ ALLT FUNKAR OCH SKICKAR TILLBAKS ANVÄDNARE TILL ADMIN PANEL MED MEDDELANDE DISABLED (success=disabled)
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        header('Location: ../admin.php?success=disabled');
        exit();
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    }
}
// KOLLAR OM DELETE VAR KLICKAT
if (isset($_POST['a_delete'])) {
    // KOLLAR VILKEN ANVÄNDARE VAR SELECTED
    $uID = $_POST['admin_select_user_2'];
    // TAR BORT ANVÄNDARE
    $sql = "DELETE FROM forumusers WHERE uID=$uID";
    // SKICKAR TILLBAKS MED DELETED "success=deleted"
    if ($conn->query($sql) === TRUE) {
      header('Location: ../admin.php?success=deleted');
    } else {
      echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();


}


?>