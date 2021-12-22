<?php
require_once('./template.php');
require_once('../truongphong_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$id = isset($_POST['id']) ? $_POST['id'] : '';

if(!$id) error_response(1, 'ID undefined.');

$data = getTeamLeadByDepartment($id);
if (!$data) {
    error_response(2, "Department don't have employee.");
}

success_response($data, 'Success');
