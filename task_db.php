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


function createTaskForNewTask($tieude, $mota, $deadline, $support_folder_path)
{
    $coon = getConnection();
    $sql = "INSERT INTO task(TIEU_DE, MO_TA, DEADLINE, SUPPORT_FOLDER_PATH)
    VALUE (?, ?, ?, ?)";
    $stm = $coon->prepare($sql);
    $stm->bind_param('ssss', $tieude, $mota, $deadline, $support_folder_path);
    $stm->execute();
    if ($stm->affected_rows == 1) {
        return $stm->insert_id;
    }
    return 0;
}

function createNewTask($taskId, $maNguoiGiao, $maNguoiNhan)
{
    $coon = getConnection();
    $sql = "INSERT INTO task_info(TASK_ID, MA_NGUOI_GIAO, MA_NGUOI_NHAN, STATUS)
    VALUE (?, ?, ?, 'New')";
    $stm = $coon->prepare($sql);
    $stm->bind_param('iii', $taskId, $maNguoiGiao, $maNguoiNhan);
    $stm->execute();
    if ($stm->affected_rows == 1) {
        return 1;
    }
    return 0;
}


function changeStatusTask($taskId, $status)
{
    $coon = getConnection();
    $sql = "UPDATE task_info
    SET STATUS = ?
    WHERE TASK_ID = ?";
    $stm = $coon->prepare($sql);
    $stm->bind_param('si', $status, $taskId);
    $stm->execute();
    if ($stm->affected_rows == 1) {
        return 1;
    }
    return 0;
}

function updateTask($taskid, $tieude, $mota, $deadline, $support_folder_path, $maNguoiNhan){
    $coon = getConnection();
    $sql = "UPDATE task, task_info
    SET TIEU_DE = ?, MO_TA = ?, DEADLINE = ?, SUPPORT_FOLDER_PATH = ?, MA_NGUOI_NHAN = ?
    where TASK.TASK_ID = ? AND TASK_INFO.TASK_ID = ?";
    $stm = $coon->prepare($sql);
    $stm->bind_param('ssssiii', $tieude, $mota, $deadline, $support_folder_path, $maNguoiNhan, $taskid, $taskid);
    $stm->execute();
    if ($stm->execute()) {
        return 1;
    }
    return 0;
}
