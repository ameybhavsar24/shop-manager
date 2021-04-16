<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Initialize session
session_start();
// Check if user is already logged in, if yes redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: index.php');
    exit();
}
require_once 'db.php';
$email = $password = '';
$email_err = $password_err = '';
$check_errors = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['email']))) {
        $email_err = 'Please enter your email.';
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter a password.';
    } else {
        $password = $mysqli->real_escape_string($_POST['password']);
    }

    $check_errors = empty($email_err) && empty($password_err);
    if ($check_errors) {
        $sql = 'SELECT id, name, email, password FROM users where email = ?';
        if ($stmt = $mysqli->prepare($sql)) {
            $param_email = $email;
            $stmt->bind_param('s', $param_email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['name'] = $name;
                            $_SESSION['email'] = $email;

                            header('location: index.php');
                        } else {
                            $password_err =
                                'The password you entered was incorrect.';
                        }
                    }
                } else {
                    $email_err = 'No such account exists.';
                }
            } else {
                echo "<script>alert('Something went wrong! Try again later.')</script>";
            }

            $stmt->close();
        }
    }
    $check_errors = empty($email_err) && empty($password_err);
    $mysqli->close();
}

?>
