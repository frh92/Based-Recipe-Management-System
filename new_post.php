<?php
// File untuk MENAMPILKAN FORM tambah/edit makanan

require_once 'config.php'; // ambil koneksi database

// Fungsi untuk mencegah XSS (keamanan)
function e($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

// Variabel default
$makanan = null;              // data makanan (jika edit)
$selectedBahanIds = [];       // bahan yang dipilih

// CEK MODE EDIT
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil data makanan berdasarkan id
    $stmt = $pdo->prepare("SELECT * FROM makanan WHERE id = ?");
    $stmt->execute([$id]);
    $makanan = $stmt->fetch();

    // Ambil bahan yang berelasi
    $rb = $pdo->prepare("SELECT bahan_id FROM relasi WHERE makanan_id = ?");
    $rb->execute([$id]);
    $selectedBahanIds = $rb->fetchAll(PDO::FETCH_COLUMN);
}

// Ambil semua bahan untuk checkbox
$b = $pdo->query("SELECT * FROM bahan ORDER BY nama_bahan");
$allBahan = $b->fetchAll();
?>
