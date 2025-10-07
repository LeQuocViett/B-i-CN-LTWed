<?php
session_start();

// Xóa tất cả dữ liệu trong session
$_SESSION = array();

// Xóa cookie session
$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
);

// Hủy session
session_destroy();

echo "Session ended and cookie deleted. <a href='index.php'>Back to shop</a>";
?>
