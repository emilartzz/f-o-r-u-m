<?php
// KRÄV DB_CONN
require_once "db_conn.php";
// KOLLA OM CONNECTION FUNKAR
if (!$conn){
    // SKRIV UT ERROR
    die("ERROR: Could not connect.." . mysqli_connect_error());
}
else{
    // SKRIV UT SUCCESS INFO
    echo "Connected successfully. <br><br> Host info : " . mysqli_get_host_info($conn);
}

?>