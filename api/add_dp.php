<?php
require_once ('./template.php');
require_once ('../phongban_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$ten = isset($_POST['ten']) ? $_POST['ten'] : null;
$mota = isset($_POST['mota']) ? $_POST['mota'] : null;
$soPhong = isset($_POST['phong']) ? $_POST['phong'] : null;

if(!$ten) error_response(2, 'Tên phòng ban còn thiếu. Vui lòng nhập');
if(!$mota) error_response(3, 'Mô tả phòng ban còn thiếu. Vui lòng nhập');
if(!$soPhong) error_response(4, 'Số phòng còn thiếu vui lòng nhập');

$data = addDepartment($ten, $mota, $soPhong);
if(!$data) error_response(5, 'Thêm thất bại. Xin kiểm tra lại thông tin');
success_response($ten, "Phòng ban $ten được thêm thành công.");
