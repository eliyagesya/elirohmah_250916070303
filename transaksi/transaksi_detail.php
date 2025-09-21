<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$t = $db->conn->query("SELECT t.*, c.nama_customer, p.nama_user FROM transaksi t LEFT JOIN customer c ON t.id_customer=c.id_customer LEFT JOIN petugas p ON t.id_user=p.id_user WHERE t.id_transaksi=$id")->fetch_assoc();
$items = $db->conn->query("SELECT ti.*, it.nama_item FROM transaksi_item ti LEFT JOIN item it ON ti.id_item=it.id_item WHERE ti.id_transaksi=$id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Transaksi #<?= htmlspecialchars($id) ?></title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      margin: 20px;
      color: #333;
    }
    h2 {
      color: #2c3e50;
      border-bottom: 3px solid #2980b9;
      padding-bottom: 8px;
      margin-bottom: 20px;
    }
    .info {
      background: #fff;
      padding: 15px 25px;
      margin-bottom: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .info p {
      margin: 6px 0;
      font-weight: 600;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    table thead {
      background-color: #2980b9;
      color: white;
    }
    table th, table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    table tbody tr:hover {
      background-color: #f1f8ff;
    }
    .total {
      margin-top: 15px;
      font-size: 1.2em;
      font-weight: 700;
      text-align: right;
      color: #27ae60;
    }
    a.back-btn {
      display: inline-block;
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #2980b9;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }
    a.back-btn:hover {
      background-color: #1c5980;
    }
  </style>
</head>
<body>
  <h2>Detail Transaksi #<?= htmlspecialchars($id) ?></h2>
  <div class="info">
    <p>Customer: <?= htmlspecialchars($t['nama_customer']) ?></p>
    <p>Petugas: <?= htmlspecialchars($t['nama_user']) ?></p>
    <p>Tanggal: <?= htmlspecialchars($t['tanggal']) ?></p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php while($it = $items->fetch_assoc()){ ?>
      <tr>
        <td><?= htmlspecialchars($it['nama_item']) ?></td>
        <td><?= (int)$it['qty'] ?></td>
        <td>Rp <?= number_format($it['harga'],2,',','.') ?></td>
        <td>Rp <?= number_format($it['subtotal'],2,',','.') ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  
  <p class="total">Total: Rp <?= number_format($t['total'],2,',','.') ?></p>

  <!-- Tombol Invoice PDF & Kembali -->
  <div style="margin-top: 30px;">
    <a href="transaksi_invoice_pdf.php?id=<?= $id ?>" class="back-btn" style="background-color: #c0392b; margin-right: 10px;">Download Invoice (PDF)</a>
    <a href="transaksi_list.php" class="back-btn">Kembali</a>
  </div>
</body>
</html>
