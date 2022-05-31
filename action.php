<?php
session_start();
$sid = $_POST['sub_id'];
$r =  "The VALUE RECEIVED: $sid";
// echo $r;
if(isset($_SESSION['subid']))
{
    if($sid != $_SESSION['subid'])
    {
        $_SESSION['qno'] = 1;
        // $_SESSION['marks'] = 0;
    }
    unset($_SESSION['subid']);
}
$_SESSION['subid'] = $sid;


// echo $_SESSION['subid'];
header('Location: exam_page copy.html');
?>