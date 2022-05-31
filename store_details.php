<?php
include "connection.php";
session_start();
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$father_name = $_REQUEST["father"];
$mother_name = $_REQUEST["mother"];
$address = $_REQUEST['addr'];
$student_mail = $_REQUEST['student_mail'];
$parent_mail = $_REQUEST['parent_mail'];
$student_phone = $_REQUEST["student_phone"];
$parent_phone = $_REQUEST["parent_phone"];
$dob = $_REQUEST['dob'];
$gender = $_REQUEST['gender'];
$branch = $_REQUEST['branch'];
$year = $_REQUEST['study-year'];
$password = $_REQUEST["user_password"];
$image = $_FILES["uploaded"];
$image_name = trim($image['name']);
$image_type = $image['type'];

$extension =  pathinfo($image_name, PATHINFO_EXTENSION);
$valid_files = array('jpg', 'jpeg', 'png', 'jfif');
if (in_array($extension, $valid_files))
{

    $mother_name = trim($mother_name);
    $father_name = trim($father_name);
    $address = trim($address);
    $name = $first_name . " " .$last_name;
    $query_insert = "INSERT INTO STUDENT_DETAILS(NAME, FATHER_NAME, MOTHER_NAME, ADDRESS, STUDENT_EMAIL, PARENT_MAIL, STUDENT_PHONE, PARENT_PHONE, DOB, GENDER,
    BRANCH, YOS)
    VALUES('$name', '$father_name', '$mother_name', '$address', '$student_mail', '$parent_mail', 
    $student_phone, $parent_phone, '$dob', '$gender', '$branch', '$year')";
    // echo "      " . $query_insert;
    $sql_link = mysqli_query($conn, $query_insert);
    if(!($sql_link))
        echo "Cannot insert into the database";
    else
    {
        echo "Inserted into the database";
        $query_get_sid = "SELECT SID FROM STUDENT_DETAILS WHERE NAME = '$name' AND DOB = '$dob' AND STUDENT_EMAIL = '$student_mail'";
        echo $query_get_sid;
        $sql_get_sid = mysqli_query($conn, $query_get_sid);
        $result = mysqli_fetch_array($sql_get_sid);
        // print_r($result);

        $sid = $result[0]; // or $sid = $result['SID']

        $curr_location = $image['tmp_name'];
        $new_name_for_image = $sid.'.'.$extension;
        $upload_location = "student images";
        $stored_address = "$upload_location/$new_name_for_image";
        echo $new_name_for_image;
        // echo "  ". $curr_location;
        move_uploaded_file($curr_location, $stored_address);
        $query_set_password = "INSERT INTO LOGIN_STUDENT (SID, PASSWORD, IMAGE) VALUES ($sid, '$password', '$stored_address')";
        // echo $query_set_password;
        $sql_add_password = mysqli_query($conn, $query_set_password);
        if (!$sql_add_password)
            echo "Cannot add password";
        else
            echo "added password";  
        $_SESSION['sid'] = $sid;
        header("Location: registration_2.php");
    }
}
else
{
    $_SESSION['registration_error'] = "Uploaded file is not of an allowed type. Allowed types are: .jpg, .jpeg, .png ";
    echo $_SESSION['registration_error'];
}

?>