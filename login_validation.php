<?php
include "connection.php";
session_start();
$user = $_REQUEST['id'];
$password = $_REQUEST['pswrd'];
// echo "  ".$user. " ". $password;
$query1 = "SELECT PASSWORD FROM LOGIN_STUDENT WHERE SID = $user";
$sql_link = mysqli_query($conn, $query1);
if(!$sql_link)
{
    echo "No account present with that user-name";
    $_SESSION['login_error'] = "Not a registered User";
}
else
{
    $query1_result = mysqli_fetch_array($sql_link);
    if(empty($query1_result))
    {
        echo "No account present with that user-name";
        $_SESSION['login_error'] = "Not a registered User";
    }
    else
    {
        $db_password = $query1_result['PASSWORD'];
        // echo $db_password. ' '. $password;
        if ($password == $db_password)
        {
            $query_get_name = "SELECT NAME FROM STUDENT_DETAILS WHERE SID = $user";
            $sql_get_name = mysqli_query($conn, $query_get_name);
            $query_get_name_result = mysqli_fetch_array($sql_get_name);
            $name = $query_get_name_result[0];
            // $_SESSION['login'] = "Welcome ". $name;
            $msg = "Welcome ".$name;
            setcookie("success", $msg, time() + 86400, '/');
            $_SESSION['sid'] = $user;
            $_SESSION['student_name'] = $name;
            echo "Sucess";
            // echo $_SESSION['login_error'];
            // header('Location: exam_sub_2.php');
    
        }
        else
        {
            // $_SESSION['login_error'] = "Incorrect password provided";
            $msg = "Incorrect password provided!";
            // setcookie("error_log", $msg, time() + 86400, '/');
            echo $msg;
    
            // header("Location: index.html");
            // echo $_SESSION['login_error'];
            // echo $_COOKIE["error_log"];
        }
    }
    
}
// ?>