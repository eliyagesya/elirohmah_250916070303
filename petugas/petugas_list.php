<?php
include "../Database.php";
$db = new Database();
$res = $db->conn->query("SELECT * FROM petugas");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Petugas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .top-nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-nav a {
            background-color: #007bff;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 5px;
            font-size: 14px;
        }

        .top-nav a:hover {
            background-color: #0056b3;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            font-size: 13px;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h2>Daftar Petugas</h2>

<div class="top-nav">
    <a href="petugas_add.php">+ Tambah Petugas</a>
    <a href="../index.php">Kembali</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = $res->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id_user'] ?></td>
        <td><?= htmlspecialchars($row['nama_user']) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['level']) ?></td>
        <td class="actions">
            <a class="edit-btn" href="petugas_edit.php?id=<?= $row['id_user'] ?>">Edit</a>
            <a class="delete-btn" href="petugas_delete.php?id=<?= $row['id_user'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
