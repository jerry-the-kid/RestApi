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
$taskId =  isset($_POST['task_id']) ?  $_POST['task_id'] : null;
$oldPath = isset($_POST['old_file_path']) ? $_POST['old_file_path'] : null;

$folder_old = explode('/', $oldPath);
array_pop($folder_old);
$folder_old = implode('/', $folder_old);
if(!$tieu_de || !$deadline || !$nhan_vien_nhan || !$describe || !$taskId)
    error_response(1, 'Thông tin input còn thiếu');

$filePath = $oldPath;
if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    if($file_name){
        rrmdir($folder_old);
        if (!is_dir('../file_gui')) {
            mkdir('../file_gui');
        }
        $filePath = '../file_gui/' . randomString(8) . '/' .$file_name;
        mkdir(dirname($filePath));
        move_uploaded_file($file_tmp, $filePath);
    }

}


$res = updateTask($taskId, $tieu_de, $describe, $deadline, $filePath, $nhan_vien_nhan);
if($res == 0) error_response(2, 'Error');

success_response($taskId, "Task $tieu_de đã được cập nhật thành công");