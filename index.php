<?php
    include_once('connect.php');
    if($_SESSION['user']) {
        include_once('main.php');
    }
    else {
        include_once('guest.php');
    }
?>