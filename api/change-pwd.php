<?php
require_once ('./template.php');
require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if(isset($_POST['id']) && isset($_POST['pwd']) && isset($_POST['oldPwdCheck'])){
        $id = $_POST['id'];
        $pwd = $_POST['pwd'];
        $oldPwdCheck = $_POST['oldPwdCheck'];

        if(empty($id) || empty($pwd)){
            error_response(1, 'Empty input');
        }

        $userAccount = getUserAccountById($id)[0];

        if(strlen($pwd) < 6){
            error_response(2, "Mật khẩu mới phải có ít nhất 6 ký tự");
        }

        if(!password_verify($oldPwdCheck, $userAccount['PASSWORD'])){
            error_response(2, "Mật khẩu cũ không chính xác");
        }

        if(password_verify($pwd, $userAccount['PASSWORD'])){
            error_response(3, "Mật khẩu mới không được chùng với mật khẩu cũ");
        }

        change_pwd($userAccount['USER_NAME'], $pwd);
        success_response(true, "Cập nhật mật khẩu thành công");
    }
    else error_response(1, 'Invalid input');
?>