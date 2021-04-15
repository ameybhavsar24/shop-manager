<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = false;
}
if (!isset($_SESSION['error'])) {
  $_SESSION['error'] = '';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS -->
    <link href="css/materialize.min.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <title>Hello, world!</title>
  </head>
  <body>
    <?php
      if ($_SESSION['loggedin']) {
        include_once('nav_user.php');
      } else {
        include_once('nav.php');
      }
    ?>
    <div class="content">
    <?php
     if ($_SESSION['loggedin']) {
       ?>
      <h4>Welcome <?= $_SESSION['name'] ?></h4>
      <?php
     } else {
       include_once('./forms.php');
     }
     ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/main.js"></script>
    <?php
      if (!empty($_SESSION['error'])) {
      ?>
      <script>
        alert('<?= $_SESSION['error'] ?>');
      </script>
      <?php
      }
    ?>
  </body>
</html>

