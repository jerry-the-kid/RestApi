<?php
require_once ('./template.php');
require_once ('../don_nghi_tlead_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}

$dn = isset($_POST['dn']) ? $_POST['dn'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

if(!$dn) error_response(2, 'DN is required. Please enter');
if(!$status) error_response(3, 'Status is required. Please enter');

$data = updateDetailDonNghi($dn, $status);
if($data == 1) {
    success_response($dn,"Đơn $dn đã được sửa thành công" );
}

error_response(4, 'Không thể sửa. Có lỗi xảy ra');