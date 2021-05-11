<?php
    include_once('connect.php');
    unset($_SESSION['user']);
    header('Location:  index.php');
?>