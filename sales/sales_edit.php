<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$row = $db->conn->query("SELECT * FROM sales WHERE id_sales=".$id)->fetch_assoc();

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $stmt = $db->conn->prepare("UPDATE sales SET nama_sales=?,alamat=?,telp=? WHERE id_sales=?");
    $stmt->bind_param('sssi',$nama,$alamat,$telp,$id);
    $stmt->execute();
    header('Location: sales_list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Sales</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        form input:focus,
        form textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            display: inline-block;
            padding: 10px 18px;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Sales</h2>
    <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($row['nama_sales']) ?>" required>

        <label>Alamat</label>
        <textarea name="alamat"><?= htmlspecialchars($row['alamat']) ?></textarea>

        <label>Telepon</label>
        <input type="text" name="telp" value="<?= htmlspecialchars($row['telp']) ?>">

        <button type="submit" name="update" class="btn">Update</button>
        <a href="sales_list.php" class="btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
