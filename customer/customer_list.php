<?php
include "../Database.php";
$db = new Database();
$res = $db->conn->query("SELECT * FROM customer");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Customer</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: #f4f6f9;
      padding: 30px;
      margin: 0;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .actions {
      margin-bottom: 20px;
    }
    .btn {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: background 0.3s;
    }
    .btn-primary {
      background: #007bff;
      color: #fff;
    }
    .btn-primary:hover {
      background: #0056b3;
    }
    .btn-secondary {
      background: #6c757d;
      color: #fff;
    }
    .btn-secondary:hover {
      background: #565e64;
    }
    .btn-edit {
      background: #ffc107;
      color: #000;
      padding: 5px 10px;
    }
    .btn-edit:hover {
      background: #e0a800;
    }
    .btn-delete {
      background: #dc3545;
      color: #fff;
      padding: 5px 10px;
    }
    .btn-delete:hover {
      background: #b02a37;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      font-size: 14px;
    }
    th {
      background: #007bff;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    tr:hover {
      background: #f1f7ff;
    }
    td a {
      margin: 0 3px;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <h2>Daftar Customer</h2>
  <div class="actions">
    <a href="customer_add.php" class="btn btn-primary">+ Tambah Customer</a>
    <a href="../index.php" class="btn btn-secondary">⬅ Kembali</a>
  </div>
  <table>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Telp</th>
      <th>Email</th>
      <th>Aksi</th>
    </tr>
    <?php while($row = $res->fetch_assoc()){ ?>
    <tr>
      <td><?= $row['id_customer'] ?></td>
      <td><?= htmlspecialchars($row['nama_customer']) ?></td>
      <td><?= htmlspecialchars($row['alamat']) ?></td>
      <td><?= htmlspecialchars($row['telp']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td>
        <a href="customer_edit.php?id=<?= $row['id_customer'] ?>" class="btn btn-edit">✏ Edit</a>
        <a href="customer_delete.php?id=<?= $row['id_customer'] ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus?')">🗑 Hapus</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
