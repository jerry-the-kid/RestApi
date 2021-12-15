<?php
    session_start();
    require_once('../db.php');
    require_once('template.php');

    $con = getConnection();

    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }  
    $old_password= mysqli_real_escape_string($con,$_POST['oldPassword']);
    $new_password= mysqli_real_escape_string($con,$_POST['newPassword']);
    $username=$_SESSION['username'];

    $password_from_database_query="SELECT PASSWORD FROM account WHERE USER_NAME='$username'";
    $password_from_database_result=mysqli_query($con,$password_from_database_query) or die(mysqli_error($con));
    $row=mysqli_fetch_array($password_from_database_result);

    if($row['pass']==$old_password){
        $update_password_query="UPDATE account SET PASSWORD='$new_password', ACTIVE=1 WHERE USER_NAME='$username'";
        $update_password_result=mysqli_query($con,$update_password_query) or die(mysqli_error($con));
        success_response($update_password_result, 'Cập nhật mật khẩu thành công');
    }else{
        error_response(1, 'Nhập sai mật khẩu');
    }
?>