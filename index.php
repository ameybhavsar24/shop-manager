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
    <link href="lib/materialize/materialize.min.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <title>Hello, world!</title>
  </head>
  <body>
    <?php if ($_SESSION['loggedin']) {
        include_once 'nav_user.php';
    } else {
        include_once 'nav.php';
    } ?>
    <div class="content">
    <?php if ($_SESSION['loggedin']) {
        include_once './view_items.php'; ?>
       <div class="row">
         <div class="col s12 m2">
           <div class="row">
            <div class="col s12"><h4 class="flow-text">Welcome <?= $_SESSION[
                'name'
            ] ?></h4></div>
             <div class="col s12">
               <button class="btn modal-trigger waves-effect blue darken-4 " data-target="modal-add-item">
                 <i class="material-icons right">add_box</i>
                 Add a new item
               </button>
               <div id="modal-add-item" class="modal modal-fixed-footer" >
                 <form method="POST" action="add_item.php">
                 <div class="modal-content">
                   <h5 class="text-center">Add a new item</h5>
                   <div class="row" method="POST">
                    <div class="input-field col s12">
                      <input id="item_name" name="name" type="text" class="validate" data-length="120" required autofocus>
                      <label for="item_name">Name</label>
                    </div>
                    <div class="input-field col s12 m4">
                      <input id="item_quantity" name="quantity" type="number" class="validate" value=1 min=1 required>
                      <label for="item_quantity">Quantity</label>
                    </div>
                    <div class="input-field col s12 m4">
                     <i class="material-icons prefix" >&#8377;</i>
                      <input id="item_price" name="price" type="number" class="validate" value=0 min=0 required>
                      <label for="item_price">Price in </label>
                    </div>
                    <div class="input-field col s12 m4">
                      <select name="priceType" required>
                        <option value="weight" selected>Price by weight (kg)</option>
                        <option value="piece">Price by piece (N)</option>
                      </select>
                      <label>Unit of price</label>
                    </div>
                   </div>
                 </div>
                 <div class="modal-footer">
                   <button class="btn waves-effect modal-close grey" type="button">Cancel</button>
                   <button class="btn waves-effect blue darken-4" type="submit">Submit</button>
                 </div>
                 </form>
               </div>
             </div>
           </div>
         </div>
         <div class="col s12 m10">
           <div class="row">
             <h5 class="col s12">All added items</h5>
           </div>
           <div class="row">
             <div class="col s12">
               <table class="highlight">
               <thead>
                 <tr>
                   <th>Name</th>
                   <th>Price</th>
                   <th>Quantity</th>
                   <th>Unit of price</th>
                   <th>Actions</th>
                 </tr>
               </thead>
               <tbody>
               <?php foreach ($_SESSION['items'] as $index => $item) { ?>
                 <tr>
                   <td><?= $item['name'] ?></td>
                   <td>&#8377;<?= $item['price'] ?></td>
                   <td><?= $item['quantity'] ?></td>
                   <td>
                     <?php if ($item['priceType'] == 'weight') {
                         echo 'price per kg';
                     } else {
                         echo 'price per piece';
                     } ?>
                   </td>
                   <td style="white-space:nowrap">
                   <form method="POST" action="edit_item.php">
                     <div class="row">
                       <div class="col s12">
                         <a class="btn btn-floating blue darken-4 white-text modal-trigger" href="#edit-item-<?= $index ?>"><i class="material-icons left">edit</i> Edit</a>
                         <div class="modal modal-edit" id="edit-item-<?= $index ?>">
                           <div class="modal-content">
                             <div class="modal-content">
                               <h5 class="text-center">Edit item</h5>
                               <div class="row" method="POST">

                               <input type="hidden" name="editItem" value=<?= $index ?> >

                                <div class="input-field col s12">
                                  <input id="item_name_edit<?= $index ?>" name="name" type="text" class="validate" data-length="120" value="<?= $item[
    'name'
] ?>" required autofocus>
                                  <label for="item_name_edit<?= $index ?>">Name</label>
                                </div>
                                <div class="input-field col s12 m4">
                                  <input id="item_quantity_edit<?= $index ?>" name="quantity" type="number" class="validate" value=<?= $item[
    'quantity'
] ?> min=1 required>
                                  <label for="item_quantity_edit<?= $index ?>">Quantity</label>
                                </div>
                                <div class="input-field col s12 m4">
                                 <i class="material-icons prefix" >&#8377;</i>
                                  <input id="item_price_edit<?= $index ?>" name="price" type="number" class="validate" value=<?= $item[
    'price'
] ?> min=0 required>
                                  <label for="item_price_edit<?= $index ?>">Price in </label>
                                </div>
                                <div class="input-field col s12 m4">
                                  <select name="priceType" required>
                                    <option value="weight" <?php if (
                                        $item['priceType'] == 'weight'
                                    ) {
                                        echo 'selected';
                                    } ?> >Price by weight (kg)</option>
                                    <option value="piece" <?php if (
                                        $item['priceType'] == 'piece'
                                    ) {
                                        echo 'selected';
                                    } ?> >Price by piece (N)</option>
                                  </select>
                                  <label>Unit of price</label>
                                </div>
                               </div>
                             </div>
                             <div class="modal-footer">
                               <button class="btn waves-effect modal-close grey" type="button">Cancel</button>
                               <button class="btn waves-effect blue darken-4" type="submit">Submit</button>
                             </div>
                             </form>
                           </div>
                         </div>
                         <button data-position="bottom" data-tooltip="Delete this item" class="btn btn-floating waves-effect blue darken-4 white-text tooltipped" type="submit" formaction="./delete_item.php" name="deleteItem" value=<?= (int) $index ?>><i class="material-icons left">delete</i> Delete </button>
                       </div>
                     </div>
                   </form>
                   </td>
                 </tr>
               <?php } ?>
               </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>

      <?php
    } else {
        include_once './forms.php';
    } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="lib/materialize/materialize.min.js"></script>
    <script src="js/main.js"></script>
    <?php if (!empty($_SESSION['error'])) { ?>
      <script>
        alert('<?= $_SESSION['error'] ?>');
      </script>
      <?php } ?>
  </body>
</html>

