<?php
// --- PENGATURAN KONEKSI DATABASE ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bendungan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan request adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data langsung dari form
    $nama = $_POST['kntk_nama'];
    $email = $_POST['kntk_email'];
    $subjek = $_POST['kntk_subjek'];
    $pesan = $_POST['kntk_pesan'];

    // Siapkan perintah SQL untuk memasukkan data
    // mysqli_real_escape_string tidak diperlukan saat menggunakan prepared statements
    $stmt = $conn->prepare("INSERT INTO kontak_masuk (nama, email, subjek, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $subjek, $pesan);

    // Eksekusi perintah dan alihkan halaman
    if ($stmt->execute()) {
        header("Location: kontak.php?status=sukses");
    } else {
        header("Location: kontak.php?status=gagal");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
    exit(); // Hentikan eksekusi skrip setelah redirect
}
?>