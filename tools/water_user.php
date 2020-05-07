<?php

if (isset($_SESSION['uRole'])) {

require "role_names.php";

echo '<p id="watermark">' . $_SESSION['uName'] . " " . $role . '</p>';

}?>