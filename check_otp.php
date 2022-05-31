<?php
session_start();
$provided = $_REQUEST['provided'];
$otp = $_SESSION['otp'];
if($otp == $provided)
    echo "correct";
else
    echo "incorrect";
?>