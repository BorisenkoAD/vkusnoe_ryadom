<?php
unset($_COOKIE['user_id']);
unset($_COOKIE['username']);
setcookie('user_id', '', -1, '/');
setcookie('username', '', -1, '/');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>