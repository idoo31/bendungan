<?php
// --- PENGATURAN KONEKSI DATABASE ---
$servername = "localhost"; // Biasanya "localhost"
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "bendungan";     // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan error
    die("Koneksi gagal: " . $conn->connect_error);
}

// --- PROSES DATA DARI FORMULIR ---
// Pastikan request adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan untuk keamanan
    $nama = mysqli_real_escape_string($conn, $_POST['kntk_nama']);
    $email = mysqli_real_escape_string($conn, $_POST['kntk_email']);
    $subjek = mysqli_real_escape_string($conn, $_POST['kntk_subjek']);
    $pesan = mysqli_real_escape_string($conn, $_POST['kntk_pesan']);

    // --- MENYIMPAN DATA KE DATABASE ---
    // Siapkan perintah SQL untuk memasukkan data (menggunakan prepared statement untuk keamanan)
    $stmt = $conn->prepare("INSERT INTO kontak (kntk_nama, kntk_email, kntk_subjek, kntk_pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $subjek, $pesan);

    // Eksekusi perintah
    if ($stmt->execute()) {
        // Jika berhasil, alihkan kembali ke halaman kontak dengan pesan sukses
        header("Location: kontak.php?status=sukses");
    } else {
        // Jika gagal, alihkan kembali ke halaman kontak dengan pesan error
        header("Location: kontak.php?status=gagal");
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>