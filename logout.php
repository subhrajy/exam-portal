<?php
session_start();
session_destroy();
setcookie('success', '', time() - 86400, '/');
// setcookie('error_log', '', time() - 86400, '/');
header("Location: index.html");

?>