<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  /*echo '<pre>';
  var_dump($_POST);
  var_dump($_SESSION);*/
  $id = $_SESSION['items'][((int)$_POST['editItem'])]['id'];
  // echo $id;
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header ('location: index.php');
    exit;
  }

  require_once("./db.php");
  $item = [];
  $item['userId'] = (int)$mysqli->real_escape_string($_SESSION['id']);
  $item['name'] = $mysqli->real_escape_string($_POST['name']);
  $item['quantity'] = (int)$mysqli->real_escape_string($_POST['quantity']);
  $item['price'] = (int)$mysqli->real_escape_string($_POST['price']);
  $item['priceType'] = $mysqli->real_escape_string($_POST['priceType']);
  var_dump($item);
  $sql = 'UPDATE `items` SET `name`=?,`quantity`=?,`price`=?,`priceType`=? WHERE `id` = ?';
  if ($stmt = $mysqli->prepare($sql)) {

    $stmt->bind_param("siisi", $item['name'], $item['quantity'], $item['price'], $item['priceType'], $id);
    if ($stmt->execute()) {
      header('location: index.php?status=4');
    } else {
      echo 'Failed to exectute';
      die(htmlspecialchars($mysqli->error));
    }

  } else {
    echo 'Failed to prepare SQL';
  }
?>

