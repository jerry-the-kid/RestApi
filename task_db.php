<?php
require_once('db.php');

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



function createTaskForNewTask($tieude, $mota, $deadline, $support_folder_path){
    $coon = getConnection();
    $sql = "INSERT INTO task(TIEU_DE, MO_TA, DEADLINE, SUPPORT_FOLDER_PATH)
    VALUE (?, ?, ?, ?)";
    $stm = $coon->prepare($sql);
    $stm->bind_param('ssss', $tieude, $mota, $deadline, $support_folder_path);
    $stm->execute();
    if($stm->affected_rows == 1) {
        return $stm->insert_id;
    }
    return 0;
}

function createNewTask($taskId, $maNguoiGiao, $maNguoiNhan){
    $coon = getConnection();
    $sql = "INSERT INTO task_info(TASK_ID, MA_NGUOI_GIAO, MA_NGUOI_NHAN, STATUS)
    VALUE (?, ?, ?, 'New')";
    $stm = $coon->prepare($sql);
    $stm->bind_param('iii', $taskId, $maNguoiGiao, $maNguoiNhan);
    $stm->execute();
    if($stm->affected_rows == 1) {
        return 1;
    }
    return 0;
}
