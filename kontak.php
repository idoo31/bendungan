<?php
// Cek jika ada parameter 'status' di URL untuk menampilkan notifikasi
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sukses') {
        echo "<script>alert('Pesan Anda telah berhasil dikirim. Terima kasih!');</script>";
    } elseif ($_GET['status'] == 'gagal') {
        echo "<script>alert('Maaf, terjadi kesalahan. Pesan Anda gagal dikirim.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDN Bendungan 01 - Kontak Kami</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f6fbff;
        }

        /* Hero Section Style */
        .kontak-hero-bg {
            background: linear-gradient(rgba(2, 62, 138, 0.85),
                    rgba(2, 62, 138, 0.85)),
                url("https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80");
            background-size: cover;
            background-position: center;
            min-height: 120px;
            display: flex;
            align-items: center;
        }

        @media (min-width: 640px) {
            .kontak-hero-bg {
                min-height: 180px;
            }
        }

        @media (min-width: 1024px) {
            .kontak-hero-bg {
                min-height: 220px;
            }
        }

        /* Navbar Style */
        .navbar {
            transition: all 0.3s ease;
            background: rgba(0, 119, 182, 0.15);
            border-bottom: 1px solid rgba(0, 119, 182, 0.08);
            color: #fff;
        }

        .navbar-scrolled {
            background: #fff !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
    </style>
</head>

<body class="bg-[#f6fbff]">

    <nav id="navbar" class="navbar fixed top-0 left-0 z-50 flex h-[80px] w-full items-center text-white">
        <div class="container mx-auto flex h-full items-center justify-between px-6">
            <div class="flex items-center space-x-3">
                <img src="asset/lambang.png" alt="Logo SDN Bendungan 01" class="h-12 w-12 p-1" />
                <div>
                    <span class="block text-lg font-bold tracking-wide text-yellow-300">SDN BENDUNGAN 01</span>
                    <span class="block text-xs text-white">Sekolah Dasar Negeri Unggulan</span>
                </div>
            </div>

            <div class="hidden space-x-8 text-base font-medium md:flex">
                <a href="index.php" class="hover:text-yellow-300">Beranda</a>
                <a href="profil.php" class="hover:text-yellow-300">Profil</a>
                <a href="berita.php" class="hover:text-yellow-300">Berita & Kegiatan</a>
                <a href="ppdb.php" class="hover:text-yellow-300">PPDB</a>
                <a href="kontak.php" class="text-yellow-300 border-b-2 border-yellow-300 pb-1">Kontak</a>
            </div>

            <button id="mobile-menu-button" class="focus:outline-none md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="absolute left-0 top-[80px] z-40 hidden w-full bg-[#223333] px-6 py-4 md:hidden">
            <a href="index.php" class="block py-2 border-b border-gray-600">Beranda</a>
            <a href="profil.php" class="block py-2 border-b border-gray-600">Profil</a>
            <a href="berita.php" class="block py-2 border-b border-gray-600">Berita & Kegiatan</a>
            <a href="ppdb.php" class="block py-2 border-b border-gray-600">PPDB</a>
            <a href="#" class="block py-2 text-yellow-300">Kontak</a>
        </div>
    </nav>
    <div id="header-section" class="kontak-hero-bg py-4">
        <div class="container mx-auto px-4 pl-0 sm:pl-16">
            <div class="max-w-xl bg-transparent p-0">
                <h1 class="text-3xl font-bold text-yellow-300 mt-8 mb-2">Hubungi Kami</h1>
                <p class="mt-2 text-white text-base">Kami siap membantu menjawab setiap pertanyaan Anda.</p>
            </div>
        </div>
    </div>
    <div class="bg-[#e0f7fa] py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="index.php" class="text-[#0077b6] hover:text-[#023e8a]">Beranda</a>
                <span class="text-[#0077b6]">/</span>
                <span class="text-[#0077b6] font-semibold">Kontak</span>
            </div>
        </div>
    </div>
    <main class="py-16">
        <div class="container mx-auto max-w-6xl px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <div>
                    <h2 class="text-2xl font-bold text-[#0077b6] mb-4">Informasi Kontak</h2>
                    <p class="text-gray-600 mb-8">
                        Jangan ragu untuk menghubungi kami melalui detail di bawah ini. Tim kami akan segera merespons Anda.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-[#e0f7fa] p-3 rounded-full">
                                <svg class="w-6 h-6 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Alamat</h3>
                                <p class="text-gray-600">Desa Bendungan, Kecamatan Ciawi, Kabupaten Bogor, Jawa Barat</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-[#e0f7fa] p-3 rounded-full">
                                <svg class="w-6 h-6 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Telepon</h3>
                                <p class="text-gray-600">(0251) - 8324567</p>
                                <p class="text-gray-600">+62 877 7004 7554</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-[#e0f7fa] p-3 rounded-full">
                                <svg class="w-6 h-6 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                                <p class="text-gray-600">s.dbendungan01@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-[#0077b6] mb-6">Kirim Pertanyaan Anda</h2>
                    <form action="proses_kontak.php" method="POST" class="space-y-5">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="kntk_nama" id="nama" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#0077b6] focus:border-transparent transition">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="kntk_email" id="email" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#0077b6] focus:border-transparent transition">
                        </div>
                        <div>
                            <label for="subjek" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <input type="text" name="kntk_subjek" id="subjek" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#0077b6] focus:border-transparent transition">
                        </div>
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan Anda</label>
                            <textarea name="kntk_pesan" id="pesan" rows="5" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#0077b6] focus:border-transparent transition"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-[#0077b6] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#023e8a] transition-colors duration-300 shadow-md">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <section class="pb-16">
        <div class="container mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-[#0077b6] text-center mb-8">Lokasi Kami</h2>
            <div class="overflow-hidden rounded-lg shadow-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.037380537443!2d106.8485253153495!3d-6.642131995195007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c894a4574c81%3A0x8543564033b9347!2sSDN%20Bendungan%201!5e0!3m2!1sen!2sid!4v1663333333333!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
    <footer id="footer" class="bg-[#e0f7fa] pt-8 sm:pt-10 pb-0 relative">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 pb-6 sm:pb-8">
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
                            <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" /></svg>
                            (0251) - 8324567
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            s.dbendungan01@gmail.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" /></svg>
                            +62 877 7004 7554
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-[#023e8a] mb-3">Follow Us</h3>
                    <div class="flex items-center gap-4 mt-2">
                        <a href="https://www.instagram.com/bendungan_sd" target="_blank" class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" /><circle cx="12" cy="12" r="4" /></svg>
                            Instagram
                        </a>
                        <a href="https://www.tiktok.com/@bendungan_sd?is_from_webapp=1&sender_device=pc" target="_blank" class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.1 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.1 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" /></svg>
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

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        const headerSection = document.getElementById('header-section');
        const headerHeight = headerSection.offsetHeight;

        window.addEventListener('scroll', function() {
            if (window.scrollY > headerHeight - 60) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
    </body>

</html>