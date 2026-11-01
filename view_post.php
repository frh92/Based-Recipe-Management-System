<?php
// File untuk MELIHAT DETAIL MAKANAN

require_once 'config.php';

// Ambil id dari URL
$id = (int)$_GET['id'];

// Ambil data makanan
$stmt = $pdo->prepare("SELECT * FROM makanan WHERE id=?");
$stmt->execute([$id]);
$m = $stmt->fetch();

// Ambil bahan melalui relasi
$bstmt = $pdo->prepare("
    SELECT b.nama_bahan
    FROM relasi r
    JOIN bahan b ON b.id = r.bahan_id
    WHERE r.makanan_id=?
");
$bstmt->execute([$id]);
$bahan = $bstmt->fetchAll();
