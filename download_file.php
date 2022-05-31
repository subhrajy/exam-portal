<?php 
include "connection.php";
session_start();
if(isset($_GET['file-id']))
    $file_id = $_GET['file-id'];
// echo $file_id;
$query_get_file = "SELECT * FROM UPLOADED_FILES WHERE FILEID = $file_id";
$query_file_conn = mysqli_query($conn, $query_get_file);
if($query_file_conn)
{
    $file = mysqli_fetch_array($query_file_conn);
    $filename = $file['FILENAME'];
    // echo file_exists($filename);
    if(file_exists($filename))
    {
        header('Content-Type : application/octet-stream');
        header('Content-Description: File Transfer');
        // header('Content-Transfer-Encoding:utf-8');
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Expires: 0');
        header('Cache-Control: public');
        // header('Pragma: public');
        readfile($filename);
    }
}
?>