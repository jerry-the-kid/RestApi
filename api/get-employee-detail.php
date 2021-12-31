<?php

    require_once ('./template.php');
    require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'GET'){
        http_response_code(405);
        error_response(1, 'API support GET method only');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        if(empty($id)){
            error_response(1 , 'Id rỗng');
        }

        $data = getEmployeeDetail($id);
        if(!$data) {
            error_response(1 , 'Error occur! Data not found');
        }
    
        success_response($data, 'Success');
    }
    else error_response(1 , 'Không nhận được id');

    
?>