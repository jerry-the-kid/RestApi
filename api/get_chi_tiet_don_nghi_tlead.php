<?php
require_once ('./template.php');
require_once ('../truongphong_db.php');

if($_SERVER['REQUEST_METHOD'] != 'GET'){
    http_response_code(405);
    error_response(1, 'API support GET method only');
}

$id =isset($_GET['id']) ? $_GET['id'] : '';

if(!$id) error_response(1, 'ID không tồn tại');

$task = getchitietDonNghiTlead($id);
success_response($task, 'Đọc sản phẩm thành công');
?>