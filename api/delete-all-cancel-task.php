<?php
    require_once('./template.php');
    require_once('../task_db.php');
    require_once('../render_task_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if(!$id) error_response(1, 'ID không tồn tại');

    $taskList = get_cancel_task_teamLead($id);
    
    foreach ($taskList as &$task) {
        deleteTask($task['TASK_ID']);
        rrmdir(dirname($task['SUPPORT_FOLDER_PATH']));
    }

    success_response(true, "Xóa Thành Công");

?>
