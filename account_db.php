<?php
    require_once('db.php');
    function add_account($username){
        $sql = 'INSERT INTO `account` (`USER_NAME`, `PASSWORD`, `ACTIVE`) VALUES (?, ?, ?)';
        $conn = get_connection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $username, password_hash($username, PASSWORD_DEFAULT), 0);
        $stm->execute();
        if ($stm->affected_rows == 1){
            return $stm->insert_id;
        }
        return 0;
    }
?>