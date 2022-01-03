<?php
require_once ('../task_db.php');
require_once ('./template.php');


if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}


$tieu_de = isset($_POST['task']) ? $_POST['task'] : null;
$deadline = isset($_POST['deadline']) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($_POST['deadline'])) : null;
$nhan_vien_nhan = isset($_POST['nhanvien']) ? $_POST['nhanvien'] : null;
$describe = isset($_POST['describe']) ?  $_POST['describe'] : null;
$sender = isset($_POST['sender']) ? $_POST['sender'] : null;

if(!$tieu_de || !$deadline || !$nhan_vien_nhan || !$describe || !$sender)
    error_response(1, 'Thông tin input còn thiếu');

$filePath = '';
if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    if($file_name){
        if (!is_dir('../file_gui')) {
            mkdir('../file_gui');
        }
        $filePath = '../file_gui/' . randomString(8) . '/' .$file_name;
        mkdir(dirname($filePath));
        move_uploaded_file($file_tmp, $filePath);
    }

}

$id_task = createTaskForNewTask($tieu_de, $describe, $deadline, $filePath);
if($id_task === 0) error_response(2, 'Tạo task thất bại');

$data = createNewTask($id_task, $sender, $nhan_vien_nhan);
if($data === 1) success_response($id_task, 'Tạo task '.$tieu_de.' thành công');
error_response(3, 'Tạo task mới thất bại');