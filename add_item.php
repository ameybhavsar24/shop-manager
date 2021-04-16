<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  echo '<pre>';
  var_dump($_POST);
  var_dump($_SESSION);
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
  $sql = 'INSERT INTO `items` (`userId`, `name`, `quantity`, `price`, `priceType`) VALUES (?,?,?,?,?)';
  if ($stmt = $mysqli->prepare($sql)) {


    $stmt->bind_param("isiis", $item['userId'], $item['name'], $item['quantity'], $item['price'], $item['priceType']);
    if ($stmt->execute()) {
      header('location: index.php?status=2');
    } else {
      echo 'Failed to exectute';
    }
  } else {
    echo 'Failed to prepare SQL';
  }
?>

