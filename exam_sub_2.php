<?php 
include "connection.php";
session_start();
if(!isset($_SESSION['sid']))
    header('Location: index.html');
if(isset($_SESSION['subid']))
{
  $sid = $_SESSION['sid'];
  $marks = $_SESSION['marks'];
  $subid = $_SESSION['subid'];
  $query_update_status = "INSERT INTO STUDENT_APPEARED VALUES($sid, $subid, 'Y')";
  $query_update_marks = "INSERT INTO STUDENT_MARKS VALUES($sid, $subid, $marks)";
  // echo $query_update_marks;
  // echo $query_update_status;
  // echo "<br> $sid";
  $status_update_conn = mysqli_query($conn, $query_update_status);
  if($status_update_conn)
  {
      $mark_update_conn = mysqli_query($conn, $query_update_marks);
      // echo $query_update_marks;
      // if($mark_update_conn)
          // header("Location: exam_sub_2.php");
          // echo "<h3>Updated</h3>";
      // else
          // echo "<h2>Cannot change the marks </h2>";
  }
  else
      echo "<h1> Cannot insert the status </h1>";
  unset($_SESSION['subid']);
  unset($_SESSION['marks']);
  unset($_SESSION['data']);
  unset($_SESSION['qno']);


}
$sid = $_SESSION['sid'];
$query_get_sub = "SELECT * FROM SUBJECT WHERE BRANCH = 'CMN'";
$sub_conn = mysqli_query($conn, $query_get_sub);
if($sub_conn)
{
    $subjects_array = mysqli_fetch_all($sub_conn);
    // foreach ($subjects_array as $sub)
    // {
    //     print_r($sub);
    //     echo "<br>";
    // }
    $query_appeared = "SELECT SUB_ID, APPEARED FROM STUDENT_APPEARED WHERE SID = $sid AND APPEARED != 'E' ORDER BY SID";
    $appeared_sub_conn = mysqli_query($conn, $query_appeared);


    if($appeared_sub_conn)      // the student has appeared for some subjects.
    {
        $status = "APPEARED";

        $subject_id_array_db = mysqli_fetch_all($appeared_sub_conn);
        $sub_id = "";
        foreach($subject_id_array_db as $sub)
        {
            $x = $sub[0];
            // array_push($sub_id, $x);
            if($sub_id === "")
                $sub_id = $x;
            else
                $sub_id = $sub_id.",".$x;
        }

        $sub_id_array = explode(',', $sub_id);
        // print_r($sub_id_array);

        // get the marks for those appeared subjects
        $query_get_marks = "SELECT MARKS FROM STUDENT_MARKS WHERE SID = $sid AND SUB_ID in ($sub_id) ORDER BY SUB_ID";
        $marks_conn = mysqli_query($conn, $query_get_marks);
        if($marks_conn)
        {
            $marks_array = mysqli_fetch_all($marks_conn);
            $marks = array();
            foreach($marks_array as $m)
                array_push($marks, $m[0]);    
            // print_r($marks); 
        }
    }
    else                        // the student has not appeared for any subject.
    {
        $status = "APPEAR NOW";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/styles.css" />

    <title>Subjects - Online Exam | Website name</title>
  </head>
  <body>
    <header class="wall-header margin-bottom--lg">
      <div class="logo-nav">
        <a href="index.html" class="logo">WEBSITE <span>NAME</span></a>
      </div>

      <nav class="main-nav nav-other-page">
        <ul class="main-nav-list">
          <li>
            <a href="#" class="main-nav-link">Online Exam</a>
          </li>
          <li>
            <a href="forum.php" class="main-nav-link">Forum</a>
          </li>
          <li>
            <a href="repository.php" class="main-nav-link">Repository</a>
          </li>
          <li>
            <a href="my_wall_update.php" class="main-nav-link nav-cta">My Wall</a>
          </li>
        </ul>
      </nav>
    </header>

    <main>
      <div class="exam-sub-container">
        <div class="exam-sub-heading margin-bottom--sm">
          <h1 class="heading-secondary heading-available-tests">
            Available tests
          </h1>
        </div>
        <h3 id = "setup"></h3>
        <div class="subjects grid grid--3-cols">
            <?php
                // foreach($subjects_array as $sub)
                for($index = 0; $index < count($subjects_array); $index++)
                {
                    $marked = "NA";
                    $sub = $subjects_array[$index];
                    $name = $sub[1];
                    $subid = $sub[0];
                    $date = $sub[3];
                    $dates = date("d-m-Y", strtotime($date));
                    $curr = date("d-m-Y");
                    $diff = (strtotime($dates) - strtotime($curr))/ (60 * 60);
                    //echo $diff;
                    if($diff > 0)
                    {
                        
                        $appeared = " <p class='exam-date margin-bottom--md'>$dates</p>
                        <form action = 'action.php' method = 'post'>
                            <input type = 'text' value = '$subid' name = 'sub_id' hidden>
                            <button type = 'submit' id = 'btn' class='subject-attempt attempt btn btn--outline'>Attempt</button>
                        </form>";
                    }
                    else
                    {
                        $appeared = "<p class='exam-date margin-bottom--md'>$dates</p>
                        <a href='#' id = 'appeared' onclick = 'send_alert()' class='subject-attempt expired btn btn--outline'>Expired</a>
                        ";
                        $marked = 0;

                        $query_check = "SELECT * FROM STUDENT_APPEARED WHERE SID = $sid AND SUB_ID = $subid";
                        $query_check_conn = mysqli_query($conn, $query_check);
                        $query_check_result = mysqli_fetch_all($query_check_conn);
                        if(empty($query_check_result))                  // means the mark & status have not been updated yet.
                        {
                            $query_update_status = "INSERT INTO STUDENT_APPEARED VALUES($sid, $subid, 'E')";
                            $query_update_marks = "INSERT INTO STUDENT_MARKS VALUES($sid, $subid, 0)";
                            $update_status_conn = mysqli_query($conn, $query_update_status);
                            $update_marks_conn = mysqli_query($conn, $query_update_marks);
                        }
                        
                    }

                    $duration = $sub[5];
                    if (in_array($subid, $sub_id_array))
                    {
                        $index_of_sub_in_sub_id = array_search($subid, $sub_id_array);
                        $mark = $marks[$index_of_sub_in_sub_id];
                        $return = " <div class='subject'>
                        <div class='div-subject-name-marks'>
                        <p class='subject-name'>$name</p>
                        <p class='subject-mark'><span class='mark'>$mark/5</span> Marks</p>
                        </div>
                        <p class='subject-duration margin-bottom--sm'>
                        <span class='duration'>$duration</span> mins
                        </p>
                        <p class='exam-date margin-bottom--md'>$dates</p>
                        <a href='#' id = 'appeared' onclick = 'send_alert()' class='subject-attempt appeared btn btn--outline'>$status</a>
                    </div>";

                    }
                    
                    else
                    {
                        $return = " <div class='subject'>
                        <div class='div-subject-name-marks'>
                          <p class='subject-name'>$name</p>
                          <p class='subject-mark'><span class='mark'>$marked</span> Marks</p>
                        </div>
                        <p class='subject-duration margin-bottom--sm'>
                          <span class='duration'>$duration</span> mins
                        </p>
                        $appeared
                      </div>";
                    //   <a href='exam_page.html' class='subject-attempt btn btn--outline'>Attempt now</a>
                    }
                   
                  echo $return;
                }
            ?>
          <!-- <div class="subject">
            <div class="div-subject-name-marks">
              <p class="subject-name">JavaScript</p>
              <p class="subject-mark"><span class="mark">NaN</span> Marks</p>
            </div>
            <p class="subject-duration margin-bottom--sm">
              <span class="duration">NaN</span> hours
            </p>
            <p class="exam-date margin-bottom--md">00/00/00</p>
            <a href="exam_page.html" class="subject-attempt btn btn--outline">Attempt now</a>
          </div> -->

          <!-- <div class="subject">
            <div class="div-subject-name-marks">
              <p class="subject-name">JavaScript</p>
              <p class="subject-mark"><span class="mark">NaN</span> Marks</p>
            </div>
            <p class="subject-duration margin-bottom--sm">
              <span class="duration">NaN</span> hours
            </p>
            <p class="exam-date margin-bottom--md">00/00/00</p>

            <a href="exam_page.html" class="subject-attempt btn btn--outline"
              >Attempt now</a>
          </div> -->

          <!-- <div class="subject">
            <div class="div-subject-name-marks">
              <p class="subject-name">JavaScript</p>
              <p class="subject-mark"><span class="mark">NaN</span> Marks</p>
            </div>
            <p class="subject-duration margin-bottom--sm">
              <span class="duration">NaN</span> hours
            </p>
            <p class="exam-date margin-bottom--md">00/00/00</p>
            <a href="exam_page.html" class="subject-attempt btn btn--outline"
              >Attempt now</a> 
          </div> -->
        </div>
      </div>
    </main>
  </body>
  <script>
      function send(data)
      {
        console.log(data);
        var req = new XMLHttpRequest();
        req.open("get", "http://localhost:8888/E-EXAM%20IWT/action.php?sub_id=" + data, true);
        req.send();

        req.onreadystatechange = function(){
            if(req.readyState == 4)
            {
                document.getElementById("setup").innerHTML = req.responseText;
;
            }
        };
      }

      function send_alert()
      {
          alert(`You have already appeared for this subject!! Can't appear again!`);
      }
    </script>
</html>
