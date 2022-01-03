<?php
require_once('db.php');

function get_task_employee($id){
    $sql = "SELECT `task`.`TIEU_DE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` != 'Completed' AND `task_info`.`STATUS` != 'Canceled' AND `task_info`.`MA_NGUOI_NHAN` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}


function get_completed_task_employee($id){
    $sql = "SELECT `task`.`TIEU_DE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task_info`.`COMPLETE_STATUS` ,`task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` = 'Completed' AND `task_info`.`MA_NGUOI_NHAN` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`";
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
    $sql = "SELECT TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS
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
    $sql = "SELECT TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS
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
    $sql = "SELECT TIEU_DE, MA_NGUOI_NHAN, HO_TEN, DEADLINE, STATUS
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



?>