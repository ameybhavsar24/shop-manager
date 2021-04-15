<?php
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
  }
  require_once("../db.php");

  $name = $email = $password = $confirm_password = "";
  $name_err = $email_err = $password_err = $confirm_password_err = "";
  $check_errors = true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate email
    if (empty(trim($_POST["email"]))) {
      $email_err = "Please enter a email.";
    } else {
      // prepare a select statement
      $sql = "SELECT id FROM users WHERE email = ?";
      if ($stmt = $mysqli->prepare($sql)) {
        // bind variables to prepared statement as parameters
        $param_email = trim($_POST["email"]);
        $stmt->bind_param("s", $param_email);

        // attempt to execute the prepared statement
        if ($stmt->execute()) {
          // store result
          $stmt->store_result();
          if ($stmt->num_rows == 1) {

            $email_err = "This email already exists";
          } else {
            $email = $mysqli->real_escape_string(trim($_POST["email"]));
          }
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
        }

       $stmt->close();

      }
    }

    // validate name
    if (empty(trim($_POST["name"]))) {
      $name_err = "Please enter your name.";
    } else {
      $name = $mysqli->real_escape_string(trim($_POST["name"]));
    }

    // validate password
    if (empty(trim($_POST["password"]))) {
      $password_err = "Please enter a password.";
    } else if (strlen(trim($_POST["password"])) < 6) {
      $password_err = "Password must have atleast 6 characters.";
    } else {
      $password = $mysqli->real_escape_string(trim($_POST["password"]));
    }

    // validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
      $confirm_password_err = "Please confirm your password.";
    } else {
      $confirm_password = $mysqli->real_escape_string(trim($_POST["confirm_password"]));
      if (empty($password_err) && ($password != $confirm_password)) {
        $confirm_password_err = "Passwords did not match.";
      }
    }

    $check_errors = empty($email_err) && empty($password_err) && empty($name_err) && empty($confirm_password_err);

    if ($check_errors) {
      // insert new user to database
      $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        // bind variables to prepared statement as parameters
        $param_name = $name;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $param_name, $param_email, $param_password);

        // Attempt to exectute the prepared statement
        if ($stmt->execute()) {
          header("location: login.php?status=1");
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
        }
        $stmt->close();
      }
    }
    $mysqli->close();
  }
?>

