<?php
// KOLLA OM ROLE ÄR "SET"
if (isset($_SESSION['uRole'])) {
// KOLLA MED ROLE_NAMES.PHP
require "role_names.php";
// SKRIV UT NAMN OCH ROLE
echo '<p id="watermark">' . $_SESSION['uName'] . " " . $role . '</p>';

}?>