<?php 
include "connection.php";
session_start();
$comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);
$blog_id = $_REQUEST['blog_id'];
$sid = $_SESSION['sid'];
$name = $_SESSION['student_name'];
// echo $blog_id;  
// echo $comment;

$curr_date = date('Y-m-d H:i:s');
$query_insert_comment = "INSERT INTO BLOG_COMMENTS(BLOG_ID, SID, CONTENT, POSTING_TIME) VALUES($blog_id, $sid, '$comment', '$curr_date')";
$insert_comment_conn = mysqli_query($conn, $query_insert_comment);
if($insert_comment_conn)
{
    $return = "<p class='commentor-name'>$name</p>
    <p class='comment'>$comment</p>";
}
else
    $return = "cannot insert comment";
echo $return;
?>