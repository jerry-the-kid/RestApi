<?php
require_once ('./template.php');
require_once ('../truongphong_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$id = isset($_POST['id']) ? $_POST['id'] : null;
$pb = isset($_POST['pb']) ? $_POST['pb'] : null;

if(!$id || !$pb) error_response('2', 'Thông tin còn thiếu.');

$data = addTeamLeader($pb, $id);

if($data === 0) {
    error_response('3', 'Thêm thất bại. Xin kiểm tra lại thông tin');
}

success_response($pb, "Phòng ban $pb thêm nhân viên $id thành công");

