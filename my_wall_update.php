<?php
include "connection.php";
session_start();
// echo $_SESSION['login_error'];
// echo "  ".$_SESSION['login'];
// echo session_id();
// if(!(isset($_SESSION['login'])))
//     header("Location: index.html");
if (!isset($_COOKIE["success"])) {
    header("Location: index.html");
} else {
    $sid = $_SESSION["sid"];
}
// echo $sid;
$query_extract_info = "SELECT * FROM STUDENT_DETAILS WHERE SID = $sid";
$query_extract_image = "SELECT IMAGE FROM LOGIN_STUDENT WHERE SID = $sid";
$sql_info = mysqli_query($conn, $query_extract_info);
$sql_image = mysqli_query($conn, $query_extract_image);
$info = mysqli_fetch_array($sql_info);
$image = mysqli_fetch_array($sql_image);

// print_r($info);
// print_r($image);
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

    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/general.css" />

    <!-- <script defer src="js/script.js"></script> -->

    <title>FirstName | Website name</title>
  </head>
  
  <body>
    <header class="wall-header margin-bottom--lg">
      <div class="logo-nav">
        <a href="index.html" class="logo">WEBSITE <span>NAME</span></a>
      </div>

      <nav class="main-nav nav-other-page">
        <ul class="main-nav-list">
          <li>
            <a href="exam_sub_2.php" class="main-nav-link">Online Exam</a>
          </li>
          <li>
            <a href="forum.php" class="main-nav-link">Forum</a>
          </li>
          <li>
            <a href="repository.php" class="main-nav-link">Repository</a>
          </li>
          <li>
            <a href="#" class="main-nav-link nav-cta">My Wall</a>
          </li>
        </ul>
      </nav>
      
    </header>

    <main>

    <div class="div-logout">
      <a href = "logout.php" class="btn btn-logout" type = "button" id = "logout" >Logout</a>
    </div>
    <section class="margin-bottom--lg">
      <div class="container div-profile-container">
        <div class="div-user-identity">
          <div class="div-profile-pic margin-bottom--sm">
            <picture>
              <!-- <source srcset="profile.svg" type="image/webp" /> -->
              <source srcset="<?php echo $image[
                  "IMAGE"
              ]; ?>" type="image/png" />

              <img
                src="<?php echo $image["IMAGE"]; ?>"
                alt="picture of user"
                class="profile-pic"
              />
            </picture>

            <!-- <ion-icon class="convert-circle" name="ellipse-outline"></ion-icon>

            <ion-icon class="convert-square" name="square-outline"></ion-icon> -->
          </div>

          <div class="edit-details-password">
            <div class="edit-details">
              <a href="edit_details.php" class="edit-details-lbl">edit details</a>
            </div>

            <div class="edit-password">
              <a href="change_password.php" class="edit-details-lbl">change password</a>
            </div>
          </div>
          <div class="identity"></div>
        </div>

        <div>
          <div class="div-user-details grid grid--2-cols">
            <div class="name">
              <p id="pronoun">
              <?php
              $g = $info["GENDER"];
              if ($g == "M") {
                  $gender = "He";
              } elseif ($g == "F") {
                  $gender = "She";
              } else {
                  $gender = "Others";
              }
              echo $gender;
              ?>
              </p>
              <h2 class="heading-secondary profile-name">
                <?php echo $info["NAME"]; ?>
              </h2>
            </div>

            <div class="empty"></div>

            <div class="personal-details">
              <div class="personal-details-heading margin-bottom--md">
                <ion-icon name="person" class="margin-right--sm"></ion-icon>
                <h2 class="details-div-name">Personal Details</h2>
              </div>

              <div class="personal-details-body">
                <div class="div-details-text div-details-father-name">
                  <label for="" class="label-keys lbl-details-father-name" 
                    >Father's name:
                  </label>

                  <label for="" id="fathername">
                    <?php echo $info["FATHER_NAME"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-mother-name">
                  <label for="" class="label-keys lbl-details-mother-name"
                    >Mother's name:
                  </label>

                  <label for="" id="mothername">
                    <?php echo $info["MOTHER_NAME"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-parent-email">
                  <label for="" class="label-keys lbl-details-parent-email"
                    >Parent's email:
                  </label>

                  <label for="" id="parentemail">
                    <?php echo $info["PARENT_MAIL"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-parent-phone">
                  <label for="" class="label-keys lbl-details-parent-phone"
                    >parent's phone:
                  </label>

                  <label for="" id="parentphone">
                    <?php echo $info["PARENT_PHONE"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-address">
                  <label for="" class="label-keys lbl-details-address">Address: </label>

                  <label for="" id="address"
                    ><?php echo $info["ADDRESS"]; ?></label
                  >
                </div>

                <div class="div-details-text div-details-dob">
                  <label for="" class="label-keys lbl-details-dob">Date of birth: </label>

                  <label for="" id="dob">
                    <?php
                    $dob = $info["DOB"];
                    echo date("M jS, Y", strtotime("$dob"));
                    ?>
                  </label>
                </div>
              </div>
            </div>

            <div class="academic-details">
              <div class="academic-details-heading margin-bottom--md">
                <ion-icon name="school" class="margin-right--sm"></ion-icon>
                <h2 class="details-div-name">Academic Details</h2>
              </div>

              <div class="academic-details-body">
                <div class="div-details-text div-details-student-id">
                  <label for="" class="label-keys lbl-details-student-id"
                    >Student id:
                  </label>

                  <label for="" id="studentid">
                    <?php echo $sid; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-academic-year">
                  <label for="" class="label-keys lbl-details-academic-year"
                    >Academic year:
                  </label>

                  <label for="" id="academicyear">
                    <?php
                    $year = $info["YOS"];
                    if ($year == "1") {
                        $msg = "1st Year";
                    } elseif ($year == "2") {
                        $msg = "2nd Year";
                    } elseif ($year == "3") {
                        $msg = "3rd Year";
                    } else {
                        $msg = "4th Year";
                    }
                    echo $msg;
                    ?>
                  </label>
                </div>

                <div class="div-details-text div-details-branch">
                  <label for="" class="label-keys lbl-details-branch">Branch: </label>

                  <label for="" id="branch">
                    <?php echo $info["BRANCH"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-student-email">
                  <label for="" class="label-keys lbl-details-student-email"
                    >Student email:
                  </label>

                  <label for="" id="studentemail">
                    <?php echo $info["STUDENT_EMAIL"]; ?>
                  </label>
                </div>

                <div class="div-details-text div-details-student-phone">
                  <label for="" class="label-keys lbl-details-student-phone"
                    >Student phone:
                  </label>

                  <label for="" id="studentphone">
                    <?php echo $info["STUDENT_PHONE"]; ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


      <section class="section-result margin-bottom--lg">
        <div class="div-result">
          <h2 class="details-div-name margin-bottom--sm">Result</h2>

          <table class="table-result">

            <tr>
              <th>Subject</th>
              <th>Marks</th>
            </tr>
            <?php 
              $query_get_marks = "SELECT SUB_ID, MARKS FROM STUDENT_MARKS WHERE SID = $sid ORDER BY SUB_ID";
              $get_marks_conn = mysqli_query($conn, $query_get_marks);
              if($get_marks_conn)
              {
                $sub_marks_array = mysqli_fetch_all($get_marks_conn);
                $sub_ids = "";
                if(count($sub_marks_array) > 0)
                {
                  for($i = 0; $i < count($sub_marks_array); $i++)
                    if($i == 0)
                      $sub_ids = $sub_marks_array[$i][0];
                    else
                      $sub_ids .= ','. $sub_marks_array[$i][0];
                // echo trim($sub_ids);

                  $query_get_sub = "SELECT SUBJECT FROM SUBJECT WHERE SUB_ID IN ($sub_ids) ORDER BY SUB_ID";
                  $get_sub_conn = mysqli_query($conn, $query_get_sub);
                  $sub_array = mysqli_fetch_all($get_sub_conn);
                  for($i = 0; $i < count($sub_marks_array); $i++)
                  {
                ?>
                        <tr>
                          <td> <?php echo $sub_array[$i][0]; ?> </td>
                          <td> <?php echo $sub_marks_array[$i][1].'/5';?></td>
                        </tr>
                <?php }
                  }
                  else{?>
                      <h3>No results yet</h3>
                  <?php }
                  }
            ?>
          </table>
        </div>
      </section>

      <section class="">
        <!-- <h2>something</h2> -->
      </section>
    </main>

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>

    <script>
      // const btn_convert_circle = document.querySelector(`.convert-circle`);
      // const btn_convert_square = document.querySelector(`.convert-square`);
      // const profile_pic = document.querySelector(`.profile-pic`);

      // btn_convert_circle.addEventListener(`click`, (event) => {
      //   event.preventDefault();

      //   profile_pic.style.borderRadius = `50%`;
      // });

      // btn_convert_square.addEventListener(`click`, (event) => {
      //   event.preventDefault();

      //   profile_pic.style.borderRadius = `9px`;
      // });
    </script>
  </body>
</html>
