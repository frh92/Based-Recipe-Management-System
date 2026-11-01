<?php
// File untuk MENGHAPUS MAKANAN

require_once 'config.php';

$id = (int)$_GET['id'];

$pdo->beginTransaction();

try {
    // Hapus relasi dulu (PENTING)
    $pdo->prepare("DELETE FROM relasi WHERE makanan_id=?")->execute([$id]);

    // Hapus makanan
    $pdo->prepare("DELETE FROM makanan WHERE id=?")->execute([$id]);

    $pdo->commit();
    header("Location: index.php");
} catch (Exception $e) {
    $pdo->rollBack();
    die("Gagal menghapus data");
}
