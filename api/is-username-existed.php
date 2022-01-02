<?php
    require_once ('./template.php');
    require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support GET method only');
    }

    if(isset($_POST['username'])){
        $username = $_POST['username'];

        if(empty($username)){
            error_response(1 , 'Empty input');
        }

        $data = is_username_existed($username);
        if(!$data) {
            error_response(2 , 'Error occur! Data not found');
        }

        success_response($data, 'Success');
    }
    else error_response(1 , 'Invalid input');
    
?>