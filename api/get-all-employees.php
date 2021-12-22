<?php

    require_once ('./template.php');
    require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'GET'){
        http_response_code(405);
        error_response(1, 'API support GET method only');
    }


    $data = getAllEmployees();
    if(!$data) {
        error_response(2 , 'Error occur! Data not found');
    }

    success_response($data, 'Success');
?>