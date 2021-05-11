<?php
    session_start();
    $db_host       = 'localhost';
    $db_name       = 'problem';
    $db_username   = 'root';
    $db_password   = 'root';
    $connect = mysqli_connect( $db_host, $db_username, $db_password, $db_name );

    if(!$connect){
        echo "Не удалось подключиться к БД!";
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    }