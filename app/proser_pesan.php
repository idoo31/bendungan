<?php
require_once 'koneksi.php';

session_start();
// Pastikan hanya admin yang login yang bisa mengakses
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$redirect_url = "../admin.php?page=pesan"; // URL default untuk redirect

if ($action === 'delete' && $id > 0) {
    // Gunakan prepared statement untuk menghapus pesan dari tabel 'kontak_masuk'
    // Nama tabel 'kontak' diubah menjadi 'kontak_masuk' sesuai database Anda
    $stmt = $koneksi->prepare("DELETE FROM kontak_masuk WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Jika berhasil, tambahkan status sukses ke URL redirect
        $redirect_url .= "&status=deleted";
    } else {
        // Jika gagal, tambahkan status error. die() diganti dengan redirect.
        $redirect_url .= "&status=error_delete";
    }
    // Statement ditutup di sini agar selalu dieksekusi setelah dipakai
    $stmt->close();
}

// Koneksi ditutup sebelum redirect
$koneksi->close();

// Lakukan redirect di akhir skrip
header("Location: " . $redirect_url);
exit();
?>