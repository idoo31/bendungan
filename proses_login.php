<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan query untuk mencari admin berdasarkan username
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // --- PERUBAHAN UTAMA ADA DI SINI ---
        // Kita membandingkan teks password secara langsung, bukan menggunakan hash.
        // INI TIDAK AMAN, HANYA UNTUK DEBUGGING!
        if ($password === $admin['password']) {
            // Jika password cocok, buat session
            $_SESSION['is_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Redirect ke halaman admin
            header("Location: admin.php");
            exit();
        }
    }
    
    // Jika username tidak ditemukan atau password salah, redirect kembali ke login dengan pesan error
    header("Location: login.php?error=1");
    exit();

} else {
    // Jika bukan metode POST, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>