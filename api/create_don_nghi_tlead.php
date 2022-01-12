<?php
require_once ('../don_nghi_tlead_db.php');
require_once ('./template.php');

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}


if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}


$tieu_de = isset($_POST['title']) ? $_POST['title'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : null;
$describe = isset($_POST['description']) ?  $_POST['description'] : null;
$sender = isset($_POST['sender']) ? $_POST['sender'] : null;

if(!$tieu_de || !$date || !$describe || !$sender)
    error_response(1, 'Thông tin input còn thiếu');

$filePath = '';
if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    if($file_name){
        if (!is_dir('../minh_chung')) {
            mkdir('../minh_chung');
        }
        $filePath = '../minh_chung/' . randomString(8) . '/' .$file_name;
        mkdir(dirname($filePath));
        move_uploaded_file($file_tmp, $filePath);
    }

}

$id= createDonNghi($tieu_de, $date, $describe, $filePath);
if($id === 0) error_response(2, 'Tạo đơn nghỉ thất bại');

$data = createChiTietDN($sender, $id);
if($data === 1) success_response($id, 'Tạo đơn nghỉ : '.$tieu_de.' thành công');
error_response(3, 'Tạo đơn nghỉ mới thất bại');