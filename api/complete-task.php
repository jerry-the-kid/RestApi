<?php
    require_once('./template.php');
    require_once('../render_task_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if(isset($_POST['id']) && isset($_POST['completeStatus'])){
        $id = $_POST['id'];
        $completeStatus = $_POST['completeStatus'];

        if(empty($id) || empty($completeStatus)){
            http_response_code(400);
            error_response(1, "Input are empty");
        }

        if(complete_task($id, $completeStatus) == 0){
            error_response(1, "Cannot complete task");
        }
        else success_response(1, "success");
    }
    else error_response(1, "Không nhận được input");
?>