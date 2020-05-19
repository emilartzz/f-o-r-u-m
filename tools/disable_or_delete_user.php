<?php

session_start();

require "db_conn.php";

if (!isset($_SESSION['uID'])) {
    header("Location: ../login.php");
}

if ($_SESSION['uRole'] != 1) {
    header('Location: ../dashboard.php'); 
}

if (isset($_POST['a_disable'])) {

    $uID = $_POST['admin_select_user_2'];

    $sql = "SELECT uDisabled FROM forumusers WHERE uID=$uID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if ($row['uDisabled'] == 0) {
            $uDis = 1;
        }
        else {
            $uDis = 0;
        }

            
    $sql = "UPDATE forumusers SET uDisabled= $uDis WHERE uID=$uID";
                

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        header('Location: ../admin.php?success=submit');
        exit();
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    }
}

if (isset($_POST['a_delete'])) {

    $uID = $_POST['admin_select_user_2'];

    $sql = "DELETE FROM forumusers WHERE uID=$uID";
    
    if ($conn->query($sql) === TRUE) {
      header('Location: ../admin.php?success');
    } else {
      echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();


}


?>