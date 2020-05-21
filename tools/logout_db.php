<?php
// LOGGA UT, DESTROY SESSION OSV. MYCKET MED ATT TA BORT OCH FÖRSTÖRA DEN SESSION SOM ÄR AKTIV
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");

?>