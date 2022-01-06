<?php
    require_once ('../render_task_db.php');
    require_once ('./template.php');
    
    
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }
    
    
    if (isset($_POST['id']) && isset($_POST['employeeMessage'])) {
        $taskId = $_POST['id'];
        $employeeMessage = $_POST['employeeMessage'];

        if (!is_dir('../file_nop')) {
            mkdir('../file_nop');
        }

        $file = isset($_FILES['file']) ? $_FILES['file'] : error_response(1, 'Không nhận được file');
        $filePath = '../file_nop/' . randomString(8) . '/' . $file['name'];
        mkdir(dirname($filePath));

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
            update_reject_task($taskId, $employeeMessage, $filePath);
            success_response($taskId, "Task đã được cập nhật thành công");
        } else {
            http_response_code(400);
            error_response(1, 'Something went wrong with file');
        }
    }
    else{
        error_response(1, 'API support POST method only');
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
?>