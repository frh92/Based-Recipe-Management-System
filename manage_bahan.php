<?php
// CRUD khusus tabel bahan

require_once 'config.php';

// Tambah bahan
if (isset($_POST['nama_bahan'])) {
    $stmt = $pdo->prepare("INSERT INTO bahan (nama_bahan) VALUES (?)");
    $stmt->execute([$_POST['nama_bahan']]);
}

// Ambil semua bahan
$bahan = $pdo->query("SELECT * FROM bahan")->fetchAll();
