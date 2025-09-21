<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$db->conn->query("DELETE FROM customer WHERE id_customer=".$id);
header('Location: customer_list.php');
exit;
?>
