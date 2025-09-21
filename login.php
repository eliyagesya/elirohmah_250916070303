<?php
session_start();
include "Database.php";
$db = new Database();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->conn->prepare("SELECT * FROM petugas WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['level'] = $user['level'];
            header('Location: index.php');
            exit;
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Username tidak ditemukan";
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Login - Koperasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
        }
        .login-container input:focus {
            border-color: #5563DE;
            box-shadow: 0 0 6px rgba(85, 99, 222, 0.6);
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background: #5563DE;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-container button:hover {
            background: #3c49a3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .info {
            margin-top: 15px;
            font-size: 13px;
            color: #666;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Petugas</h2>
        <?php if(isset($error)) echo '<p class="error">'.$error.'</p>'; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p class="info">Default: username <strong>admin</strong> password <strong>admin</strong></p>
    </div>
</body>
</html>
