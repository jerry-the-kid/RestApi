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