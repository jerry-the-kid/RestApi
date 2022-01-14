<?php
require_once ('../task_db.php');
require_once ('./template.php');


if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    error_response(1, 'API support POST method only');
}


$message = isset($_POST['message']) ? $_POST['message'] : null;
$id_task = isset($_POST['id_task']) ? $_POST['id_task'] : null;

if(!$message || !$id_task)
    error_response(1, 'Thông tin input còn thiếu');

$filePath = '';
if(isset($_FILES['file'])){
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    $file_ext=explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $extensions= array("exe","sh");

    if(in_array($file_ext,$extensions)=== true){
        error_response(4, 'Kiểu file không hợp lệ');
    }

    if($file_size > 104857600){
        error_response(5, 'File size quá lớn. Cần nhỏ hơn 100MB');
    }

    if($file_name){
        if (!is_dir('../file_nop')) {
            mkdir('../file_nop');
        }
        $filePath = '../file_nop/' . randomString(8) . '/' .$file_name;
        mkdir(dirname($filePath));
        move_uploaded_file($file_tmp, $filePath);
    }

}


$data = updateTaskToWaiting($id_task, $filePath, $message);
if($data === 1) success_response($id_task, 'Submit task thành công');
error_response(3, 'Submit task thất bại');