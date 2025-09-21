<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$db->conn->query("DELETE FROM petugas WHERE id_user=".$id);
header('Location: petugas_list.php');
exit;
?>
