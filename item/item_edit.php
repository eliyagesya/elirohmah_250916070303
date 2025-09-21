<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$row = $db->conn->query("SELECT * FROM item WHERE id_item=" . $id)->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $stmt = $db->conn->prepare("UPDATE item SET nama_item=?, harga=?, stok=? WHERE id_item=?");
    $stmt->bind_param('sdii', $nama, $harga, $stok, $id);
    $stmt->execute();

    header('Location: item_list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        form label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        form input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
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
    <h2>Edit Item</h2>
    <form method="POST">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($row['nama_item']) ?>" required>

        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" step="0.01" value="<?= $row['harga'] ?>" required>

        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" value="<?= $row['stok'] ?>" required>

        <button type="submit" name="update" class="btn">Update</button>
    </form>
    <a href="item_list.php" class="back-link">← Kembali ke Daftar Item</a>
</div>

</body>
</html>
