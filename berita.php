<?php
require_once 'app/koneksi.php';

// Ambil semua artikel yang statusnya 'diterbitkan', urutkan dari yang terbaru
$sql = "SELECT judul, slug, penulis, waktu_terbit, LEFT(isi_konten, 200) as cuplikan, url_gambar, keterangan_gambar 
        FROM artikel 
        WHERE status = 'diterbitkan' 
        ORDER BY waktu_terbit DESC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDN Bendungan 01 - Berita dan Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6fbff;
        }
        .header-bg {
            background-color: #023e8a;
        }
        .primary {
            color: #0077b6;
        }
        .primary-bg {
            background-color: #0077b6;
        }
        .soft-bg {
            background-color: #e0f7fa;
        }
        .border-primary {
            border-color: #0077b6;
        }
        .shadow-primary {
            box-shadow: 0 4px 12px 0 rgba(0,119,182,0.08);
        }
        /* Sticky Navbar Styles (sama seperti profil.html) */
        .navbar {
            transition: all 0.3s ease;
            background: rgba(0,119,182,0.15);
            border-bottom: 1px solid rgba(0,119,182,0.08);
            color: #fff;
        }
        .navbar-scrolled {
            background: #fff !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            border-bottom: 1px solid #e5e7eb;
            color: #222;
        }
       .navbar-scrolled .container span {
            color: #0077b6 !important;
        }
        .navbar-scrolled .container a,
        .navbar-scrolled .container svg {
            color: #222 !important;
            fill: #222 !important;
        }
        .navbar-scrolled .container a.text-yellow-300 {
            color: #0077b6 !important;
            border-color: #0077b6 !important;
        }
        .navbar-scrolled .container a:hover {
            color: #0077b6 !important;
        }
        .navbar-scrolled .container .text-white {
            color: #222 !important;
        }
        .navbar-scrolled .container .bg-white {
            background-color: #fff !important;
        }
        /* Berita Hero Styles */
        .profil-hero-bg {
            background: linear-gradient(rgba(2,62,138,0.85), rgba(2,62,138,0.85)),
                url('https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            min-height: 120px;
            display: flex;
            align-items: center;
        }
        @media (min-width: 640px) {
            .profil-hero-bg { min-height: 180px; }
        }
        @media (min-width: 1024px) {
            .profil-hero-bg { min-height: 220px; }
        }
    </style>
</head>
<body class="bg-[#f6fbff]">

     <!-- Navbar -->
         <nav id="navbar" class="navbar fixed top-0 left-0 w-full text-white z-50 h-[80px] flex items-center">
        <div class="container mx-auto px-6 flex justify-between items-center h-full">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="asset/lambang.png" alt="Logo SDN Bendungan 01" class="h-12 w-12 p-1">
                <div>
                    <span class="block text-lg font-bold text-yellow-300 tracking-wide">SDN BENDUNGAN 01</span>
                    <span class="block text-xs text-white">Sekolah Dasar Negeri Unggulan</span>
                </div>
            </div>
            <!-- Menu -->
            <div class="hidden md:flex space-x-8 font-medium text-base">
                <a href="index.php" class="hover:text-yellow-300">Beranda</a>
                <a href="profil.php" class="hover:text-yellow-300">Profil</a>
                <a href="#" class="text-yellow-300 border-b-2 border-yellow-300 pb-1">Berita & Kegiatan</a>
                <a href="ppdb.php" class="hover:text-yellow-300">PPDB</a>
                <a href="kontak.php" class="hover:text-yellow-300">Kontak</a>
            </div>
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-[#223333] px-6 py-4 absolute top-[80px] left-0 w-full z-40">
            <a href="index.php" class="block py-2 text-yellow-300 border-b border-gray-600">Beranda</a>
            <a href="profil.php" class="block py-2 border-b border-gray-600">Profil</a>
            <a href="#" class="block py-2 border-b border-gray-600">Berita & Kegiatan</a>
            <a href="ppdb.php" class="block py-2 border-b border-gray-600">PPDB</a>
            <a href="kontak.php" class="block py-2">Kontak</a>
        </div>
    </nav>

    <div id="header-section" class="profil-hero-bg py-4">
        <div class="container mx-auto px-4 pl-0 sm:pl-16">
            <div class="max-w-xl bg-transparent p-0">
                <h1 class="text-3xl font-bold text-yellow-300 mt-8 mb-2 hidden md:block">Berita & Informasi Kegiatan</h1>
                <p class="mt-2 text-white text-base hidden md:block">Ikuti terus informasi terbaru dari SDN Bendungan 01.</p>
                <!-- Mobile only: judul saja, center -->
                <h1 class="text-2xl font-bold text-yellow-300 mt-8 mb-2 md:hidden text-center">Berita & Informasi Kegiatan</h1>
            </div>
        </div>
    </div>

    <div class="bg-[#e0f7fa] py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="index.php" class="text-[#0077b6] hover:text-[#023e8a]">Beranda</a>
                <span class="text-[#0077b6]">/</span>
                <span class="text-[#0077b6] font-semibold">Berita & Kegiatan</span>
            </div>
        </div>
    </div>

    <main>
        <div class="container mx-auto max-w-6xl py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($artikel = $result->fetch_assoc()): ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col max-w-xs mx-auto md:max-w-none md:mx-0">
                            <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="block">
                                <img src="<?php echo htmlspecialchars($artikel['url_gambar']); ?>" alt="<?php echo htmlspecialchars($artikel['keterangan_gambar']); ?>" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <h2 class="text-lg font-bold mb-1 flex-grow line-clamp-2" style="min-height: 2.75rem;">
                                    <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="text-slate-800 hover:text-blue-700">
                                        <?php echo htmlspecialchars($artikel['judul']); ?>
                                    </a>
                                </h2>
                                <p class="text-gray-500 text-xs mb-3">
                                    Oleh <strong><?php echo htmlspecialchars($artikel['penulis']); ?></strong> &bull; <?php echo date('d F Y', strtotime($artikel['waktu_terbit'])); ?>
                                </p>
                                          <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-3 hidden md:block">
                                              <?php echo strip_tags($artikel['cuplikan']); ?>...
                                          </p>
                                <div class="mt-auto">
                                    <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center col-span-3 text-gray-500 text-lg py-16">
                        Belum ada artikel yang diterbitkan saat ini.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- footer -->
<footer id="footer" class="bg-[#e0f7fa] pt-8 sm:pt-10 pb-0 relative">
    <div class="container mx-auto px-4 sm:px-6 md:px-16">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 pb-6 sm:pb-8"
        >
            <div>
                <div class="flex items-center mb-3">
                    <img src="asset/lambang.png" class="h-8 w-8 text-[#0077b6] mr-2" />
                    <span class="font-bold text-lg text-[#023e8a]">SDN BENDUNGAN 01</span>
                </div>
                <p class="text-gray-700 mt-2 text-sm">
                    Menjadi sekolah dasar unggulan yang berkarakter, berprestasi, dan berwawasan global.
                </p>
            </div>
            <div>
                <h3 class="font-bold text-[#023e8a] mb-3">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="profil.php" class="hover:text-[#0077b6]">Profil</a></li>
                    <li><a href="berita.php" class="hover:text-[#0077b6]">Berita & Kegiatan</a></li>
                    <li><a href="ppdb.php" class="hover:text-[#0077b6]">PPDB</a></li>
                    <li><a href="kontak.php" class="hover:text-[#0077b6]">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-[#023e8a] mb-3">Hubungi Kami</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                        </svg>
                        (0251) - 8324567
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        s.dbendungan01@gmail.com
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                             <path d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                        </svg>
                        +62 877 7004 7554
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-[#023e8a] mb-3">Follow Us</h3>
                <div class="flex items-center gap-4 mt-2">
                    <a href="https://www.instagram.com/bendungan_sd" target="_blank" class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                        Instagram
                    </a>
                    <a href="https://www.tiktok.com/@bendungan_sd?is_from_webapp=1&sender_device=pc" target="_blank" class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.1 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.10 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" />
                        </svg>
                        TikTok
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-[#023e8a] py-3 sm:py-4 mt-0">
        <div class="container mx-auto px-4 sm:px-6 md:px-16 flex items-center justify-center text-white text-xs sm:text-sm">
            <span>Hak cipta © 2025 SDN Bendungan 01. Seluruh hak cipta dilindungi undang-undang.</span>
        </div>
    </div>
</footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Navbar transparan & scroll effect - DIPERBAIKI
        const navbar = document.getElementById('navbar');
        const headerSection = document.getElementById('header-section');
        
        // Tunggu halaman selesai dimuat sepenuhnya
        window.addEventListener('DOMContentLoaded', function() {
            const headerHeight = headerSection.offsetHeight;
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > headerHeight - 60) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
            
            // Trigger scroll sekali saat halaman dimuat untuk memastikan state yang benar
            window.dispatchEvent(new Event('scroll'));
        });

        // Tombol balik ke atas
        document.getElementById('backToTop').onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
</body>
</html>
<?php
$koneksi->close();
?>