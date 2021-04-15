<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
  }
  require_once("./db.php");

  $name = $email = $password = "";
  $name_err = $email_err = $password_err = "";
  $check_errors = true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate email
    if (empty(trim($_POST["email_register"]))) {
      $email_err = "Please enter a email.";
    } else {
      // prepare a select statement
      $sql = "SELECT id FROM users WHERE email = ?";
      if ($stmt = $mysqli->prepare($sql)) {
        // bind variables to prepared statement as parameters
        $param_email = trim($_POST["email_register"]);
        $stmt->bind_param("s", $param_email);

        // attempt to execute the prepared statement
        if ($stmt->execute()) {
          // store result
          $stmt->store_result();
          if ($stmt->num_rows == 1) {
            $email_err = "This email already exists";
          } else {
            $email = $mysqli->real_escape_string(trim($_POST["email_register"]));
          }
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
        }

       $stmt->close();

      }
    }

    // validate name
    if (empty(trim($_POST["name_register"]))) {
      $name_err = "Please enter your name.";
    } else {
      $name = $mysqli->real_escape_string(trim($_POST["name_register"]));
    }

    // validate password
    if (empty(trim($_POST["password_register"]))) {
      $password_err = "Please enter a password.";
    } else {
      $password = $mysqli->real_escape_string(trim($_POST["password_register"]));
    }

    $check_errors = empty($email_err) && empty($password_err) && empty($name_err);
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
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION["name"] = $name;
          $_SESSION["email"] = $email;
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
        }
        $stmt->close();
      } else {
        $_SESSION['error'] = $name_err.' '.$email_err.' '.$password_err;
      }
    }
    $mysqli->close();
  }
  header("location: index.php");
?>

