<?php
include "../Database.php";
$db = new Database();
$id = $_GET['id'];
$row = $db->conn->query("SELECT * FROM customer WHERE id_customer=".$id)->fetch_assoc();

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $stmt = $db->conn->prepare("UPDATE customer SET nama_customer=?,alamat=?,telp=?,email=? WHERE id_customer=?");
    $stmt->bind_param('ssssi',$nama,$alamat,$telp,$email,$id);
    $stmt->execute();
    header('Location: customer_list.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Customer</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: #f0f2f8;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .form-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0px 6px 16px rgba(0,0,0,0.1);
      width: 420px;
      animation: fadeIn 0.6s ease-in-out;
    }
    .form-container h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }
    .form-container label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #444;
    }
    .form-container input, 
    .form-container textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-container input:focus, 
    .form-container textarea:focus {
      border-color: #007bff;
      box-shadow: 0 0 6px rgba(0,123,255,0.5);
    }
    .form-container button {
      width: 100%;
      padding: 12px;
      background: #28a745;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .form-container button:hover {
      background: #1e7e34;
    }
    .form-container p {
      text-align: center;
      margin-top: 15px;
    }
    .form-container a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }
    .form-container a:hover {
      text-decoration: underline;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px);}
      to { opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Customer</h2>
    <form method="POST">
      <label>Nama:</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($row['nama_customer']) ?>" required>
      
      <label>Alamat:</label>
      <textarea name="alamat" rows="3"><?= htmlspecialchars($row['alamat']) ?></textarea>
      
      <label>Telp:</label>
      <input type="text" name="telp" value="<?= htmlspecialchars($row['telp']) ?>">
      
      <label>Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
      
      <button type="submit" name="update">Update</button>
    </form>
    <p><a href="customer_list.php">⬅ Kembali</a></p>
  </div>
</body>
</html>
