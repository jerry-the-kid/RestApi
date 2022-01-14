<?php
require_once ('./template.php');
require_once ('../truongphong_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$pb = isset($_POST['pb']) ? $_POST['pb'] : null;

if(!$pb) error_response(2, 'Mã PB trống');

$data = deletedTruongPhong($pb);

if($data === 1) {
    return success_response($pb, "Xóa trưởng phòng của $pb thành công");
}

error_response(3, 'Xóa thất bại! Trưởng phòng đang còn task giao cho nhân viên.');