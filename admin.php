<?php
require_once 'koneksi.php';

session_start();
// "Penjaga" halaman admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Mengambil username dari session
$admin_username = $_SESSION['admin_username'] ?? 'Admin';

// Tentukan halaman yang akan ditampilkan: artikel (default) atau pesan
$page = $_GET['page'] ?? 'artikel';
$action = $_GET['action'] ?? 'list';
$artikel_data = null; 

// Logika khusus jika halaman adalah 'artikel' dan aksinya 'edit'
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
        .ql-editor { min-height: 350px; }
        .ql-toolbar.ql-snow { border-radius: 0.5rem 0.5rem 0 0; }
        .ql-container.ql-snow { border-radius: 0 0 0.5rem 0.5rem; }
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
                    <?php // ===== KONTEN UNTUK KELOLA ARTIKEL (KODE LAMA ANDA) ===== ?>
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
                            </div>
                    <?php elseif ($action === 'add' || ($action === 'edit' && isset($artikel_data))): ?>
                        <form id="artikel-form" action="proses_artikel.php" method="POST" enctype="multipart/form-data">
                             </form>
                    <?php endif; ?>

                <?php elseif ($page === 'pesan'): ?>
                    <?php // ===== KONTEN BARU UNTUK MENAMPILKAN PESAN MASUK ===== ?>
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
                                    // Menggunakan nama tabel dan kolom dari file proses_kontak.php Anda
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
                                        <td class="p-4 text-center align-top space-x-3">
                                            <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="font-semibold text-blue-600 hover:text-blue-800">Balas</a>
                                            <span class="text-gray-300">|</span>
                                            <a href="proses_pesan.php?action=delete&id=<?php echo $row['id']; ?>" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Anda yakin ingin menghapus pesan ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr><td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesan yang masuk.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
    <script>
        const toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, false] }, { 'font': [] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image'],
            ['clean']
        ];
        if (document.getElementById('editor-container')) {
            const quill = new Quill('#editor-container', {
                modules: { toolbar: toolbarOptions },
                placeholder: 'Tulis isi artikel di sini...',
                theme: 'snow'
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