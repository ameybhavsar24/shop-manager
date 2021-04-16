<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$items = [];
require_once './db.php';
$sql = 'SELECT * FROM `items` where `userId` = ?';
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param('s', $_SESSION['id']);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result(
                $itemId,
                $userId,
                $itemName,
                $itemQuantity,
                $itemPrice,
                $itemPriceType
            );
            while ($stmt->fetch()) {
                $item = [
                    'id' => $itemId,
                    'userId' => $userId,
                    'name' => $itemName,
                    'quantity' => $itemQuantity,
                    'price' => $itemPrice,
                    'priceType' => $itemPriceType,
                ];
                array_push($items, $item);
            }
        }
    }
}
$_SESSION['items'] = $items;
?>
