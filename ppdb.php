<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PPDB SDN Bendungan 01</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f6fbff;
        }

        /* Hero Section Style */
        .ppdb-hero-bg {
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
            .ppdb-hero-bg {
                min-height: 180px;
            }
        }

        @media (min-width: 1024px) {
            .ppdb-hero-bg {
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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
    </style>
</head>

<body class="bg-[#f6fbff]">

    <!-- Navbar -->
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
                <a href="#" class="border-b-2 border-yellow-300 pb-1 text-yellow-300">PPDB</a>
                <a href="kontak.php" class="hover:text-yellow-300">Kontak</a>
            </div>

            <button id="mobile-menu-button" class="focus:outline-none md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu"
            class="absolute left-0 top-[80px] z-40 hidden w-full bg-[#223333] px-6 py-4 md:hidden">
            <a href="index.php" class="block border-b border-gray-600 py-2">Beranda</a>
            <a href="profil.php" class="block border-b border-gray-600 py-2">Profil</a>
            <a href="berita.php" class="block border-b border-gray-600 py-2">Berita & Kegiatan</a>
            <a href="#" class="block border-b border-gray-600 py-2 text-yellow-300">PPDB</a>
            <a href="kontak.php" class="block py-2">Kontak</a>
        </div>
    </nav>

    <div id="hero-measurer" class="ppdb-hero-bg">
        <div class="container mx-auto px-4 pl-0 sm:pl-16">
            <div class="max-w-xl bg-transparent p-0">
                <h1 class="mb-2 mt-8 text-3xl font-bold text-yellow-300">
                    PPDB SDN Bendungan 01
                </h1>
                <p class="mt-2 text-base text-white">
                    Informasi Penerimaan Peserta Didik Baru Tahun 2026
                </p>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-12 sm:px-6 md:px-16">
        <div class="mx-auto max-w-xl rounded-xl border border-[#e0f7fa] bg-white p-8 text-center shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-[#0077b6] md:text-2xl">
                Jadwal PPDB 2026 Belum Mulai
            </h2>
            <p class="mb-6 text-base text-gray-700">
                Mohon tunggu informasi selanjutnya terkait jadwal dan mekanisme PPDB
                SDN Bendungan 01 tahun 2026.
            </p>
            <div class="mb-4 rounded-lg border border-[#0077b6] bg-[#e0f7fa] p-4">
                <span class="font-semibold text-[#0077b6]">Informasi PPDB lainnya bisa di cek di</span>
                <a href="https://spmb.bogorkab.go.id" target="_blank"
                    class="ml-1 font-bold text-[#0077b6] underline">spmb.bogorkab.go.id</a>
            </div>
            <img src="asset/logo.png" alt="Logo SDN Bendungan 01"
                class="mx-auto mt-4 h-20 w-20 rounded-full border-4 border-[#0077b6] bg-white" />
        </div>
    </main>

    <footer id="footer" class="relative bg-[#e0f7fa] pb-0 pt-8 sm:pt-10">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="grid grid-cols-1 gap-4 pb-6 sm:grid-cols-2 sm:gap-8 md:grid-cols-4 sm:pb-8">
                <div>
                    <div class="mb-3 flex items-center">
                        <img src="asset/lambang.png" class="mr-2 h-8 w-8 text-[#0077b6]" />
                        <span class="text-lg font-bold text-[#023e8a]">SDN BENDUNGAN 01</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-700">
                        Menjadi sekolah dasar unggulan yang berkarakter, berprestasi, dan
                        berwawasan global.
                    </p>
                </div>

                <div>
                    <h3 class="mb-3 font-bold text-[#023e8a]">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="profil.php" class="hover:text-[#0077b6]">Profil</a></li>
                        <li><a href="berita.php" class="hover:text-[#0077b6]">Berita & Kegiatan</a></li>
                        <li><a href="ppdb.php" class="hover:text-[#0077b6]">PPDB</a></li>
                        <li><a href="kontak.php" class="hover:text-[#0077b6]">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-3 font-bold text-[#023e8a]">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                            </svg>
                            (0251) - 8324567
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-[#0077b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            s.dbendungan01@gmail.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                            </svg>
                            +62 877 7004 7554
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-3 font-bold text-[#023e8a]">Follow Us</h3>
                    <div class="mt-2 flex items-center gap-4">
                        <a href="https://www.instagram.com/bendungan_sd" target="_blank"
                            class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" />
                                <circle cx="12" cy="12" r="4" />
                            </svg>
                            Instagram
                        </a>
                        <a href="https://www.tiktok.com/@bendungan_sd?is_from_webapp=1&sender_device=pc" target="_blank"
                            class="flex items-center gap-1 text-gray-700 hover:text-[#0077b6]">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.1 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.1 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" />
                            </svg>
                            TikTok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-0 bg-[#023e8a] py-3 sm:py-4">
            <div
                class="container mx-auto flex items-center justify-center px-4 text-xs text-white sm:px-6 sm:text-sm md:px-16">
                <span>Hak cipta © 2025 SDN Bendungan 01. Seluruh hak cipta dilindungi
                    undang-undang.</span>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document
            .getElementById("mobile-menu-button")
            .addEventListener("click", function () {
                const menu = document.getElementById("mobile-menu");
                menu.classList.toggle("hidden");
            });

        // Navbar transparent & scroll effect
        const navbar = document.getElementById("navbar");
        const heroMeasurer = document.getElementById("hero-measurer");
        const heroHeight = heroMeasurer.offsetHeight;

        window.addEventListener("scroll", function () {
            if (window.scrollY > heroHeight - 60) {
                navbar.classList.add("navbar-scrolled");
            } else {
                navbar.classList.remove("navbar-scrolled");
            }
        });
    </script>
</body>

</html>