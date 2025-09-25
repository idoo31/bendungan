<?php
require_once 'koneksi.php';

session_start();
// "Penjaga" halaman admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// Fungsi untuk membuat slug yang SEO-friendly
function generateSlug($text) {
    // Ganti semua karakter non-huruf dan non-angka dengan strip
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterasi karakter (misal: "á" menjadi "a")
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Hapus karakter yang tidak diinginkan
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim strip dari awal dan akhir
    $text = trim($text, '-');
    // Hapus strip ganda
    $text = preg_replace('~-+~', '-', $text);
    // Ubah menjadi huruf kecil
    $text = strtolower($text);
    // Jika kosong, beri nama default
    return empty($text) ? 'n-a' : $text;
}

// Fungsi untuk menangani upload gambar dengan aman
function uploadGambar($file_input) {
    if (isset($file_input) && $file_input["error"] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        $image_file_type = strtolower(pathinfo(basename($file_input["name"]), PATHINFO_EXTENSION));
        $new_file_name = uniqid('img_', true) . '.' . $image_file_type;
        $target_file = $target_dir . $new_file_name;
        
        // Validasi penting: cek apakah file benar-benar gambar dan batasi tipe file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_file_type, $allowed_types) || getimagesize($file_input["tmp_name"]) === false) {
            return false;
        }
        
        // Pindahkan file dan return path jika berhasil
        if (move_uploaded_file($file_input["tmp_name"], $target_file)) {
            return $target_file;
        }
    }
    return false;
}

// --- LOGIKA UTAMA: MEMPROSES AKSI DARI FORM ATAU URL ---
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    // AKSI: Menyimpan artikel baru
    case 'save':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $judul = trim($_POST['judul']);
            $slug = generateSlug($judul);
            $url_gambar = uploadGambar($_FILES['gambar']);

            if (!$url_gambar) {
                die("Error: Gagal mengupload gambar. Pastikan file adalah gambar (JPG, PNG, GIF) dan tidak rusak.");
            }

            $sql = "INSERT INTO artikel (judul, slug, isi_konten, penulis, status, url_gambar, keterangan_gambar, waktu_terbit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            
            // Membersihkan isi konten dari tag HTML yang tidak diizinkan
            $allowed_tags = '<p><strong><em><u><ol><li><h1><h2><h3><h4><a><img><blockquote><b><i>';
            $isi_konten_aman = strip_tags($_POST['isi_konten'], $allowed_tags);
            
            $waktu_terbit = ($_POST['status'] == 'diterbitkan') ? date('Y-m-d H:i:s') : null;
            $stmt->bind_param("ssssssss", $judul, $slug, $isi_konten_aman, $_POST['penulis'], $_POST['status'], $url_gambar, $_POST['keterangan_gambar'], $waktu_terbit);
            
            if ($stmt->execute()) {
                header("Location: ../admin.php?pesan=sukses_simpan");
                exit();
            } else {
                die("Error: Gagal menyimpan data ke database. " . $stmt->error);
            }
        }
        break;

    // AKSI: Memperbarui artikel yang sudah ada
    case 'update':
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $judul = trim($_POST['judul']);
            $slug = generateSlug($judul);
            $url_gambar = $_POST['gambar_lama']; // Default ke gambar lama

            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $gambar_baru = uploadGambar($_FILES['gambar']);
                if ($gambar_baru) {
                    if (file_exists($url_gambar)) {
                        unlink($url_gambar);
                    }
                    $url_gambar = $gambar_baru;
                }
            }

            $sql = "UPDATE artikel SET judul=?, slug=?, isi_konten=?, penulis=?, status=?, url_gambar=?, keterangan_gambar=?, waktu_terbit=? WHERE id=?";
            
            // --- PERBAIKAN DI SINI ---
            // Mengganti $koneosi menjadi $koneksi
            $stmt = $koneksi->prepare($sql);

            // Membersihkan isi konten dari tag HTML yang tidak diizinkan
            $allowed_tags = '<p><strong><em><u><ol><li><h1><h2><h3><h4><a><img><blockquote><b><i>';
            $isi_konten_aman = strip_tags($_POST['isi_konten'], $allowed_tags);

            $waktu_terbit = ($_POST['status'] == 'diterbitkan') ? date('Y-m-d H:i:s') : null;
            $stmt->bind_param("ssssssssi", $judul, $slug, $isi_konten_aman, $_POST['penulis'], $_POST['status'], $url_gambar, $_POST['keterangan_gambar'], $waktu_terbit, $id);

            if ($stmt->execute()) {
                header("Location: ../admin.php?pesan=sukses_update");
                exit();
            } else {
                die("Error: Gagal memperbarui data. " . $stmt->error);
            }
        }
        break;

    // AKSI: Menghapus artikel
    case 'delete':
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            
            $stmt = $koneksi->prepare("SELECT url_gambar FROM artikel WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                if (file_exists($row['url_gambar'])) {
                    unlink($row['url_gambar']);
                }
            }
            $stmt->close();

            $stmt = $koneksi->prepare("DELETE FROM artikel WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                header("Location: ../admin.php?pesan=sukses_hapus");
                exit();
            } else {
                die("Error: Gagal menghapus data. " . $stmt->error);
            }
        }
        break;

    default:
        die("Aksi tidak valid atau tidak diizinkan.");
        break;
}

$koneksi->close();
?>