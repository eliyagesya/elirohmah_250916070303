<?php
include "../Database.php";
$db = new Database();
$res = $db->conn->query("
    SELECT t.*, c.nama_customer, p.nama_user 
    FROM transaksi t 
    LEFT JOIN customer c ON t.id_customer = c.id_customer 
    LEFT JOIN petugas p ON t.id_user = p.id_user 
    ORDER BY t.id_transaksi DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            margin: 0;
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

        .action-link {
            background-color: #17a2b8;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .action-link:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>

<h2>Daftar Transaksi</h2>

<div class="top-nav">
    <a href="transaksi_add.php">+ Tambah Transaksi</a>
    <a href="../index.php">Kembali</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Petugas</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = $res->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id_transaksi'] ?></td>
        <td><?= htmlspecialchars($row['nama_customer']) ?></td>
        <td><?= htmlspecialchars($row['nama_user']) ?></td>
        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
        <td>Rp <?= number_format($row['total'], 2, ',', '.') ?></td>
        <td>
            <a class="action-link" href="transaksi_detail.php?id=<?= $row['id_transaksi'] ?>">Detail</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
