<?php
include "connection.php";
require 'PHPMailer/PHPMailerAutoload.php';
session_start();
$sid = $_SESSION['sid'];
$name = $_SESSION['student_name'];
$query_get_email = "SELECT STUDENT_EMAIL FROM STUDENT_DETAILS WHERE SID = $sid";
$get_email_conn = mysqli_query($conn, $query_get_email);
$student_email_array = mysqli_fetch_array($get_email_conn);
$student_email = $student_email_array[0];
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$msg = "<div> 
          <h3> Hello $name ($sid) </h3>
          <p> There was a request to change the password of your Portal logging platform.<br>
          Your 6 digit OTP for the same is: <b> $otp </b>.<br>
          Enter this in your screen to continue the Changing Password process.<br>
        </div> ";
$mail = new PHPMailer();
$mail->isSMTP();
$mail -> Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'chaudhurypaul@gmail.com';
$mail->Password = 'Paul12345';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('chaudhurypaul@gmail.com', 'System');
$mail->addReplyTo('chaudhurypaul@gmail.com', 'System');
$mail->addAddress("$student_email");


$mail->Subject = "Password Change Request OTP VERIFICATION.";
$mail->MsgHTML($msg);

if($mail->Send()){
  $res = "OTP SENT!";
}
else
  $res = $mail->ErrorInfo;

echo $res;
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
    <link rel="stylesheet" href="css/queries.css" />

    <title>change password</title>
  </head>
  <body>
    <main>
      <div class="div--change-password-logo">
        <a href="index.html" class="logo change-password-logo margin-bottom--sm"
          >WEBSITE <span>NAME</span></a
        >
        <h1 class="change-password-heading margin-bottom--sm">
          change password
        </h1>
      </div>
      <div class="change-password--container">
        <div class="div-otp">
          <h2 id = 'error_text'> </h2>
          <h2 class="otp-heading margin-bottom--sm">
            Enter the OTP sent to your mail ID
          </h2>
          <form action="" class="form-otp">
            <input type="number" name="otp" id="otp" class="input-otp" required />
            <button
              type="submit"
              class="btn btn--submit-otp"
              onclick="justForFun()"
            >
              submit
            </button>
          </form>
        </div>

        <div class="div--new-password hidden">
          <h2 class="otp-heading margin-bottom--sm">Enter new password</h2>
          <form action="" class="form--new-password">
            <input
              type="text"
              name=""
              id=""
              placeholder="new password"
              class="input--new-password"
              required
            />
            <input
              type="password"
              name=""
              id=""
              placeholder="confirm password"
              class="input--confirm-password"
              required
            />

            <button type="submit" class="btn btn--update-password">
              update
            </button>
          </form>
        </div>
      </div>

      <div class="div--btn-goback">
        <button class="btn-goback" onclick="goBack()">go back</button>
      </div>
    </main>

    <script>
      const goBack = function () {
        window.history.back();
      };

      const divNewPasswordEl = document.querySelector(`.div--new-password`);

      const justForFun = function () {
        var otp = document.getElementById('otp').value;
        var req = new XMLHttpRequest();
        req.open('get', 'http://localhost/E-EXAM%20IWT/check_otp.php?provided=' + otp, true);
        req.send();
        req.onreadystatechange = function(){
          var status = req.responseText;
          if(status == 'correct')
          { 
            document.getElementById('error_text').innerHTML = "CORRECT OTP, NOW YOU CAN CHANGE YOUR PASSWORD";

            divNewPasswordEl.classList.remove(`hidden`);
            divNewPasswordEl.style.opacity = `0`;

            document.querySelector(`.div-otp`).classList.add(`hidden`);

            // setTimeout(() => {
            //   divNewPasswordEl.style.transform = `translateY(-4.8rem)`;
            //   divNewPasswordEl.style.opacity = `1`;
            // }, 10);

            document.querySelector(
              `.div--btn-goback`
            ).style.transform = `translateY(-4.8rem)`;
          }
          else
            document.getElementById('error_text').innerHTML = "INCORRECT OTP PROVIDED! RETRY AGAIN!";
        }

      };
    </script>
  </body>
</html>
