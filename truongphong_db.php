<?php
require_once('db.php');
function getInfoTeamLeader()
{
    $coon = getConnection();
    $sql = 'select DISTINCT pb.MA_PHONG_BAN, TP.MA_NV, TEN_PB, u.HO_TEN
    from user_info ui join phong_ban pb using (MA_PHONG_BAN)
    join truong_phong tp using (MA_PHONG_BAN)
    join user u on ui.MA_USER = u.MA_USER
    where tp.MA_NV = ui.MA_NV';
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getTeamLeadByDepartment($department)
{
    $coon = getConnection();
    $sql = 'SELECT MA_NV, HO_TEN
    FROM user
    JOIN user_info ui on user.MA_USER = ui.MA_USER
    WHERE MA_PHONG_BAN = ?';
    $stm = $coon->prepare($sql);
    $stm->bind_param('i', $department);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getDepartmentToCreate()
{
    $coon = getConnection();
    $sql = 'SELECT MA_PHONG_BAN, TEN_PB
    FROM phong_ban
    WHERE MA_PHONG_BAN NOT IN (SELECT MA_PHONG_BAN
    FROM truong_phong)';
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateTeamLeader($id, $pb){
    $conn = getConnection();
    $sql = 'UPDATE truong_phong
    SET MA_NV = ?
    WHERE MA_PHONG_BAN = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('ii', $id, $pb);
    $stm->execute();
    if($stm->affected_rows == 1){
        return 1;
    }
    return  0;
}


function addTeamLeader($pb, $id){
    $conn = getConnection();
    $sql = "INSERT INTO truong_phong (MA_PHONG_BAN, MA_NV) VALUES (?, ?)";
    $stm = $conn->prepare($sql);
    $stm->bind_param('ii', $pb, $id);
    if(!$stm->execute()){
        return 0;
    }
    return 1;
}

function deletedTruongPhong($pb){
    $conn = getConnection();
    $sql = 'DELETE FROM truong_phong
    WHERE MA_PHONG_BAN = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $pb);
    $stm->execute();
    if($stm->affected_rows == 1){
        return 1;
    }
    return  0;
}

function getEmployeeByTeamLead($id){
    $coon = getConnection();
    $sql = 'SELECT HO_TEN, ui.MA_NV
    from truong_phong tp join user_info ui using (MA_PHONG_BAN)
    join user u on ui.MA_USER = u.MA_USER
    where tp.MA_NV = ? and ui.MA_NV != ?';
    $stm = $coon->prepare($sql);
    $stm->bind_param('ii', $id, $id);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getDonNghiTlead(){
    $coon = getConnection();
    $sql = 'SELECT `don_nghi`.`TIEU_DE`, `don_nghi`.`NOI_DUNG`, `don_nghi`.`MA_NGHI`, `chi_tiet_don_nghi`.`MA_NV`, `user`.`HO_TEN`, `don_nghi`.`SO_NGAY`, `don_nghi`.`TRANG_THAI`
            FROM `don_nghi`, `chi_tiet_don_nghi`, `user`, `user_info`, `truong_phong`
            WHERE `chi_tiet_don_nghi`.`MA_NV` = `truong_phong`.`MA_NV` AND `chi_tiet_don_nghi`.`MA_NGHI` = `don_nghi`.`MA_NGHI` AND
                `user`.`MA_USER` = `user_info`.`MA_USER` AND `user_info`.`MA_NV` = `truong_phong`.`MA_NV`
            order by TRANG_THAI desc';
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getchitietDonNghiTlead($id){
    $coon = getConnection();
    $sql = "SELECT `don_nghi`.`TIEU_DE`, `don_nghi`.`NOI_DUNG`, `chi_tiet_don_nghi`.`MA_NV`, `user`.`HO_TEN`, `don_nghi`.`MINH_CHUNG`, `don_nghi`.`SO_NGAY`, `don_nghi`.`TRANG_THAI`, `don_nghi`.`NGAY_LAM_DON`
            FROM `don_nghi`, `chi_tiet_don_nghi`, `user`, `user_info`, `truong_phong`
            WHERE `chi_tiet_don_nghi`.`MA_NV` = `truong_phong`.`MA_NV` AND `chi_tiet_don_nghi`.`MA_NGHI` = `don_nghi`.`MA_NGHI` AND 
            `don_nghi`.`MA_NGHI` = $id AND `user`.`MA_USER` = `user_info`.`MA_USER` AND `user_info`.`MA_NV` = `truong_phong`.`MA_NV`";
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
