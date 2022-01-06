<?php
session_start();
require_once('db.php');
// quangit kocaiwinnhe123
// akaichi21 akaichi21 active 0
// hieutran795 hieutran795
// longtrong123 123456789


$conn = getConnection();
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$sql = "SELECT account.USER_NAME, PASSWORD, ACTIVE, MA_NV, CHUC_VU, HO_TEN,
CASE
    WHEN (SELECT MA_NV FROM user_info join account a on user_info.USER_NAME = a.USER_NAME
        where a.USER_NAME = ?) IN (SELECT MA_NV FROM truong_phong)
    THEN 1
    ELSE 0
END AS IS_TLEAD
FROM account JOIN user_info ui on account.USER_NAME = ui.USER_NAME join user u on ui.MA_USER = u.MA_USER
WHERE ui.USER_NAME = ?";

$stm = $conn->prepare($sql);
$stm->bind_param('ss', $username, $username);
$stm->execute();
$result = $stm->get_result();
$result = $result->fetch_assoc();
if (!$result) die(json_encode(['code' => 1, 'message' => 'Username not found']));
if (!password_verify($password, $result['PASSWORD'])) {
    die(json_encode(['code' => 2, 'message' => 'Password is wrong! Please check again.']));
};

$_SESSION['active'] = $result['ACTIVE'];
$_SESSION['user_name'] = $result['USER_NAME'];
$_SESSION['user_id'] = $result['MA_NV'];
$_SESSION['ho_ten'] = $result['HO_TEN'];

if ($result['CHUC_VU'] === 'admin') {
    $_SESSION['position'] = 0;
    die(json_encode(['code' => 0, 'message' => './Admin/']));
} else if ($result['CHUC_VU'] === 'employee') {
    if ($result['IS_TLEAD'] === 1) {
        $_SESSION['position'] = 1;
        die(json_encode(['code' => 0, 'message' => './Tlead/']));
    }
    $_SESSION['position'] = 2;
    die(json_encode(['code' => 0, 'message' => './Employee/']));
}


