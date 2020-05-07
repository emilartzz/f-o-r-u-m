<?php

require_once "db_conn.php";

if (!$conn){
    die("ERROR: Could not connect.." . mysqli_connect_error());
}
else{
    echo "Connected successfully. <br><br> Host info : " . mysqli_get_host_info($conn);
}

?>