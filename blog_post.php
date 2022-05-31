<?php
include "connection.php";
session_start();
if (!isset($_SESSION["sid"])) {
    header("Location: index.html");
}
$sid = $_SESSION["sid"];
// $content = $_POST["content"];
$content = mysqli_real_escape_string($conn, $_POST["content"]);

if (strlen($content) == 0) {
    echo "blank";
} else {
    $curr_date = date("Y-m-d H:i:s");
    // echo $curr_date;
    $query_insert_blog = "INSERT INTO BLOG(SID, CONTENT, POSTING_TIME) VALUES($sid, '$content', '$curr_date') ";
    echo $query_insert_blog;
    $insert_blog_conn = mysqli_query($conn, $query_insert_blog);
    if ($insert_blog_conn) {
        echo "succesfful";
        header("Location: forum.php");
    } else {
        echo "cannot insert into the table";
    }
}
?>
