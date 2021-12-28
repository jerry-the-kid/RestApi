<?php
require_once ('./template.php');
require_once ('../phongban_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$mapb = isset($_POST['id']) ? $_POST['id'] : null;

if(!$mapb) error_response(2, 'Mã phòng ban ban còn thiếu. Vui lòng nhập');

$data = deleteDepartment($mapb);
if(!$data) error_response(3, 'Xóa thất bại.');
success_response($mapb, "Phòng ban PB$mapb được xóa thành công.");
