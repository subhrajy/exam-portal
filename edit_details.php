<?php 
include "connection.php";
session_start();
$sid = $_SESSION['sid'];
$query_info = "SELECT * FROM STUDENT_DETAILS WHERE SID = $sid";
$query_image = "SELECT IMAGE FROM LOGIN_STUDENT WHERE SID = $sid";
$sql_info = mysqli_query($conn, $query_info);
$sql_image = mysqli_query($conn, $query_image); 
if(!$sql_info || !$sql_image)
    $error = 1;
else
    $error = 0;
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

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&family=Roboto+Slab:wght@400&display=swap"
      rel="stylesheet"
    />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/queries.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <!-- <script src = "../js/registration-form.js" defer></script> -->

    <!-- <script src="js/rescript.js" defer></script> -->

    <title>EDIT DETAILS</title>
    <style>
      span {
        color: red;
      }
    </style>
  </head>
  <body>
    <!-- <header>
      <div class="logo-nav">
        <a href="index.html" class="logo">WEBSITE <span>NAME</span></a>
      </div>
    </header> -->

    <div class="form-container">
      <a href = "my_wall_update.php">Back to Home</a>
        <br>
      <div class="flex form-names">
      <?php if($error == 0)
              {
                  $result = mysqli_fetch_array($sql_info);
                  $image = mysqli_fetch_array($sql_image);
                //   echo $result;
              }
              else {?>
            <h1> An error has occured. Kindly retry </h1>
            <?php } ?>
        <h3 class="form-lbl tab-active margin-bottom--md">Personal Details</h3>
      </div>

      <div class="div-form">
        <form
          name="registration_form"
          id="register-form"
          action="store_edit_details.php"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="grid--2-cols grid--gap-lg">
            <div class="div-firstname">
              <label for="firstname" class="login-lbl">First Name</label>
              <input
                type="text"
                name="first_name"
                id="FirstName"
                class="input-box"
                value = "<?php $names = explode(" ", $result['NAME']);
                              echo $names[0]; ?>"
                required
              />
              <span id="msg1"></span>
            </div>

            <div class="div-lastname">
              <label for="lastname" class="login-lbl">Last Name</label>
              <input
                type="text"
                name="last_name"
                id="LastName"
                class="input-box"
                value = "<?php echo $names[1];?>"
                required
              />
              <span id="msg2"> </span>
            </div>

            <div class="div-fathername">
              <label for="fathername" class="login-lbl">Father's Name</label>
              <input
                type="text"
                name="father"
                id="Father-Name"
                class="input-box"
                value = "<?php echo $result['FATHER_NAME'];?>"
                required
              />
              <span id="msg3"> </span>
            </div>

            <div class="div-mothername">
              <label for="mothername" class="login-lbl">Mother's Name</label>
              <input
                type="text"
                name="mother"
                id="Mother-Name"
                class="input-box"
                value = "<?php echo $result['MOTHER_NAME'];?>"
                required
              />
              <span id="msg4"> </span>
            </div>

            <div class="div--student-address">
              <label for="studentaddress" class="login-lbl">Address</label>
              <input
                type="text"
                name="addr"
                id="address"
                class="input-box"
                value = "<?php echo $result['ADDRESS']?>"
                required
              />
            </div>

            <div class="div--student-email">
              <label for="studentemail" class="login-lbl">Student Email</label>
              <input
                type="text"
                name="student_mail"
                id="student-email"
                class="input-box"
                value = "<?php echo $result['STUDENT_EMAIL'];?>"
                required
              />
              <span id="msg5"> </span>
            </div>

            <div class="div--parent-email">
              <label for="parentemail" class="login-lbl">Parent's email</label>
              <input
                type="text"
                name="parent_mail"
                id="parent-email"
                class="input-box"
                value = "<?php echo $result['PARENT_MAIL'];?>"
                required
              />
              <span id="msg6"> </span>
            </div>

            <div class="div--student-phone">
              <label for="studentphone" class="login-lbl"
                >Student's Phone Number</label
              >
              <input
                type="text"
                name="student_phone"
                id="student-number"
                class="input-box"
                value = "<?php echo $result['STUDENT_PHONE'];?>"
                required
              />
              <span id="msg7"> </span>
            </div>

            <div class="div--parent-phone">
              <label for="parentphone" class="login-lbl"
                >Parent's Phone Number</label
              >
              <input
                type="text"
                name="parent_phone"
                id="parent-number"
                class="input-box"
                value = "<?php echo $result['PARENT_PHONE'];?>"
                required
              />
              <span id="msg8"> </span>
            </div>

            <div class="div--date-of-birth">
              <label for="dob" class="login-lbl">Date of Birth</label>
              <input
                type="date"
                name="dob"
                id="DOB"
                class="input-box dob"
                disabled
                value = "<?php echo $result['DOB'];?>"
                required
              />
            </div>

            <div class="div-gender margin-bottom--lg"> </div>
             

            <div class="div-age"> </div>

            <h3 class="form-lbl tab-active heading-academic-details"></h3>

            <div class="empty"></div>

            <div class="div-branch">            </div>

            <div class="div-year-of-study margin-bottom--sm"></div>

            <div class="div-student-image margin-bottom--lg">
              <label for="student-img" class="login-lbl">Profile picture</label>

              <img
                src="<?php echo $image['IMAGE'];?>"
                alt="Student image to be uploaded"
                name="student-img"
                height="200"
                width="200"
                id="studentImageBox"
              />

              <input
                accept="image/*"
                type="file"
                value = "<?php echo $image['IMAGE'];?>"
                id="studentImage"
                name="uploaded"
                class="btn btn--outline input-student-img"
              />
            </div>

            <div class="eempty"> </div>
            <div class="div-clear--proceed--buttons">

              <button
              type="submit"
                class="btn btn--full btn-register-submit"
                id="submit-btn"
                
              >
                Update
              </button>
            </div>

            <p class="reg-msg">We don't disclose your personal information</p>
          </div>
        </form>
      </div>
    </div>

    <script>
      studentImage.onchange = (event) => {
        const [file] = studentImage.files;

        if (file) {
          studentImageBox.src = URL.createObjectURL(file);
        }
      };
      function load()
      {
        var gender = "<?php echo $result['GENDER']; ?>";
        var branch = "<?php echo $result['BRANCH'];?>";
        var year = "<?php echo $result['YOS'];?>";
        // console.log(gender);
        if(gender == "M")
          document.getElementById("male").checked = true;
        else if(gender == "F")
          document.getElementById("female").checked = true;
        else
          document.getElementById("others").checked = true;

        if (branch == "CSE")
          document.getElementById("cse").checked = true;
        else if(branch == "ECE")
          document.getElementById("ece").checked = true;
        else if(branch == "EEE")
          document.getElementById("eee").checked = true;
        else
          document.getElementById("eie").checked = true;

        if(year == "1")
          document.getElementById("1st").checked = true;
        else if(year == "2")
          document.getElementById("2nd").checked = true;
        else if(year == "3")
          document.getElementById("3rd").checked = true;
        else
          document.getElementById("4th").checked = true;
      }

      // function submit() {
      //   document.getElementById(`register-form`).submit();
      //   console.log(`Submitted`);
      // }
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script src="js/registration-form.js"></script>
  </body>
</html>
