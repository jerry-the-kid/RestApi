<?php
    require_once ('./template.php');
    require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if(isset($_POST['username'])){
        $username = $_POST['username'];

        if(empty($username)){
            error_response(1, 'Empty input');
        }

        reset_password($username);
        success_response(true, "Reset mật khẩu thành công");
    }
    else error_response(1, 'Invalid input');
?>