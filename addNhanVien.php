<?php
    require_once('db.php');
    function add_NhanVien($username, $maphongban){
        $conn = get_connection();
        $sql = 'INSERT INTO `user_info` (`USER_NAME`, `MA_PHONG_BAN`, `CHUC_VU`) VALUES(?, ?, ?)';
        $stm = $conn->prepare($sql);
        $stm->bind_param('sis', $username, $maphongban, 'employee');
        $stm->execute();
        if ($stm->affected_rows == 1){
            return $stm->insert_id;
        }
        return 0;
    }
?>