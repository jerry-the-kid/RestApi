<?php
session_start();
require_once ('../header.php');
if(isset($_SESSION['user_id'])){
    locationEmployeePage($_SESSION['position'], $_SESSION['active']);
}else{
    header('Location: ../index.php');
}
