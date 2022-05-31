<?php
session_start();
include "connection.php";
$sub_id = $_SESSION['subid'];
// echo $sub_id."<br>";
$query_get_questions = "SELECT * FROM QUESTIONS_INFO WHERE SUB_ID = $sub_id";
$query_conn = mysqli_query($conn, $query_get_questions);
$query_res = mysqli_fetch_all($query_conn);
if(isset($_SESSION['qno'])){}
    // echo $_SESSION['qno']."<br>";
else{}
    // echo "Not initialised!!!!!!!!!!!!!";


$qid = "";
foreach($query_res as $res)
{
    // print_r($res);
    // array_push($qid, $res[0]);
    if($qid === "")
        $qid = $res[0];
    else
        $qid = $qid.",".$res[0];
//     echo ("<br>");
}
// echo($qid);

// echo "<br>". "";


$query_get_solutions = "SELECT * FROM SOLUTIONS WHERE QID IN ($qid)";
$query_conn_sol = mysqli_query($conn, $query_get_solutions);
$query_solutions = mysqli_fetch_all($query_conn_sol);
// print_r($query_solutions);
// echo "<br>";
// foreach ($query_solutions as $q)
// {
//     print_r($q);
//     echo "<br>";
// }

$count = count($query_res);
$order = range(1, $count);
shuffle($order);
array_multisort($order, $query_res, $query_solutions);
// print_r($query_res);
// echo "<br>";
// print_r($query_solutions);
// unset($_SESSION['data']);
if(!isset($_SESSION['data']))
{
    $_SESSION['data'] = 1;
    $_SESSION['result'] = $query_res;
    $_SESSION['solutions'] = $query_solutions;
    $_SESSION['marks'] = 0;
}

// print_r($_SESSION['marks']);
// echo ("<br>");
// echo ("<br>");

// foreach($query_res as $res)
// {
//     print_r($res);
//     echo ("<br>");
// }
// foreach($query_solutions as $res)
// {
//     print_r($res);
//     echo ("<br>");
// }
// echo $query_res;
?>