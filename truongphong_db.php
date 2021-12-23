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