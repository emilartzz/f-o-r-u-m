<?php

    // ANGER NAMN TILL ROLES SÅSOM TYP MEMBER OSV
    if ($_SESSION['uRole'] === 0) {
        $role = '[Member]';
    }
    else if ($_SESSION['uRole'] === 1) {
        $role = '[Admin]';
    }
    else if ($_SESSION['uRole'] === 2) {
        $role = '[Developer]';
    }
    else{
        $role = '[Error SE01]';
    }


?>