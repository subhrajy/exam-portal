<?php
include "connection.php";
session_start();
$file = $_FILES['my-file'];
// print_r($file);
$query_get_previous_id = "SELECT FILEID FROM UPLOADED_FILES ORDER BY FILEID DESC LIMIT 1;";
$query_id_conn = mysqli_query($conn, $query_get_previous_id);
if($query_id_conn)
{
    $previous_id = mysqli_fetch_array($query_id_conn)['FILEID'];
    $new_id = $previous_id + 1;
}
$filename = trim($file['name']);
$curr_date = date('Y-m-d');
// $filesize = $file['size'];
$extention = pathinfo($filename, PATHINFO_EXTENSION);
$curr_loc = $file['tmp_name'];
$filename_without_extention = trim(explode('.', $filename)[0]);
$new_name = $filename_without_extention.$new_id.'.'.$extention;
$new_location = "uploads/$new_name";
move_uploaded_file($curr_loc, $new_location);
$user = $_SESSION['student_name'];

$query_insert = "INSERT INTO UPLOADED_FILES(USERNAME, LOCATION, UPLOADING_DATE) VALUES ('$user', '$new_location', '$curr_date')";
echo $query_insert;
$insert_conn = mysqli_query($conn, $query_insert);
if(!$insert_conn)
{
    $msg = "cannot insert into database";
}
else
{
    $msg =  "succesfully inserted";
}
$_SESSION['file-inserted-status'] = $msg;
// echo $msg;
header('Location: repository.php');

?>
