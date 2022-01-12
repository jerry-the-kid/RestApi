<?php
require_once ('./template.php');
require_once ('../don_nghi_tlead_db.php');

if($_SERVER['REQUEST_METHOD'] != 'GET'){
    http_response_code(405);
    error_response(1, 'API support GET method only');
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$id) error_response(3 , 'Error occur! ID not found');

$data = getSoNgayNghiTrongNam($id);
if(!$data) {
    error_response(2 , 'Error occur! Data not found');
}

success_response($data, 'Success');