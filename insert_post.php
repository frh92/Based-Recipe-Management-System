<?php
// File PROSES SIMPAN DATA (CREATE & UPDATE)

require_once 'config.php';

// Ambil data dari form
$id            = $_POST['id'] ?? null;
$nama_makanan  = $_POST['nama_makanan'];
$deskripsi     = $_POST['deskripsi'];
$waktu_memasak = $_POST['waktu_memasak'];
$bahan_ids     = $_POST['bahan_id'] ?? [];

$pdo->beginTransaction(); // mulai transaksi (PENTING)

try {
    if ($id) {
        // MODE UPDATE
        $stmt = $pdo->prepare("
            UPDATE makanan 
            SET nama_makanan=?, deskripsi=?, waktu_memasak=?, updateAdd=NOW()
            WHERE id=?
        ");
        $stmt->execute([$nama_makanan, $deskripsi, $waktu_memasak, $id]);

        // Hapus relasi lama
        $pdo->prepare("DELETE FROM relasi WHERE makanan_id=?")->execute([$id]);
    } else {
        // MODE INSERT
        $stmt = $pdo->prepare("
            INSERT INTO makanan (nama_makanan, deskripsi, waktu_memasak, createAdd, updateAdd)
            VALUES (?, ?, ?, NOW(), NOW())
        ");
        $stmt->execute([$nama_makanan, $deskripsi, $waktu_memasak]);

        // Ambil ID makanan terbaru
        $id = $pdo->lastInsertId();
    }

    // Simpan relasi makanan - bahan
    $rel = $pdo->prepare("INSERT INTO relasi (makanan_id, bahan_id) VALUES (?, ?)");
    foreach ($bahan_ids as $bid) {
        $rel->execute([$id, $bid]);
    }

    $pdo->commit(); // simpan permanen
    header("Location: index.php");
} catch (Exception $e) {
    $pdo->rollBack(); // batalkan semua
    die("Gagal menyimpan data: " . $e->getMessage());
}
