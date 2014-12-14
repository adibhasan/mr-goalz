<?php
session_start();
setcookie('user_id_name', "", time() - 30 * 24 * 60 * 60, "/");
setcookie('user_email', "", time() - 30 * 24 * 60 * 60, "/");
unset($_COOKIE['user_id_name']);
unset($_COOKIE['user_email']);
unset($_SESSION['fb_token']);
session_destroy();
echo '<script> window.location.href="./"; </script>';
die();
?>
