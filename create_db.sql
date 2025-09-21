-- SQL script to create database and tables for Koperasi (simple version)
CREATE DATABASE IF NOT EXISTS koperasi;
USE koperasi;

CREATE TABLE IF NOT EXISTS customer (
    id_customer INT AUTO_INCREMENT PRIMARY KEY,
    nama_customer VARCHAR(100),
    alamat TEXT,
    telp VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS sales (
    id_sales INT AUTO_INCREMENT PRIMARY KEY,
    nama_sales VARCHAR(100),
    alamat TEXT,
    telp VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS item (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    nama_item VARCHAR(100),
    harga DECIMAL(12,2),
    stok INT
);

CREATE TABLE IF NOT EXISTS petugas (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama_user VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    level ENUM('admin','kasir') DEFAULT 'kasir'
);

CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_customer INT,
    id_user INT,
    tanggal DATE,
    total DECIMAL(12,2),
    FOREIGN KEY (id_customer) REFERENCES customer(id_customer) ON DELETE SET NULL,
    FOREIGN KEY (id_user) REFERENCES petugas(id_user) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS transaksi_item (
    id_trans_item INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT,
    id_item INT,
    qty INT,
    harga DECIMAL(12,2),
    subtotal DECIMAL(12,2),
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi) ON DELETE CASCADE,
    FOREIGN KEY (id_item) REFERENCES item(id_item) ON DELETE SET NULL
);

-- Insert a default petugas (username: admin, password: admin)
INSERT INTO petugas (nama_user, username, password, level)
VALUES ('Administrator','admin','admin','admin')
ON DUPLICATE KEY UPDATE username = username;
