<?php
	session_start();
    require_once('../db.php');
    require_once('template.php');

    $con = getConnection();

    $username=mysqli_real_escape_string($con,$_POST['username']);

    $password=mysqli_real_escape_string($con,$_POST['pass']);
    if(strlen($password)<6){
        error_response(2, 'Mật khẩu quá ngắn');
    }

    $duplicate_user_query="SELECT USER_NAME FROM account WHERE USER_NAME='$username'";
    $duplicate_user_result=mysqli_query($con,$duplicate_user_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($duplicate_user_result);
    if($rows_fetched>0){
    	error_response(3, 'Tài khoản đã tồn tại');
    }
    else{
    	$user_registration_query="INSERT INTO account(USER_NAME,PASSWORD,ACTIVE) values ('$username',password_hash('$password', PASSWORD_DEFAULT),0)";
    	$user_registration_result=mysqli_query($con,$user_registration_query) or die(mysqli_error($con));
    	success_response($user_registration_result, 'Tạo tài khoản thành công');
    }
?>