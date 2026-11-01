<?php
// config.php
// File ini dipakai untuk KONEKSI DATABASE
// Semua file lain WAJIB memanggil file ini

$host = "localhost";     // alamat server database
$db   = "db_makanan";    // nama database
$user = "root";          // username database
$pass = "";              // password database (default XAMPP kosong)
$charset = "utf8mb4";    // charset agar support simbol & emoji

// DSN = Data Source Name (format koneksi PDO)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi tambahan untuk PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // error ditampilkan sebagai exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil query jadi array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                   // matikan emulasi prepare (lebih aman)
];

try {
    // Membuat koneksi ke database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    // Jika koneksi gagal, program berhenti
    die("Koneksi database gagal: " . $e->getMessage());
}
