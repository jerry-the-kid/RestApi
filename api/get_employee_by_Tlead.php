<?php
require_once ('./template.php');
require_once ('../truongphong_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$id = isset($_POST['id']) ? $_POST['id'] : null;

if(!$id) error_response(3, 'ID not found');

$data = getEmployeeByTeamLead($id);
if(!$data) {
    error_response(2 , 'Error occur! Data not found');
}

success_response($data, 'Success');