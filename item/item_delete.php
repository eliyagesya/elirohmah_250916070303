<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$db->conn->query("DELETE FROM item WHERE id_item=".$id);
header('Location: item_list.php');
exit;
?>
