<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$db->conn->query("DELETE FROM sales WHERE id_sales=".$id);
header('Location: sales_list.php');
exit;
?>
