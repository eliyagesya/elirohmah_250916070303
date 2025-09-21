<?php
require_once '../vendor/autoload.php'; // Path ke Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

include "../Database.php";
$db = new Database();
$id = $_GET['id'];

$t = $db->conn->query("SELECT t.*, c.nama_customer, p.nama_user FROM transaksi t 
  LEFT JOIN customer c ON t.id_customer=c.id_customer 
  LEFT JOIN petugas p ON t.id_user=p.id_user 
  WHERE t.id_transaksi=$id")->fetch_assoc();

$items = $db->conn->query("SELECT ti.*, it.nama_item FROM transaksi_item ti 
  LEFT JOIN item it ON ti.id_item=it.id_item 
  WHERE ti.id_transaksi=$id");

ob_start(); // Start output buffering
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Invoice PDF</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; }
    .info p { margin: 0 0 5px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table th, table td { border: 1px solid #000; padding: 6px; text-align: left; }
    .total { text-align: right; font-weight: bold; margin-top: 10px; }
  </style>
</head>
<body>

  <h2>INVOICE TRANSAKSI</h2>

  <div class="info">
    <p><strong>No Transaksi:</strong> <?= htmlspecialchars($id) ?></p>
    <p><strong>Customer:</strong> <?= htmlspecialchars($t['nama_customer']) ?></p>
    <p><strong>Petugas:</strong> <?= htmlspecialchars($t['nama_user']) ?></p>
    <p><strong>Tanggal:</strong> <?= htmlspecialchars($t['tanggal']) ?></p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nama Item</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php while($it = $items->fetch_assoc()) { ?>
      <tr>
        <td><?= htmlspecialchars($it['nama_item']) ?></td>
        <td><?= (int)$it['qty'] ?></td>
        <td>Rp <?= number_format($it['harga'], 2, ',', '.') ?></td>
        <td>Rp <?= number_format($it['subtotal'], 2, ',', '.') ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <p class="total">Total: Rp <?= number_format($t['total'], 2, ',', '.') ?></p>

</body>
</html>

<?php
$html = ob_get_clean(); // Get the HTML content

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("invoice_transaksi_$id.pdf", array("Attachment" => false)); // Ubah ke true jika ingin auto-download
exit;
