<?php
require_once('db.php');

function get_task_employee($id){
    $sql = "SELECT `task`.`TASK_ID`, `task`.`TIEU_DE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` != 'Completed' AND `task_info`.`STATUS` != 'Canceled' AND `task_info`.`MA_NGUOI_NHAN` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_completed_task_employee($id){
    $sql = "SELECT `task`.`TASK_ID`, `task`.`TIEU_DE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task_info`.`COMPLETE_STATUS` ,`task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` = 'Completed' AND `task_info`.`MA_NGUOI_NHAN` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_task_teamLead($id){
    $conn = getConnection();
    $sql = "SELECT t.TASK_ID, TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS
    FROM task t join task_info ti on t.TASK_ID = ti.TASK_ID
    join user on MA_NGUOI_NHAN = MA_USER
    where MA_NGUOI_GIAO = $id and STATUS not in ('canceled', 'completed')";
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_cancel_task_teamLead($id){
    $conn = getConnection();
    $sql = "SELECT t.TASK_ID, TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS, SUPPORT_FOLDER_PATH
    FROM task t join task_info ti on t.TASK_ID = ti.TASK_ID
    join user on MA_NGUOI_NHAN = MA_USER
    where MA_NGUOI_GIAO = $id and STATUS = 'canceled'";
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_completed_task_Tlead($id){
    $conn = getConnection();
    $sql = "SELECT t.TASK_ID, TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS, COMPLETE_STATUS
    FROM task t join task_info ti on t.TASK_ID = ti.TASK_ID
    join user on MA_NGUOI_NHAN = MA_USER
    where MA_NGUOI_GIAO = $id and STATUS = 'completed'";
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}

function get_task($taskId){
    $conn = getConnection();
    $sql = "SELECT user.HO_TEN, task.TIEU_DE, task.MO_TA, task.DEADLINE, task.DATE_CREATE  ,task.SUPPORT_FOLDER_PATH, task.SUBMIT_FOLDER_PATH, task.message_employee,
            task.message_tlead, task_info.COMPLETE_STATUS
            FROM task, user, task_info
            WHERE task.TASK_ID = task_info.TASK_ID AND user.MA_USER = task_info.MA_NGUOI_GIAO AND task.TASK_ID = $taskId";

    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function reject_task($taskId, $deadline, $supportFile, $tleadMessage){
    $conn = getConnection();

    $sql = "";

    if(empty($supportFile)){
        $sql = "UPDATE task
                SET DEADLINE = '$deadline', message_tlead = '$tleadMessage'
                WHERE TASK_ID = $taskId";
    }
    else{
        $newSupportFile = "+" . $supportFile;

        $sql = "UPDATE task
                SET DEADLINE = '$deadline', SUPPORT_FOLDER_PATH = concat(SUPPORT_FOLDER_PATH, '$newSupportFile'),
                message_tlead = '$tleadMessage'
                WHERE TASK_ID = $taskId";
    }
    
    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }

    $sql = "UPDATE task_info
            SET task_info.STATUS = 'Rejected'
            WHERE TASK_ID = $taskId";

    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }

    return 1;
}

function get_inprogress_task_detail($id){
    $sql = "SELECT `task`.`TASK_ID`, `task`.`TIEU_DE`, `task`.`MO_TA`, `task`.`SUPPORT_FOLDER_PATH`, `task`.`SUBMIT_FOLDER_PATH`, `task`.`DATE_CREATE`, `task_info`.`MA_NGUOI_GIAO`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` = 'In progress' AND `task`.`TASK_ID` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_GIAO` = `user`.`MA_USER`;";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_reject_task_detail($id){
    $sql = "SELECT `task`.`TASK_ID`, `task`.`TIEU_DE`, `task`.`MO_TA`, `task`.`SUPPORT_FOLDER_PATH`, `task`.`SUBMIT_FOLDER_PATH`, `task`.`DATE_CREATE`, `task_info`.`MA_NGUOI_GIAO`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` = 'Rejected' AND `task`.`TASK_ID` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_GIAO` = `user`.`MA_USER`;";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}

function get_new_task_detail($id){
    $sql = "SELECT `task`.`TASK_ID`, `task`.`TIEU_DE`, `task`.`MO_TA`, `task`.`SUPPORT_FOLDER_PATH`, `task`.`SUBMIT_FOLDER_PATH`, `task`.`DATE_CREATE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` = 'New' AND `task`.`TASK_ID` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`;";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}

function complete_task($taskId, $completeStatus){
    $conn = getConnection();

    $sql = "UPDATE task_info
            SET task_info.STATUS = 'Completed', task_info.COMPLETE_STATUS = '$completeStatus'
            WHERE TASK_ID = $taskId";

    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }

    return 1;
}

function update_reject_task($taskId, $employeeMessage, $submitFolder){
    $conn = getConnection();

    $newSubmitFilePath = "+" . $submitFolder;

    $sql = "UPDATE task
            SET task.SUBMIT_FOLDER_PATH = concat(task.SUBMIT_FOLDER_PATH, '$newSubmitFilePath'),
            task.message_employee = '$employeeMessage'
            WHERE TASK_ID = $taskId";

    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }

    $sql = "UPDATE task_info
            SET task_info.STATUS = 'Waiting'
            WHERE TASK_ID = $taskId";

    $stm = $conn->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }

    return 1;
}

?>