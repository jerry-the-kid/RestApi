<?php
require_once('db.php');
function getDepartments()
{
    $coon = getConnection();
    $sql = 'SELECT MA_PHONG_BAN, TEN_PB, SO_PHONG
    FROM phong_ban';
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


function getInfoDepartment($pb){
    $coon = getConnection();
    $sql = 'SELECT TEN_PB, SO_PHONG, tp.MA_PHONG_BAN, MA_NV, HO_TEN, MO_TA
    FROM phong_ban pb JOIN truong_phong tp USING (MA_PHONG_BAN) JOIN user_info ui USING (MA_NV)
    JOIN user USING (MA_USER)
    WHERE pb.MA_PHONG_BAN = ?';
    $stm = $coon->prepare($sql);
    $stm->bind_param('i', $pb);
    $stm->execute();
    $result = $stm->get_result();
    $result = $result->fetch_all(MYSQLI_ASSOC);
    if(!$result) return 0;
    return $result;
}

function addDepartment($ten, $mota, $sophong){
    $coon = getConnection();
    $sql = "INSERT INTO phong_ban (TEN_PB, MO_TA, SO_PHONG)
    VALUES (?, ?, ?)";
    $stm = $coon->prepare($sql);
    $stm->bind_param('sss', $ten , $mota, $sophong);
    if(!$stm->execute()){
        return  0;
    }
    return 1;
}

function updateDepartment($mapb, $ten, $mota, $sophong){
    $conn = getConnection();
    $sql = 'UPDATE phong_ban
    SET TEN_PB = ?, MO_TA = ?, SO_PHONG = ?
    WHERE MA_PHONG_BAN = ?;';
    $stm = $conn->prepare($sql);
    $stm->bind_param('sssi', $ten, $mota, $sophong, $mapb);
    $stm->execute();
    if($stm->affected_rows == 1){
        return 1;
    }
    return  0;
}

function getDepartment($dp){
    $coon = getConnection();
    $sql = 'SELECT ten_pb, mo_ta, so_phong
    FROM phong_ban
    where MA_PHONG_BAN = ?';
    $stm = $coon->prepare($sql);
    $stm->bind_param('i', $dp);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


function deleteDepartment($mapb){
    $conn = getConnection();
    $sql = 'DELETE FROM phong_ban
    WHERE MA_PHONG_BAN = ?;';
    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $mapb);
    $stm->execute();
    if($stm->affected_rows == 1){
        return 1;
    }
    return  0;
}