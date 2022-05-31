// console.log("Loaded");
$(document).ready(function () {
  // console.log("loaded");
  // $("#msg1").hide();
  // $("#msg2").hide();
  // $("#msg3").hide();
  // $("#msg4").hide();
  // $("#msg7").hide();
  // $("#msg8").hide();
  // $("#msg9").hide();
  // $("#msg11").hide();
  // $("#msg12").hide();

  // $("#hidden-div").hide();

  $("#FirstName").change(function () {
    var x = $("#FirstName").val();
    console.log(x);
    var letters = /^[a-zA-Z ]*$/;
    // console.log(letters.test(x))

    if (!letters.test(x) || x.length == 0) {
      $("#msg1").replaceWith(
        "<span id = 'msg1' style = 'color: red'> Name can only have alphabets </span> "
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#msg1").replaceWith(
        "<span id = 'msg1' style = 'color: green'> Accepted </span>"
      );
      $("#submit-btn").prop("disabled", false);
    }
  });

  $("#LastName").change(function () {
    var x = $("#LastName").val();
    var letters = /^[A-Za-z]+$/;
    if (!letters.test(x) || x.length == 0) {
      $("#msg2").replaceWith(
        "<span id = 'msg2' style = 'color: red'> Name can only have alphabets </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#msg2").replaceWith(
        "<span id = 'msg2' style = 'color: green'> Accepted </span>"
      );
      $("#submit-btn").prop("disbaled", false);
    }
  });

  $("#Father-Name").change(function () {
    var x = $("#Father-Name").val();
    var letters = /^[a-zA-Z ]+$/;
    if (!letters.test(x) || x.length == 0 || " ".indexOf(x) == 0) {
      $("#msg3").replaceWith(
        "<span id = 'msg3' style = 'color: red'> Name can only have alphabets. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#msg3").replaceWith(
        "<span id = 'msg3' style = 'color: green'> Accepted </span>"
      );
      $("#submit-btn").prop("disabled", false);
    }
  });

  $("#Mother-Name").change(function () {
    var x = $("#Mother-Name").val();
    var letters = /^[a-zA-Z ]+$/;
    if (!letters.test(x) || x.length == 0 || " ".indexOf(x) == 0) {
      $("#msg4").replaceWith(
        "<span id = 'msg4' style = 'color: red'> Name can only have alphabets. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#submit-btn").prop("disabled", false);
      $("#msg4").replaceWith(
        "<span id = 'msg4' style = 'color: green'> Accepted </span>"
      );
    }
  });

  $("#student-number").change(function () {
    var x = $("#student-number").val();
    if (isNaN(x)) {
      $("#msg7").replaceWith(
        "<span id = 'msg7' style = 'color: red'> Phone number should consists of only digits. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else if (x.length == 10 || x.length == 11) {
      $("#msg7").replaceWith(
        "<span id = 'msg7' style = 'color: green'> Phone number accepted. </span>"
      );
      $("#submit-btn").prop("disabled", false);
    } else {
      $("#msg7").replaceWith(
        "<span id = 'msg7' style = 'color: red'> Phone number should be of 10 or 11 digits. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    }
  });

  $("#parent-number").change(function () {
    var x = $("#parent-number").val();
    if (isNaN(x)) {
      $("#submit-btn").prop("disabled", true);
      $("#msg8").replaceWith(
        "<span id = 'msg8' style = 'color: red'> Phone number should consist of only digits. </span>"
      );
    } else if (x.length == 10 || x.length == 11) {
      $("#submit-btn").prop("disabled", false);
      $("#msg8").replaceWith(
        "<span id = 'msg8' style = 'color: green'> Phone number accepted. </span>"
      );
    } else {
      $("#msg8").replaceWith(
        "<span id = 'msg8' style = 'color: red'> Incorrect phone number. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    }
  });

  $("#DOB").change(function () {
    var x = $("#DOB").val();
    if (isNaN(x)) {
      x = new Date(x);
      var today = new Date();
      var age = Math.floor((today - x) / (365 * 24 * 3600 * 1000));
      console.log(age);
      // $("#age").val(age);
      $statement =
        "<span id = 'age' class = 'age' style = 'color: violet'>" +
        age +
        "</span>";
      console.log($statement);
      $("#age").replaceWith($statement);

      if (age >= 18 && age <= 60) {
        $("#msg9").replaceWith(
          "<span id = 'msg9' style = 'color: green'> Age accepted </span>"
        );
        $("#submit-btn").prop("disabled", false);
      } else {
        $("#msg9").replaceWith("<span id = 'msg9'> Not Eligible </span>");
        $("#submit-btn").prop("disabled", true);
      }
    }
  });

  $("#login-password").change(function () {
    var x = $("#login-password").val();
    var p1 = /^(?=.*\d)/; // regex for digit
    var p2 = /^(?=.*[a-z])/; // regex for lower case character
    var p3 = /^(?=.*[A-Z])/; // regex for upper case character
    var p4 = /^(?=.*[!@#$%^&*_])/; // regex for special case character
    // console.log(x)
    // console.log("hello");
    // console.log(x.length);
    if (x.length < 8 || x.length > 15) {
      // console.log("entered in the block");
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: red' > Password should have the length between 8-15 </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else if (!p2.test(x)) {
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: red' > Password doesn't have any lower case character. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else if (!p1.test(x)) {
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: red'> Password doesn't have any digits. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else if (!p4.test(x)) {
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: red'> Password doesn't have any special character </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else if (!p3.test(x)) {
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: red'> Password doesn't have any upper case character. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#msg11").replaceWith(
        "<span id = 'msg11' style = 'color: green'> Password accepted. </span>"
      );
      $("#submit-btn").prop("disabled", false);
    }
  });

  $("#confirm-password").change(function () {
    var actual = $("#login-password").val();
    var confirm = $("#confirm-password").val();

    // console.log(actual);
    // console.log(confirm);

    if (actual != "" && actual == confirm) {
      $("#msg12").replaceWith(
        "<span id = 'msg12' style = 'color: green'> Passwords matched. </span>"
      );
      $("#submit-btn").prop("disabled", false);
      $("#login-password").trigger("change");
    } else if (actual == "") {
      $("#msg12").replaceWith(
        "<span id = 'msg12' style = 'color: red'> Password not provided. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    } else {
      $("#msg12").replaceWith(
        "<span id = 'msg12' style = 'color: red'> Passwords don't match. </span>"
      );
      $("#submit-btn").prop("disabled", true);
    }
  });

  $("#reset-btn").click(function () {
    // console.log("clicked");
    $("span").html(" ");
  });

  $("#submit-btn").click(function () {
    $("#confirm-password").trigger("change");
  });

  $("#change-images").click(function () {
    // console.log("hello ");
    $("#hidden-div").show();
    // $("#change-images").hide();
  });
});
