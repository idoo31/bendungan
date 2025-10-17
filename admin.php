<?php
require_once 'app/koneksi.php';

session_start();
// "Penjaga" halaman admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Mengambil username dari session
$admin_username = $_SESSION['admin_username'] ?? 'Admin';

// Tentukan halaman yang akan ditampilkan: artikel (default), pesan, atau tanyajawab
$page = $_GET['page'] ?? 'artikel';
$action = $_GET['action'] ?? 'list';

// Variabel untuk menampung data
$artikel_data = null;
$tanya_jawab_data = null;

// Logika untuk mengambil data artikel yang akan diedit
if ($page === 'artikel' && $action === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM artikel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $artikel_data = $result->fetch_assoc();
    }
    $stmt->close();
}

// Logika untuk mengambil data Q&A (baik dari pesan masuk atau data yang sudah ada)
if ($page === 'tanyajawab') {
    if ($action === 'add' && isset($_GET['from_id'])) {
        // Ambil data dari tabel kontak_masuk untuk dijadikan pertanyaan publik
        $from_id = (int)$_GET['from_id'];
        $stmt = $koneksi->prepare("SELECT nama, subjek, pesan FROM kontak_masuk WHERE id = ?");
        $stmt->bind_param("i", $from_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $pesan_asli = $result->fetch_assoc();
            $tanya_jawab_data['nama_penanya'] = $pesan_asli['nama'];
            // Gabungkan subjek dan pesan sebagai pertanyaan agar lebih kontekstual
            $tanya_jawab_data['pertanyaan'] = "Subjek: " . $pesan_asli['subjek'] . "\n\nPesan: " . $pesan_asli['pesan'];
        }
        $stmt->close();
    } elseif ($action === 'edit' && isset($_GET['id'])) {
        // Ambil data dari tabel tanya_jawab untuk diedit
        $id = (int)$_GET['id'];
        $stmt = $koneksi->prepare("SELECT * FROM tanya_jawab WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $tanya_jawab_data = $result->fetch_assoc();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dasbor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .ql-editor { font-family: 'Inter', sans-serif; font-size: 1rem; color: #1f2937; min-height: 350px; }
        .ql-toolbar.ql-snow { border: 1px solid #d1d5db; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; }
        .ql-container.ql-snow { border: 1px solid #d1d5db; border-bottom-left-radius: 0.5rem; border-bottom-right-radius: 0.5rem; }
    </style>
</head>
<body class="min-h-full">
    <div class="flex min-h-screen">
        <aside class="w-64 flex-shrink-0 bg-gray-800 text-white flex flex-col">
            <div class="h-16 flex items-center justify-center px-4 bg-gray-900 shadow-md">
                <h1 class="text-xl font-bold">Admin Dasbor</h1>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-2">
                <a href="admin.php?page=artikel" class="flex items-center px-3 py-2.5 rounded-lg transition-colors <?php echo $page === 'artikel' ? 'bg-blue-600 font-semibold' : 'hover:bg-gray-700'; ?>">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                    <span>Kelola Artikel</span>
                </a>
                <a href="admin.php?page=pesan" class="flex items-center px-3 py-2.5 rounded-lg transition-colors <?php echo $page === 'pesan' ? 'bg-blue-600 font-semibold' : 'hover:bg-gray-700'; ?>">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                    <span>Pesan Masuk</span>
                </a>
                <a href="admin.php?page=tanyajawab" class="flex items-center px-3 py-2.5 rounded-lg transition-colors <?php echo $page === 'tanyajawab' ? 'bg-blue-600 font-semibold' : 'hover:bg-gray-700'; ?>">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                    <span>Tanya Jawab Publik</span>
                </a>
            </nav>
            <div class="px-4 py-4 border-t border-gray-700">
                 <div class="text-sm text-gray-400">Login sebagai:</div>
                 <div class="font-semibold truncate"><?php echo htmlspecialchars($admin_username); ?></div>
                 <a href="logout.php" class="mt-4 w-full block text-center bg-red-600 hover:bg-red-700 text-white font-semibold text-sm py-2 px-4 rounded-lg transition-colors">
                    Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <main class="flex-1 p-6 md:p-10">
                <div class="container mx-auto max-w-7xl">

                <?php if ($page === 'artikel'): ?>
                    <?php // ===== KONTEN UNTUK KELOLA ARTIKEL ===== ?>
                    <?php if ($action === 'list'): ?>
                        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Daftar Artikel</h2>
                                    <p class="text-sm text-gray-500 mt-1">Kelola semua artikel yang ada di website.</p>
                                </div>
                                <a href="admin.php?page=artikel&action=add" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                    <span>Tambah Artikel</span>
                                </a>
                            </div>

                            <div class="overflow-x-auto border-t border-gray-200">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="p-4 font-semibold">Judul</th>
                                            <th class="p-4 font-semibold">Status</th>
                                            <th class="p-4 font-semibold">Penulis</th>
                                            <th class="p-4 font-semibold">Tanggal Terbit</th>
                                            <th class="p-4 font-semibold text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <?php
                                        $list_sql = "SELECT id, judul, status, penulis, waktu_terbit FROM artikel ORDER BY id DESC";
                                        $list_result = $koneksi->query($list_sql);
                                        if ($list_result->num_rows > 0):
                                            while($row = $list_result->fetch_assoc()):
                                        ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 font-semibold text-gray-800"><?php echo htmlspecialchars($row['judul']); ?></td>
                                            <td class="p-4">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full <?php echo $row['status'] === 'diterbitkan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                                    <?php echo ucfirst($row['status']); ?>
                                                </span>
                                            </td>
                                            <td class="p-4 text-gray-600"><?php echo htmlspecialchars($row['penulis']); ?></td>
                                            <td class="p-4 text-gray-600"><?php echo $row['waktu_terbit'] ? date('d F Y', strtotime($row['waktu_terbit'])) : '-'; ?></td>
                                            <td class="p-4 text-center space-x-3">
                                                <a href="admin.php?page=artikel&action=edit&id=<?php echo $row['id']; ?>" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                                <span class="text-gray-300">|</span>
                                                <a href="app/proses_artikel.php?action=delete&id=<?php echo $row['id']; ?>" class="font-semibold text-red-600 hover:text-red-800 transition-colors" onclick="return confirm('Anda yakin ingin menghapus artikel ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; else: ?>
                                        <tr><td colspan="5" class="p-8 text-center text-gray-500">Belum ada artikel.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php elseif ($action === 'add' || ($action === 'edit' && isset($artikel_data))): ?>
                        <form id="artikel-form" action="app/proses_artikel.php" method="POST" enctype="multipart/form-data">
                            <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                                <a href="admin.php?page=artikel" title="Kembali" class="text-gray-500 hover:bg-gray-100 rounded-full p-2 mr-3">&larr;</a>
                                <h2 class="text-2xl font-bold text-gray-800"><?php echo $action === 'edit' ? 'Edit Artikel' : 'Buat Artikel Baru'; ?></h2>
                            </div>

                            <input type="hidden" name="action" value="<?php echo $action === 'edit' ? 'update' : 'save'; ?>">
                            <?php if ($action === 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo $artikel_data['id']; ?>">
                                <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($artikel_data['url_gambar']); ?>">
                            <?php endif; ?>
                            <input type="hidden" name="isi_konten" id="isi_konten">
                            
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                <div class="lg:col-span-2 space-y-6">
                                    <div>
                                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                                        <input type="text" name="judul" id="judul" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo htmlspecialchars($artikel_data['judul'] ?? ''); ?>">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten</label>
                                        <div id="editor-container"><?php echo $artikel_data['isi_konten'] ?? ''; ?></div>
                                    </div>
                                </div>

                                <div class="lg:col-span-1 space-y-6">
                                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                                        <h3 class="text-base font-semibold text-gray-800 mb-4">Pengaturan Publikasi</h3>
                                        <div class="space-y-4">
                                            <div>
                                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm">
                                                    <option value="draf" <?php echo (isset($artikel_data) && $artikel_data['status'] == 'draf') ? 'selected' : ''; ?>>Simpan sebagai Draf</option>
                                                    <option value="diterbitkan" <?php echo (isset($artikel_data) && $artikel_data['status'] == 'diterbitkan') ? 'selected' : ''; ?>>Langsung Terbitkan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">Nama Penulis</label>
                                                <input type="text" name="penulis" id="penulis" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required value="<?php echo htmlspecialchars($artikel_data['penulis'] ?? 'Admin Sekolah'); ?>">
                                            </div>
                                        </div>
                                        <button type="submit" class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                                            Simpan Artikel
                                        </button>
                                    </div>
                                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                                        <h3 class="text-base font-semibold text-gray-800 mb-4">Gambar Utama</h3>
                                        <div class="space-y-4">
                                            <div>
                                                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Upload Gambar</label>
                                                <input type="file" name="gambar" id="gambar" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" <?php echo $action === 'add' ? 'required' : ''; ?>>
                                            </div>
                                            <?php if ($action === 'edit' && !empty($artikel_data['url_gambar'])): ?>
                                                <img src="<?php echo htmlspecialchars($artikel_data['url_gambar']); ?>" class="mt-2 rounded-lg w-full h-auto border border-gray-200">
                                            <?php endif; ?>
                                            <div>
                                                <label for="keterangan_gambar" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Gambar</label>
                                                <input type="text" name="keterangan_gambar" id="keterangan_gambar" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required value="<?php echo htmlspecialchars($artikel_data['keterangan_gambar'] ?? ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                <?php elseif ($page === 'pesan'): ?>
                    <?php // ===== KONTEN UNTUK PESAN MASUK ===== ?>
                     <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Pesan Masuk</h2>
                            <p class="text-sm text-gray-500 mt-1">Lihat semua pesan yang dikirim melalui halaman kontak.</p>
                        </div>
                        <div class="overflow-x-auto border-t">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 text-gray-600">
                                    <tr>
                                        <th class="p-4 font-semibold">Pengirim</th>
                                        <th class="p-4 font-semibold">Subjek</th>
                                        <th class="p-4 font-semibold hidden md:table-cell">Pesan</th>
                                        <th class="p-4 font-semibold">Waktu</th>
                                        <th class="p-4 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <?php
                                    $pesan_sql = "SELECT id, nama, email, subjek, pesan, waktu_kirim FROM kontak_masuk ORDER BY id DESC";
                                    $pesan_result = $koneksi->query($pesan_sql);
                                    if ($pesan_result && $pesan_result->num_rows > 0):
                                        while($row = $pesan_result->fetch_assoc()):
                                            $cuplikan_pesan = strlen($row['pesan']) > 80 ? substr($row['pesan'], 0, 80) . "..." : $row['pesan'];
                                    ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4 align-top">
                                            <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($row['nama']); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['email']); ?></div>
                                        </td>
                                        <td class="p-4 font-medium text-gray-700 align-top"><?php echo htmlspecialchars($row['subjek']); ?></td>
                                        <td class="p-4 text-gray-600 align-top hidden md:table-cell"><?php echo htmlspecialchars($cuplikan_pesan); ?></td>
                                        <td class="p-4 text-gray-600 align-top whitespace-nowrap"><?php echo date('d M Y, H:i', strtotime($row['waktu_kirim'])); ?></td>
                                        <td class="p-4 text-center align-top space-x-3 whitespace-nowrap">
                                            <a href="admin.php?page=tanyajawab&action=add&from_id=<?php echo $row['id']; ?>" class="font-semibold text-green-600 hover:text-green-800">Jadikan Publik</a>
                                            <span class="text-gray-300">|</span>
                                            <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="font-semibold text-blue-600 hover:text-blue-800">Balas</a>
                                            <span class="text-gray-300">|</span>
                                            <a href="app/proses_pesan.php?action=delete&id=<?php echo $row['id']; ?>" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Anda yakin ingin menghapus pesan ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr><td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesan yang masuk.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                <?php elseif ($page === 'tanyajawab'): ?>
                    <?php // ===== KONTEN UNTUK TANYA JAWAB PUBLIK ===== ?>
                    <?php if ($action === 'list'): ?>
                        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-800">Kelola Tanya Jawab Publik</h2>
                                <p class="text-sm text-gray-500 mt-1">Daftar pertanyaan dan jawaban yang ditampilkan di halaman publik.</p>
                            </div>
                            <div class="overflow-x-auto border-t">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="p-4 font-semibold">Pertanyaan</th>
                                            <th class="p-4 font-semibold">Jawaban</th>
                                            <th class="p-4 font-semibold">Status</th>
                                            <th class="p-4 font-semibold text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                    <?php
                                    $list_sql = "SELECT id, pertanyaan, jawaban, status FROM tanya_jawab ORDER BY id DESC";
                                    $list_result = $koneksi->query($list_sql);
                                    if ($list_result->num_rows > 0):
                                        while($row = $list_result->fetch_assoc()):
                                    ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 text-gray-700 font-medium"><?php echo htmlspecialchars(substr($row['pertanyaan'], 0, 100)); ?>...</td>
                                            <td class="p-4 text-gray-600"><?php echo htmlspecialchars(substr($row['jawaban'], 0, 100)); ?>...</td>
                                            <td class="p-4"><span class="px-2.5 py-1 text-xs font-semibold rounded-full <?php echo $row['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                            <td class="p-4 text-center space-x-3">
                                                <a href="admin.php?page=tanyajawab&action=edit&id=<?php echo $row['id']; ?>" class="font-semibold text-blue-600 hover:text-blue-800">Edit</a>
                                                <a href="app/proses_tanyajawab.php?action=delete&id=<?php echo $row['id']; ?>" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Anda yakin ingin menghapus tanya jawab ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; else: ?>
                                        <tr><td colspan="4" class="p-8 text-center text-gray-500">Belum ada tanya jawab publik.</td></tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php elseif ($action === 'add' || ($action === 'edit' && isset($tanya_jawab_data))): ?>
                        <form action="app/proses_tanyajawab.php" method="POST" class="bg-white p-8 rounded-xl shadow-sm border">
                            <div class="flex items-center mb-6 pb-4 border-b">
                                <a href="admin.php?page=tanyajawab" title="Kembali" class="text-gray-500 hover:bg-gray-100 rounded-full p-2 mr-3">&larr;</a>
                                <h2 class="text-2xl font-bold text-gray-800"><?php echo $action === 'edit' ? 'Edit' : 'Jawab Pertanyaan'; ?> Publik</h2>
                            </div>

                            <input type="hidden" name="action" value="<?php echo $action === 'edit' ? 'update' : 'save'; ?>">
                            <?php if ($action === 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo $tanya_jawab_data['id']; ?>">
                            <?php endif; ?>
                            <div class="space-y-6">
                                <div>
                                    <label for="nama_penanya" class="block text-sm font-semibold text-gray-700 mb-1">Nama Penanya</label>
                                    <input type="text" name="nama_penanya" id="nama_penanya" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="<?php echo htmlspecialchars($tanya_jawab_data['nama_penanya'] ?? ''); ?>" required>
                                </div>
                                <div>
                                    <label for="pertanyaan" class="block text-sm font-semibold text-gray-700 mb-1">Pertanyaan</label>
                                    <textarea name="pertanyaan" id="pertanyaan" rows="4" class="w-full px-3 py-2 border rounded-lg bg-gray-100" required><?php echo htmlspecialchars($tanya_jawab_data['pertanyaan'] ?? ''); ?></textarea>
                                </div>
                                <div>
                                    <label for="jawaban" class="block text-sm font-semibold text-gray-700 mb-1">Jawaban Anda</label>
                                    <textarea name="jawaban" id="jawaban" rows="6" class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis jawaban sebagai Admin Sekolah..." required><?php echo htmlspecialchars($tanya_jawab_data['jawaban'] ?? ''); ?></textarea>
                                </div>
                                 <div>
                                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                                    <select name="status" id="status" class="w-full px-3 py-2 border rounded-lg bg-white">
                                        <option value="published" <?php echo (isset($tanya_jawab_data['status']) && $tanya_jawab_data['status'] == 'published') ? 'selected' : ''; ?>>Published (Tampilkan)</option>
                                        <option value="hidden" <?php echo (isset($tanya_jawab_data['status']) && $tanya_jawab_data['status'] == 'hidden') ? 'selected' : ''; ?>>Hidden (Sembunyikan)</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg">Simpan Tanya Jawab</button>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
    <script>
        // Script untuk Quill Editor hanya berjalan jika halaman artikel aktif
        if (document.getElementById('editor-container')) {
            const quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'Tulis isi artikel di sini...'
            });
            const form = document.getElementById('artikel-form');
            const contentInput = document.getElementById('isi_konten');
            form.addEventListener('submit', function(e) {
              contentInput.value = quill.root.innerHTML;
            });
        }
    </script>
</body>
</html>