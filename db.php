<?php

function getConnection(){
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $db = 'company_manager';

    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error){
        die('Cannot connect : '.$conn->connect_error);
    }
    return $conn;
}
