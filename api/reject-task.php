<?php
    require_once('./template.php');
    require_once('../render_task_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if (isset($_POST['id']) && isset($_POST['tleadMessage']) && isset($_POST['deadline'])) {

        $id = $_POST['id'];
        $tleadMessage = $_POST['tleadMessage'];
        $deadline = $_POST['deadline'];

        if (empty($id) || empty($tleadMessage) || empty($deadline)) {
            http_response_code(400);
            error_response(1, "Input are empty");
        }

        if (!is_dir('../file_gui')) {
            mkdir('../file_gui');
        }

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

            $file = $_FILES['file'];
            $filePath = '../file_gui/' . randomString(8) . '/' . $file['name'];
            mkdir(dirname($filePath));

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                reject_task($id, $deadline, $filePath, $tleadMessage);
                success_response(1, "success");
            } 
            else {
                http_response_code(400);
                error_response(1, 'Something went wrong with file');
            }
        }
        else{
            reject_task($id, $deadline, NULL, $tleadMessage);
            success_response(1, "success");
        }
    }
    else{
        http_response_code(400);
        error_response(1, 'Invalid input');
    }

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

    // Hàm xóa folder không rỗng
    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);

            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        rrmdir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }

            reset($objects);
            rmdir($dir);
        }
    }

?>