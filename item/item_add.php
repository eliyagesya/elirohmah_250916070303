<?php
include "../Database.php";
$db = new Database();

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $stmt = $db->conn->prepare("INSERT INTO item (nama_item, harga, stok) VALUES (?, ?, ?)");
    $stmt->bind_param('sdi', $nama, $harga, $stok);
    $stmt->execute();

    header('Location: item_list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Item</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f0f2f5;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            width: 100%;
        }

        .btn:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Item</h2>
    <form method="POST">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>

        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" step="0.01" required>

        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" required>

        <button type="submit" name="simpan" class="btn">Simpan</button>
    </form>
    <a href="item_list.php" class="back-link">← Kembali ke Daftar Item</a>
</div>

</body>
</html>
