<?php
include "../Database.php";
$db = new Database();
if(isset($_POST['simpan'])){
    $id_customer = $_POST['id_customer'];
    $id_user = $_POST['id_user'];
    $tanggal = $_POST['tanggal'];
    $db->conn->query("INSERT INTO transaksi (id_customer,id_user,tanggal,total) VALUES ('$id_customer','$id_user','$tanggal',0)");
    $id_transaksi = $db->conn->insert_id;
    $total = 0;
    if(isset($_POST['id_item'])){
        foreach($_POST['id_item'] as $i => $id_item){
            $qty = (int)$_POST['qty'][$i];
            $harga = (float)$_POST['harga'][$i];
            $subtotal = $qty * $harga;
            $db->conn->query("INSERT INTO transaksi_item (id_transaksi,id_item,qty,harga,subtotal) VALUES ('$id_transaksi','$id_item','$qty','$harga','$subtotal')");
            $db->conn->query("UPDATE item SET stok = stok - $qty WHERE id_item = $id_item");
            $total += $subtotal;
        }
    }
    $db->conn->query("UPDATE transaksi SET total = $total WHERE id_transaksi = $id_transaksi");
    header('Location: transaksi_list.php');
    exit;
}
$customers = $db->conn->query("SELECT * FROM customer");
$petugass = $db->conn->query("SELECT * FROM petugas");
$items = $db->conn->query("SELECT * FROM item");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambah Transaksi</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9fafd;
    margin: 20px;
    color: #333;
  }
  h2 {
    color: #34495e;
    margin-bottom: 20px;
  }
  form {
    background: #fff;
    padding: 20px 25px;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.1);
    max-width: 700px;
  }
  label {
    font-weight: 600;
  }
  select, input[type="date"], input[type="number"] {
    padding: 8px 10px;
    margin-top: 6px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
    box-sizing: border-box;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  table th, table td {
    border: 1px solid #ddd;
    padding: 10px 12px;
    text-align: center;
  }
  table th {
    background-color: #2980b9;
    color: white;
  }
  table tbody tr:nth-child(even) {
    background: #f5f8fb;
  }
  input[type="checkbox"] {
    transform: scale(1.2);
    cursor: pointer;
  }
  input[type="number"]:disabled {
    background: #eee;
    cursor: not-allowed;
  }
  button {
    background-color: #2980b9;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #1c5980;
  }
  a.back-link {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #2980b9;
    font-weight: 600;
  }
  a.back-link:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<h2>Tambah Transaksi</h2>

<form method="POST" id="transaksiForm">
  <label for="id_customer">Customer:</label>
  <select name="id_customer" id="id_customer" required>
    <?php while($c = $customers->fetch_assoc()){ ?>
      <option value="<?= $c['id_customer'] ?>"><?= htmlspecialchars($c['nama_customer']) ?></option>
    <?php } ?>
  </select>

  <label for="id_user">Petugas:</label>
  <select name="id_user" id="id_user" required>
    <?php while($p = $petugass->fetch_assoc()){ ?>
      <option value="<?= $p['id_user'] ?>"><?= htmlspecialchars($p['nama_user']) ?></option>
    <?php } ?>
  </select>

  <label for="tanggal">Tanggal:</label>
  <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required>

  <h3>Pilih Item</h3>
  <table>
    <thead>
      <tr>
        <th>Pilih</th>
        <th>Nama</th>
        <th>Qty</th>
        <th>Harga (Rp)</th>
      </tr>
    </thead>
    <tbody>
      <?php while($it = $items->fetch_assoc()){ ?>
      <tr>
        <td><input type="checkbox" name="id_item[]" value="<?= $it['id_item'] ?>" class="item-checkbox"></td>
        <td><?= htmlspecialchars($it['nama_item']) ?></td>
        <td><input type="number" name="qty[]" value="1" min="1" class="qty-input" disabled></td>
        <td><input type="number" step="0.01" name="harga[]" value="<?= $it['harga'] ?>" class="harga-input" disabled></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <button type="submit" name="simpan">Simpan Transaksi</button>
</form>

<a href="transaksi_list.php" class="back-link">← Kembali</a>

<script>
  // Aktifkan input qty & harga jika checkbox dipilih
  document.querySelectorAll('.item-checkbox').forEach(function(checkbox, index) {
    checkbox.addEventListener('change', function() {
      const qtyInput = document.querySelectorAll('.qty-input')[index];
      const hargaInput = document.querySelectorAll('.harga-input')[index];
      if(this.checked) {
        qtyInput.disabled = false;
        hargaInput.disabled = false;
      } else {
        qtyInput.disabled = true;
        hargaInput.disabled = true;
        qtyInput.value = 1; // reset qty ke 1
        // hargaInput.value = hargaInput.defaultValue; // bisa reset harga jika mau
      }
    });
  });

  // Optional: validasi form sebelum submit
  document.getElementById('transaksiForm').addEventListener('submit', function(e) {
    // Pastikan minimal satu item dicentang
    if(![...document.querySelectorAll('.item-checkbox')].some(cb => cb.checked)) {
      alert('Pilih minimal satu item!');
      e.preventDefault();
    }
  });
</script>

</body>
</html>
