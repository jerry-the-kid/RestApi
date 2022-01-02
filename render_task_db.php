<?php
require_once('db.php');

function get_task($id){
    $sql = "SELECT `task`.`TIEU_DE`, `task_info`.`MA_NGUOI_NHAN`, `user`.`HO_TEN`, `task_info`.`STATUS`, `task`.`DEADLINE` FROM `task`, `task_info`, `user`, `user_info` WHERE `task_info`.`STATUS` != 'Completed' AND `task_info`.`STATUS` != 'Canceled' AND `task_info`.`MA_NGUOI_NHAN` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `task`.`TASK_ID` = `task_info`.`TASK_ID` AND `task_info`.`MA_NGUOI_NHAN` = `user`.`MA_USER`";
    $conn = getConnection();
    $result = $conn->query($sql);
    $output = array();
    while(($row = $result->fetch_assoc())){
        $output[] = $row;
    }
    return $output;
}

?>