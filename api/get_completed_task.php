<?php
    require_once ('./template.php');
    require_once ('../render_completed_task_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    $id =isset($_POST['id']) ? $_POST['id'] : '';

    if(!$id) error_response(1, 'ID không tồn tại');

    $task = get_task($id);
    success_response($task, 'Đọc sản phẩm thành công');
?>