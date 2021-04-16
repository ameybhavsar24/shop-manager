<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('location: index.php');
    exit();
}
require_once './db.php';
echo '<pre>';
$id = $_SESSION['items'][((int) $_POST['deleteItem'])]['id'];
$sql = 'DELETE FROM `items` WHERE `id` = ?';
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header('location: index.php?status=3');
        exit();
    } else {
        echo 'Failed to delete';
    }
} else {
    echo 'Failed to prepare statement';
}

?>
