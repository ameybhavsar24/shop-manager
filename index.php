<?php
  session_start();
  $_SESSION['loggedin'] = false;
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
    <div class="container">
    <div class="row">
      <div class="col s12 m6">
        <div class="row">
          <div class="col s12">
            <h5 class="text-center">Login</h5>
          </div>
        <form class="col s12" action="./login.php" method="POST">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 offset-m1">
              <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
              </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="row">
          <div class="col s12">
            <h5 class="text-center">Register</h5>
          </div>
        <form class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input name="name_register" id="name_register" type="text" class="validate">
                <label for="name_register">Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input id="email_register" type="email" class="validate">
                <label for="email_register">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input id="password_register" type="password" class="validate">
                <label for="password_register">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 offset-m1">
              <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
              </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

