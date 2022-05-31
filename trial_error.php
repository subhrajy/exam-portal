<?php
session_start();
if(!isset($_SESSION['sid']))
    $return = "false";
echo $return;
?>