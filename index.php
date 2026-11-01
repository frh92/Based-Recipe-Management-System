<?php
// index.php
// HALAMAN UTAMA aplikasi resep makanan

require_once 'config.php'; // koneksi database

// Ambil semua data makanan
$stmt = $pdo->query("
    SELECT id, nama_makanan, waktu_memasak, updateAdd
    FROM makanan
    ORDER BY updateAdd DESC
");

$makanan = $stmt->fetchAll();
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Daftar Resep Makanan</title>
<link rel="stylesheet" href="./Assets/css/style.css">
</head>
<body>

<div class="container">
<h1>📋 Daftar Resep Makanan</h1>

<!-- Navigasi utama -->
<div class="actions">
    <a class="btn" href="new_post.php">➕ Tambah Makanan</a>
    <a class="btn" href="manage_bahan.php">🧂 Kelola Bahan</a>
</div>

<!-- List makanan -->
<?php if (empty($makanan)): ?>
    <p>Belum ada data makanan.</p>
<?php else: ?>
    <ul class="post-list">
    <?php foreach ($makanan as $m): ?>
        <li class="post-item">
        <strong><?= htmlspecialchars($m['nama_makanan']) ?></strong><br>
        ⏱️ <?= htmlspecialchars($m['waktu_memasak']) ?><br>

        <!-- Aksi CRUD -->
        <a href="view_post.php?id=<?= $m['id'] ?>">Lihat</a> |
        <a href="new_post.php?id=<?= $m['id'] ?>">Edit</a> |
        <a href="delete_post.php?id=<?= $m['id'] ?>"
            onclick="return confirm('Yakin ingin menghapus?')">
            Hapus
        </a>
        </li>
    <?php endforeach; ?>
    </ul><?php endif; ?>
</div>

</body>
</html>
