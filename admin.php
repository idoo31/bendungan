<?php
require_once 'koneksi.php';

session_start();
// "Penjaga" halaman admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Mengambil username dari session untuk ditampilkan
$admin_username = $_SESSION['admin_username'] ?? 'Admin';

// Tentukan aksi yang akan dilakukan: list (default), add, atau edit
$action = $_GET['action'] ?? 'list';
$artikel_data = null; 

// Jika aksinya adalah 'edit', ambil data artikel dari database
if ($action === 'edit' && isset($_GET['id'])) {
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
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    <header class="bg-white shadow-sm">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">
                        Login sebagai <span class="font-semibold text-gray-900"><?php echo htmlspecialchars($admin_username); ?></span>
                    </span>
                    <a href="logout.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm py-2 px-4 rounded-lg transition-colors">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="py-10">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            
            <?php if ($action === 'list'): ?>
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Daftar Artikel</h2>
                            <p class="text-sm text-gray-500 mt-1">Kelola semua artikel yang ada di website.</p>
                        </div>
                        <a href="admin.php?action=add" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
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
                                        <a href="admin.php?action=edit&id=<?php echo $row['id']; ?>" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                        <span class="text-gray-300">|</span>
                                        <a href="proses_artikel.php?action=delete&id=<?php echo $row['id']; ?>" class="font-semibold text-red-600 hover:text-red-800 transition-colors" onclick="return confirm('Anda yakin ingin menghapus artikel ini secara permanen?');">Hapus</a>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile;
                                else:
                                ?>
                                <tr><td colspan="5" class="p-8 text-center text-gray-500">Belum ada artikel. Silakan buat artikel pertama Anda.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($action === 'add' || ($action === 'edit' && isset($artikel_data))): ?>
                <form id="artikel-form" action="proses_artikel.php" method="POST" enctype="multipart/form-data">
                    <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                        <a href="admin.php" title="Kembali" class="text-gray-500 hover:bg-gray-100 rounded-full p-2 mr-3">&larr;</a>
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
            <?php else: ?>
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center">
                    <h2 class="text-xl font-bold text-red-600">Terjadi Kesalahan</h2>
                    <p class="text-gray-600 mt-2">Artikel tidak ditemukan atau aksi tidak valid.</p>
                    <a href="admin.php" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg">
                        Kembali ke Daftar
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>

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