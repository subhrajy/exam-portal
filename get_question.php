<?php
//session_start();

// $GLOBALS['chosen'] = $chosen;
// // array_push($a, $chosen);
// $s = array('C', 'D', 'E', 'F');
// $return = "<div id = 'question'>
//     <h3>Q2.</h3>
//     <h3>Question2</h3>
// </div>
// <div id = 'options'>";
// $op = "";
// foreach($s as $option)
// {
//     $op = $op."<input type = 'radio' id = 'opt' value = '$option' required name = 'option'> $option<br>";
// }
// $return = $return.$op;
// echo $return;
// print_r($GLOBALS['chosen']);

// include_once "connection.php";
include_once "question.php";
$chosen = $_GET['chosen'];
$op = "";
$options = array();
$res = $_SESSION['result'];
$solutions = $_SESSION['solutions'];
// $question = $query_res[0];
// foreach($query_res as $s)
// {
//     print_r($s);
//     echo "<br>";
// }
if($chosen != "")
{
    $ans = array_shift($solutions);
    // echo "<br>actual: ".$ans[1];
    // echo "  selected: ".$chosen;
    if($chosen == $ans[1])
    {
        // echo "checking";
        $marks = $_SESSION['marks'];
        $marks += 1;
        $_SESSION['marks'] = $marks;
        // echo $_SESSION['marks'];
    }
    $_SESSION['solutions'] = $solutions;
}


// echo "<br>solution set: ";
// print_r($solutions);
// echo "<br>";
if(!isset($_SESSION['qno']))
    $_SESSION['qno'] = 1;
if(!empty($res))
{
    $question = array_shift($res);
   
    // echo "solutions:";
    // foreach($solutions as $s)
    // {
    //     print_r($s);
    //     echo "<br>";
    // }
    //print_r($ans);
    $qno = $_SESSION['qno'];

    // $return = "<div id = 'question'>
    //     <h3>Q$qno .</h3>
    //     <h3>$question[1]</h3>
    //     </div>
    // <div id = 'options'>";
    $return = "<div class='div--question-statement margin-bottom--lg' id = 'question'>
    <label for='question' class='question-statement'>
      <h3>$qno/5. $question[1]</h3>
    </label>
  </div>
  <div class='div-options'>
    <div id = 'options'class = 'option grid grid--2-cols margin-bottom--lg'>";
    $qno += 1;

    $_SESSION['qno'] = $qno;
    $_SESSION['result'] = $res;

    for($i = 3; $i <= 6; $i++)
    {
        array_push($options, $question[$i]);
    }
    //  print_r($option)
    foreach($options as $option)
    {
        $op = $op."<input type = 'radio' id = '$option' value = '$option' required name = 'option'>
              <label for='$option'>$option</label>";
    }
    $return = $return.$op;
    echo $return;
}
else
{
    unset($_SESSION['result']);
    //echo $_SESSION['result'];
    unset($_SESSION['qno']);
    unset($_SESSION['data']);
    //echo '<br>'. $_SESSION['qno'];
    // echo "THE MARKS OBTAINED IS: ".$_SESSION['marks'];
    $marks = $_SESSION['marks'];
    // echo "<h1> your obtained marks: $marks</h1>";

    // UPDATING THE MARKS AND THE STATUS.
    $sid = $_SESSION['sid'];
    $subid = $_SESSION['subid'];
    $query_update_status = "INSERT INTO STUDENT_APPEARED VALUES($sid, $subid, 'Y')";
    $query_update_marks = "INSERT INTO STUDENT_MARKS VALUES($sid, $subid, $marks)";
    echo $query_update_marks;
    // echo $query_update_status;
    // echo "<br> $sid";
    $status_update_conn = mysqli_query($conn, $query_update_status);
    if($status_update_conn)
    {
        $mark_update_conn = mysqli_query($conn, $query_update_marks);
        // echo $query_update_marks;
        if($mark_update_conn)
        {}
            // header("Location: exam_sub_2.php");
            // echo "<h3>Updated</h3>";
        else{}
            // echo "<h2>Cannot change the marks </h2>";
    }
    else{}
        // echo "<h1> Cannot insert the status </h1>";
    unset($_SESSION['subid']);
    unset($_SESSION['marks']);
    echo "THE END of exam!!!";

    // header('Location: exam_sub_2.php');
    // return "<div> <h1> THE END, THE MARKS OBTAINED IS: $marks </h1> <a href = 'exam_sub_2.php'>BACK</a>";
}
?>