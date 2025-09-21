<?php
include "../Database.php";
$db = new Database();
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password']; // plaintext for simplicity
    $level = $_POST['level'];
    $stmt = $db->conn->prepare("INSERT INTO petugas (nama_user, username, password, level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $nama, $username, $password, $level);
    $stmt->execute();
    header('Location: petugas_list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Tambah Petugas</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9fafb;
    padding: 40px;
  }
  .container {
    max-width: 480px;
    margin: auto;
    background: white;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  }
  h2 {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
  }
  input[type="text"],
  select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  select:focus {
    border-color: #007bff;
    outline: none;
  }
  button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #0056b3;
  }
  .back-link {
    display: block;
    margin-top: 20px;
    text-align: center;
    text-decoration: none;
    color: #007bff;
    font-weight: 600;
  }
  .back-link:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>
  <div class="container">
    <h2>Tambah Petugas</h2>
    <form method="POST">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>

      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password</label>
      <input type="text" id="password" name="password" required>

      <label for="level">Level</label>
      <select id="level" name="level">
        <option value="admin">admin</option>
        <option value="kasir">kasir</option>
      </select>

      <button type="submit" name="simpan">Simpan</button>
    </form>
    <a href="petugas_list.php" class="back-link">← Kembali ke Daftar Petugas</a>
  </div>
</body>
</html>
