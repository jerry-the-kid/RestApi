<?php
require_once ('./template.php');
require_once ('../phongban_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$pb = isset($_POST['pb']) ? $_POST['pb'] : null;
$data = getInfoDepartment($pb);
if(!$data) {
    error_response(2 , 'Error occur! Data not found');
}

success_response($data, 'Success');