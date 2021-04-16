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
     include_once('./view_items.php');
       ?>
       <div class="row">
         <div class="col s12"><h4 class="flow-text">Welcome <?= $_SESSION['name'] ?></h4></div>
       </div>
       <div class="row">
         <div class="col s12 m2">
           <div class="row">
             <div class="col s12">
             <button class="btn waves-effect waves-light blue darken-4">
               <i class="material-icons right">add_box</i>
               Add a new item
             </button>
             </div>
           </div>
         </div>
         <div class="col s12 m10">
           <div class="row">
             <h5 class="col s12">All added items</h5>
           </div>
           <div class="row">
             <div class="col s12">
               <table>
               <thead>
                 <tr>
                   <th>Name</th>
                   <th>Price</th>
                   <th>Quantity</th>
                   <th>Unit of price</th>
                 </tr>
               </thead>
               <tbody>
               <?php
               foreach($_SESSION['items'] as $item) {
               ?>
                 <tr>
                   <td><?= $item['name'] ?></td>
                   <td>&#8377;<?= $item['price'] ?></td>
                   <td><?= $item['quantity'] ?></td>
                   <td>
                     <?php
                       if ($item['priceType'] == 'weight') echo 'price per kg';
                       else echo 'price per piece';
                     ?>
                   </td>
                 </tr>
               <?php
               }
               ?>
               </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
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

