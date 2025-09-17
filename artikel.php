<?php
require_once 'koneksi.php';

// 1. Ambil 'slug' dari URL
if (!isset($_GET['slug'])) {
    http_response_code(400); // Bad Request
    die('<h1>Error 400: Bad Request</h1><p>Parameter "slug" artikel tidak ditemukan di URL.</p><a href="berita.php">Kembali ke daftar berita</a>');
}
$slug_artikel = $_GET['slug'];

// 2. Ambil data artikel
$sql = "SELECT * FROM artikel WHERE slug = ? AND status = 'diterbitkan' LIMIT 1";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $slug_artikel);
$stmt->execute();
$result = $stmt->get_result();
$artikel = $result->fetch_assoc();

// 3. Jika artikel tidak ditemukan, tampilkan 404
if (!$artikel) {
    http_response_code(404);
    die('<h1>404 - Halaman Tidak Ditemukan</h1><p>Maaf, artikel yang Anda cari tidak ada atau mungkin telah dihapus.</p><a href="berita.php">Kembali ke daftar berita</a>');
}

// 4. Format tanggal
$timestamp = strtotime($artikel['waktu_terbit']);
$bulan_indonesia = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 
    6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 
    11 => 'November', 12 => 'Desember'
];
$hari = date('d', $timestamp);
$bulan = $bulan_indonesia[(int)date('n', $timestamp)];
$tahun = date('Y', $timestamp);
$tanggal_terbit_formatted = "$hari $bulan $tahun";

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artikel['judul']); ?> - SDN Bendungan 01</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6fbff;
        }
        /* Styling untuk konten artikel yang rapi */
        .content-body {
            font-family: 'Lora', serif;
            font-size: 1.125rem; /* 18px */
            line-height: 1.8;
            color: #334155; /* slate-700 */
        }
        .content-body h1, .content-body h2, .content-body h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1e293b; /* slate-800 */
        }
        .content-body h2 { font-size: 1.875rem; }
        .content-body h3 { font-size: 1.5rem; }
        .content-body p { margin-bottom: 1.5rem; }
        .content-body a { color: #0077b6; text-decoration: underline; }
        .content-body strong, .content-body b { font-weight: 700; color: #1e293b; }
        .content-body ul, .content-body ol { margin-left: 1.5rem; margin-bottom: 1.5rem; }
        .content-body ul { list-style-type: disc; }
        .content-body ol { list-style-type: decimal; }
        .content-body li { margin-bottom: 0.5rem; }
        .content-body blockquote {
            border-left: 4px solid #0077b6;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #475569; /* slate-600 */
        }
    </style>
</head>

<body class="bg-[#f6fbff]">

    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50 h-[80px] flex items-center">
        <div class="container mx-auto px-6">
            <a href="index.html" class="flex items-center space-x-3">
                <img src="asset/logo.png" alt="Logo SDN Bendungan 01" class="h-16 w-16 p-1">
                <div>
                    <span class="block text-lg font-bold text-[#0077b6]">SDN BENDUNGAN 01</span>
                    <span class="block text-xs text-gray-700">Sekolah Dasar Negeri Unggulan</span>
                </div>
            </a>
        </div>
    </nav>
    
    <main class="pt-28">
        <div class="container mx-auto max-w-4xl py-8 md:py-12 px-4">
            
            <div class="mb-6">
                <a href="berita.php" class="text-[#0077b6] hover:text-[#023e8a] font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke semua berita
                </a>
            </div>

            <article class="bg-white p-6 md:p-10 rounded-xl shadow-lg border border-gray-200">
                <header class="mb-8">
                    <h1 class="font-sans text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                        <?php echo htmlspecialchars($artikel['judul']); ?>
                    </h1>
                    <div class="flex items-center space-x-4 text-slate-500 text-sm">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" /></svg>
                            <span class="font-semibold text-slate-600"><?php echo htmlspecialchars($artikel['penulis']); ?></span>
                        </div>
                        <span class="text-slate-300">|</span>
                        <div class="flex items-center space-x-2">
                             <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zM4.5 8.5v6.75c0 .138.112.25.25.25h10.5a.25.25 0 00.25-.25V8.5h-11z" clip-rule="evenodd" /></svg>
                             <span><?php echo $tanggal_terbit_formatted; ?></span>
                        </div>
                    </div>
                </header>

                <figure class="mb-8">
                    <img src="<?php echo htmlspecialchars($artikel['url_gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($artikel['keterangan_gambar']); ?>"
                         class="w-full h-auto object-cover rounded-lg shadow-md border">
                    <figcaption class="text-center text-sm text-slate-500 mt-3 italic">
                        <?php echo htmlspecialchars($artikel['keterangan_gambar']); ?>
                    </figcaption>
                </figure>
                
                <div class="content-body">
                    <?php echo $artikel['isi_konten']; ?>
                </div>
            </article>
        </div>
    </main>

    <footer class="bg-[#e0f7fa] pt-8 sm:pt-10 pb-0 relative">
      <div class="container mx-auto px-4 sm:px-6 md:px-16">
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 pb-6 sm:pb-8"
        >
          <div>
            <div class="flex items-center mb-3">
              <img src="asset/logo.png" class="h-8 w-8 text-[#0077b6] mr-2" />
              <span class="font-bold text-lg text-[#023e8a]"
                >SDN BENDUNGAN 01</span
              >
            </div>
            <p class="text-gray-700 mt-2 text-sm">
              Menjadi sekolah dasar unggulan yang berkarakter, berprestasi, dan
              berwawasan global.
            </p>
          </div>
          <div>
            <h3 class="font-bold text-[#023e8a] mb-3">Tautan Cepat</h3>
            <ul class="space-y-2 text-sm">
              <li>
                <a href="profil.php" class="hover:text-[#0077b6]">Profil</a>
              </li>
              <li>
                <a href="berita.php" class="hover:text-[#0077b6]">Berita & Kegiatan</a>
              </li>
              <li><a href="ppdb.php" class="hover:text-[#0077b6]">PPDB</a></li>
              <li><a href="kontak.php" class="hover:text-[#0077b6]">Kontak</a></li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-[#023e8a] mb-3">Hubungi Kami</h3>
            <ul class="space-y-2 text-sm">
              <li class="flex items-center gap-2">
                <svg
                  class="w-5 h-5 text-[#0077b6]"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z"
                  />
                </svg>
                (0251) - 8324567
              </li>
              <li class="flex items-center gap-2">
                <svg
                  class="w-5 h-5 text-[#0077b6]"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <path d="M16 12v1a4 4 0 01-8 0v-1" />
                  <path d="M12 16v2m0 0h-2m2 0h2" />
                </svg>
                info@sdnbendungan01.sch.id
              </li>
              <li class="flex items-center gap-2">
                <svg
                  class="w-5 h-5 text-[#0077b6]"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z"
                  />
                </svg>
                0812 3456 7890
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-bold text-[#023e8a] mb-3">Follow Us</h3>
            <div class="flex items-center gap-4 mt-2">
              <a
                href="https://www.instagram.com/bendungan_sd"
                target="_blank"
                class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]"
              >
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <rect x="2" y="2" width="20" height="20" rx="5" />
                  <circle cx="12" cy="12" r="4" />
                </svg>
                Instagram
              </a>
              <a
                href="#"
                class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]"
              >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <rect
                    x="2"
                    y="2"
                    width="20"
                    height="20"
                    rx="5"
                    fill="#0077b6"
                  />
                  <path
                    d="M7 8h3v8H7V8zm4 0h3v2h-3V8zm0 3h3v5h-3v-5z"
                    fill="#fff"
                  />
                </svg>
                LinkedIn
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-[#023e8a] py-3 sm:py-4 mt-0">
        <div
          class="container mx-auto px-4 sm:px-6 md:px-16 flex items-center justify-center text-white text-xs sm:text-sm"
        >
          <span
            >Hak cipta © 2025 SDN Bendungan 01. Seluruh hak cipta dilindungi
            undang-undang.</span
          >
        </div>
      </div>
    </footer>

    <script>
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });
        backToTopButton.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>
</body>
</html>
<?php
$stmt->close();
$koneksi->close();
?>