<?php
include "connection.php";
session_start();
$sid = $_SESSION['sid'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$father_name = $_REQUEST["father"];
$mother_name = $_REQUEST["mother"];
$address = $_REQUEST['addr'];
$student_mail = $_REQUEST['student_mail'];
$parent_mail = $_REQUEST['parent_mail'];
$student_phone = $_REQUEST["student_phone"];
$parent_phone = $_REQUEST["parent_phone"];

$image = $_FILES["uploaded"];
$valid_files = array('jpg', 'jpeg', 'png', 'jfif');

// print_r($image['size']);
if($image['size'])
{
    $image_name = trim($image['name']);
    $image_type = $image['type'];
    $image_given = 1;
    $extension =  pathinfo($image_name, PATHINFO_EXTENSION);
}
else
{
    $extension = "jpg";
    $image_given = 0;
}

if (in_array($extension, $valid_files))
{

    $mother_name = trim($mother_name);
    $father_name = trim($father_name);
    $address = trim($address);
    $name = $first_name . " " .$last_name;
    // $query_insert = "INSERT INTO STUDENT_DETAILS(NAME, FATHER_NAME, MOTHER_NAME, ADDRESS, STUDENT_EMAIL, PARENT_MAIL, STUDENT_PHONE, PARENT_PHONE, DOB, GENDER,
    // BRANCH, YOS)
    // VALUES('$name', '$father_name', '$mother_name', '$address', '$student_mail', '$parent_mail', 
    // $student_phone, $parent_phone, '$dob', '$gender', '$branch', '$year')";
    // echo "      " . $query_insert;
    $query_update_details = "UPDATE STUDENT_DETAILS SET NAME = '$name', FATHER_NAME = '$father_name', MOTHER_NAME = '$mother_name', 
    ADDRESS = '$address', STUDENT_EMAIL = '$student_mail', PARENT_MAIL = '$parent_mail', 
    STUDENT_PHONE = '$student_phone', PARENT_PHONE = '$parent_phone' WHERE SID = $sid";
//    echo $query_update;
    $update_conn = mysqli_query($conn, $query_update_details);
    if($update_conn)
    {
        if($image_given == 1)
        {
            $get_previous_addr = "SELECT IMAGE FROM LOGIN_STUDENT WHERE SID = $sid";
            $previous_addr_conn = mysqli_query($conn, $get_previous_addr);
            $image_location = mysqli_fetch_array($previous_addr_conn)[0];
            // $image_name = $sid.'.'.$extension;
            $curr_location_new_image = $image['tmp_name'];
            move_uploaded_file($curr_location_new_image, $image_location);
        }
        header("Location: my_wall_update.php");
    }        
    else
        echo "<h2>Not able to update info</h2>";
}
//     $sql_link = mysqli_query($conn, $query_insert);
//     if(!($sql_link))
//         echo "Cannot insert into the database";
//     else
//     {
//         echo "Inserted into the database";
//         $query_get_sid = "SELECT SID FROM STUDENT_DETAILS WHERE NAME = '$name' AND DOB = '$dob' AND STUDENT_EMAIL = '$student_mail'";
//         echo $query_get_sid;
//         $sql_get_sid = mysqli_query($conn, $query_get_sid);
//         $result = mysqli_fetch_array($sql_get_sid);
//         // print_r($result);

//         $sid = $result[0]; // or $sid = $result['SID']

//         $curr_location = $image['tmp_name'];
//         $new_name_for_image = $sid.'.'.$extension;
//         $upload_location = "student images";
//         $stored_address = "$upload_location/$new_name_for_image";
//         echo $new_name_for_image;
//         // echo "  ". $curr_location;
//         move_uploaded_file($curr_location, $stored_address);
//         $query_set_password = "INSERT INTO LOGIN_STUDENT (SID, PASSWORD, IMAGE) VALUES ($sid, '$password', '$stored_address')";
//         // echo $query_set_password;
//         $sql_add_password = mysqli_query($conn, $query_set_password);
//         if (!$sql_add_password)
//             echo "Cannot add password";
//         else
//             echo "added password";  
//         header("Location: index.html");
//     }
// }
// else
// {
//     $_SESSION['registration_error'] = "Uploaded file is not of an allowed type. Allowed types are: .jpg, .jpeg, .png ";
//     echo $_SESSION['registration_error'];
// }

?>