<?php
require_once ('./template.php');
require_once ('../truongphong_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$pb = isset($_POST['pb']) ? $_POST['pb'] : '';

if(!$id) error_response(2, 'ID is required. Please enter');
if(!$pb) error_response(3, 'PB is required. Please enter');

$data = updateTeamLeader($id, $pb);
if($data == 1) {
    success_response($id,"Phòng ban $pb đã được sửa trưởng phòng thành công" );
}

error_response(4, 'Phòng ban vẫn giữ nguyên, trưởng phòng không thay đổi.');