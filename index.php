<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Koperasi</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
        }

        header {
            background-color: #007bff;
            padding: 20px;
            color: white;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        .welcome {
            text-align: center;
            margin: 30px 0 10px 0;
            font-size: 18px;
            color: #333;
        }

        .logout {
            text-align: center;
            margin-bottom: 30px;
        }

        .logout a {
            color: #fff;
            background-color: #dc3545;
            padding: 8px 14px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        .logout a:hover {
            background-color: #c82333;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: white;
            width: 220px;
            padding: 25px 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 16px;
        }

        .card a:hover {
            color: #0056b3;
        }

        @media (max-width: 600px) {
            .card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Dashboard Koperasi</h1>
</header>

<div class="welcome">
    Selamat datang, <strong><?= htmlentities($_SESSION['nama_user']) ?></strong>
</div>

<div class="logout">
    <a href="logout.php">Logout</a>
</div>

<div class="menu-container">
    <div class="card">
        <a href="customer/customer_list.php">Kelola Customer</a>
    </div>
    <div class="card">
        <a href="sales/sales_list.php">Kelola Sales</a>
    </div>
    <div class="card">
        <a href="item/item_list.php">Kelola Item</a>
    </div>
    <div class="card">
        <a href="petugas/petugas_list.php">Kelola Petugas</a>
    </div>
    <div class="card">
        <a href="transaksi/transaksi_list.php">Kelola Transaksi</a>
    </div>
</div>

</body>
</html>
