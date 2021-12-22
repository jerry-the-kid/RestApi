<?php
require_once('db.php');
function getTeamEmployee($departmentID)
{
}

function getAllTeamLead()
{
    $coon = getConnection();
    $sql = 'select DISTINCT pb.MA_PHONG_BAN, TP.MA_NV, TEN_PB, u.HO_TEN
    from user_info ui join phong_ban pb using (MA_PHONG_BAN)
    join truong_phong tp using (MA_PHONG_BAN)
    join user u on ui.MA_USER = u.MA_USER
    where tp.MA_NV = ui.MA_NV';
    $stm = $coon->prepare($sql);
    if (!$stm->execute()) {
        die(0);
    }
    $result = $stm->get_result();
    print_r($result->fetch_all(MYSQLI_ASSOC));


}