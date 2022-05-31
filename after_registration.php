<?php include "connection.php";
session_start();
if(isset($_SESSION['sid_success']))
  $sid = $_SESSION['sid_success'];
else
  header("Location: index.html");
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

    <!-- <script src="js/script.js" defer></script> -->

    <title>Registration | Website name</title>
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
      <a href="index.html" class="back-to-home margin-bottom--sm"
        >&leftarrow; back to home</a
      >
      <div class="flex form-names">
        <h3 class="form-lbl tab-active margin-bottom--md">Personal Details</h3>
      </div>

      <div class="div-form">
        <form
          name="registration_form"
          id="register-form"
          action="store_details.php"
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
                required
              />
            </div>

            <div class="div--student-email">
              <label for="studentemail" class="login-lbl">Student Email</label>
              <input
                type="email"
                autocomplete="none"
                name="student_mail"
                id="student-email"
                class="input-box"
                required
              />
              <span id="msg5"> </span>
            </div>

            <div class="div--parent-email">
              <label for="parentemail" class="login-lbl">Parent's email</label>
              <input
                type="email"
                name="parent_mail"
                id="parent-email"
                class="input-box"
                required
              />
              <span id="msg6"> </span>
            </div>

            <div class="div--student-phone">
              <label for="studentphone" class="login-lbl"
                >Student's Phone Number</label
              >
              <input
                type="number"
                name="student_phone"
                id="student-number"
                class="input-box"
                required
              />
              <span id="msg7"> </span>
            </div>

            <div class="div--parent-phone">
              <label for="parentphone" class="login-lbl"
                >Parent's Phone Number</label
              >
              <input
                type="number"
                name="parent_phone"
                id="parent-number"
                class="input-box"
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
                required
              />
            </div>

            <div class="div-gender margin-bottom--lg">
              <label for="gender" class="login-lbl">Gender</label>

              <div class="flex radios">
                <div class="male">
                  <input
                    type="radio"
                    name="gender"
                    id="male"
                    value="M"
                    required
                  />
                  <label for="male" class="radio-lbl">male</label>
                </div>

                <div class="female">
                  <input
                    type="radio"
                    name="gender"
                    id="female"
                    value="F"
                    required
                  />
                  <label for="female" class="radio-lbl">female</label>
                </div>

                <div class="other">
                  <input
                    type="radio"
                    name="gender"
                    id="other"
                    value="O"
                    required
                  />
                  <label for="other" class="radio-lbl">other</label>
                </div>
              </div>
            </div>

            <div class="div-age">
              <label for="age" class="login-lbl">Age:</label>
              <p class="age-calculated" name="age">
                <span class="age" id="age"></span>
                <!-- <input type = "text" id = "age" disabled> <br> -->
                <!-- <span id = "msg9"></span> -->
                <br />
                <span class="err-msg" id="msg9"></span>
              </p>
            </div>

            <h3 class="form-lbl tab-active heading-academic-details">
              Academic details
            </h3>

            <div class="empty"></div>

            <div class="div-branch">
              <label for="branch" class="login-lbl">Branch</label>

              <div class="flex radios">
                <div class="">
                  <input
                    type="radio"
                    name="branch"
                    id="cse"
                    value="CSE"
                    required
                  />
                  <label for="cse" class="radio-lbl">CSE</label>
                </div>

                <div class="">
                  <input
                    type="radio"
                    name="branch"
                    id="eee"
                    value="EEE"
                    required
                  />
                  <label for="eee" class="radio-lbl">EEE</label>
                </div>

                <div class="">
                  <input
                    type="radio"
                    name="branch"
                    id="ece"
                    value="ECE"
                    required
                  />
                  <label for="ece" class="radio-lbl">ECE</label>
                </div>
                <div class="">
                  <input
                    type="radio"
                    name="branch"
                    id="eie"
                    value="EIE"
                    required
                  />
                  <label for="eie" class="radio-lbl">EIE</label>
                </div>
              </div>
            </div>

            <div class="div-year-of-study margin-bottom--sm">
              <label for="study-year" class="login-lbl">Year of study</label>

              <div class="flex radios">
                <div class="">
                  <input
                    type="radio"
                    name="study-year"
                    id="1st"
                    value="1"
                    required
                  />
                  <label for="1st" class="radio-lbl">1st</label>
                </div>
                <div class="">
                  <input
                    type="radio"
                    name="study-year"
                    id="2nd"
                    value="2"
                    required
                  />
                  <label for="2nd" class="radio-lbl">2nd</label>
                </div>
                <div class="">
                  <input
                    type="radio"
                    name="study-year"
                    id="3rd"
                    value="3"
                    required
                  />
                  <label for="3rd" class="radio-lbl">3rd</label>
                </div>
                <div class="">
                  <input
                    type="radio"
                    name="study-year"
                    id="4th"
                    value="4"
                    required
                  />
                  <label for="4th" class="radio-lbl">4th</label>
                </div>
              </div>
            </div>

            <div class="div-student-image margin-bottom--lg">
              <label for="student-img" class="login-lbl">Profile picture</label>

              <img
                src="images/img-placeholder.png"
                alt="Student image to be uploaded"
                name="student-img"
                height="200"
                width="200"
                id="studentImageBox"
              />

              <input
                accept="image/*"
                type="file"
                id="studentImage"
                name="uploaded"
                class="btn btn--outline input-student-img"
              />
              <span id="msg10"></span>
            </div>

            <div class="div--password">
              <label for="password" class="login-lbl">New Password</label>
              <input
                type="password"
                autocomplete="new-password"
                name="user_password"
                id="login-password"
                class="input-box margin-bottom--sm"
                required
              />
              <span id="msg11"> </span>

              <label for="password" class="login-lbl">Confirm Password</label>
              <input
                type="password"
                name="confirm-password"
                id="confirm-password"
                class="input-box"
                required
              />
              <span id="msg12"> </span>

              <div class="password-instructions">
                <ol class="password-instruction-list">
                  <p>The password should have:</p>
                  <ul>
                    <li>Atleast one digit</li>
                    <li>Atleast one UPPERCASE letter</li>
                    <li>Atleast one lowercase letter</li>
                    <li>Atleast one special character - !@#$%&*_</li>
                    <li>The length should be between 8-15</li>
                  </ul>
                </ol>
              </div>
            </div>

            <div class="div-clear--proceed--buttons">
              <!-- <a href="#" class="">clear</a> -->
              <button class="btn btn--outline" type="reset">Clear</button>

              <button
                class="btn btn-active btn--full btn-register-submit"
                id="submit-btn"
                type="button"
                onclick="submit()"
              >
                Proceed
              </button>
            </div>
            <p class="reg-msg">We don't disclose your personal information</p>
          </div>
        </form>
      </div>
    </div>

    
    <div class='userid-popup'>
        <h2 class='heading-secondary margin-bottom--sm'>Your user id is:</h2>
        <p class='user-id margin-bottom--md'> <?php echo $sid; ?></p>

        <button class='btn-okay btn' onclick='forwardAfterReg()'>okay</button>
    </div>
        

    <!-- <aside>
      <div class="userid-popup hidden">
        <h2 class="heading-secondary margin-bottom--sm">Your user id is:</h2>
        <p class="user-id margin-bottom--md">190310158</p>

        <button class="btn-okay btn" onclick="forwardAfterReg()">okay</button>
      </div>

      <div class="overlay hidden"></div>
    </aside> -->

    <script>
      const forwardAfterReg = function () {
        window.location.replace(
          "http://localhost:8888/E-EXAM%20IWT/my_wall_update.php"
        );
      };

      studentImage.onchange = (event) => {
        const [file] = studentImage.files;

        if (file) {
          studentImageBox.src = URL.createObjectURL(file);
        }
      };

      function submit() {
        document.getElementById(`register-form`).submit();
        console.log(`Submitted`);
      }
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
