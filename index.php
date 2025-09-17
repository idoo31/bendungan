<?php
require_once 'koneksi.php';

// Ambil 6 artikel terbaru yang statusnya 'diterbitkan'
$sql = "SELECT judul, slug, penulis, waktu_terbit, LEFT(isi_konten, 200) as cuplikan, url_gambar, keterangan_gambar 
        FROM artikel 
        WHERE status = 'diterbitkan' 
        ORDER BY waktu_terbit DESC
        LIMIT 6";
$result_berita = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDN Bendungan 01 - Profil Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6fbff; /* biru muda */
        }
        .hero-background {
            background: linear-gradient(rgba(2,62,138,0.85), rgba(2,62,138,0.85)),
                url('https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            min-height: 520px;
            display: flex;
            align-items: center;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            /* Glass effect for hero content */
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .feature-icon {
            background-color: #e0f7fa; /* biru muda */
            color: #0077b6;
        }
        /* Sticky Navbar Styles */
        .navbar {
            transition: all 0.3s ease;
            background: rgba(0,119,182,0.15);
            border-bottom: 1px solid rgba(0,119,182,0.08);
            color: #fff;
            /* Hapus shadow */
            /* box-shadow: none; */
        }
        .navbar-scrolled {
            background: #fff !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            border-bottom: 1px solid #e5e7eb;
            color: #222;
        }
        /* Navbar link color change on scroll */
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
        .hexagon {
            width: 120px;
            height: 104px;
            background: transparent;
            position: relative;
            clip-path: polygon(
                50% 0%, 
                93% 25%, 
                93% 75%, 
                50% 100%, 
                7% 75%, 
                7% 25%
            );
            overflow: hidden;
        }
        .hexagon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .hexagon-seragam {
            width: 160px;
            height: 140px;
            background: transparent;
            position: relative;
            clip-path: polygon(
                50% 0%, 
                93% 25%, 
                93% 75%, 
                50% 100%, 
                7% 75%, 
                7% 25%
            );
            overflow: hidden;
            box-sizing: border-box;
        }
        .hexagon-seragam img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .seragam-circle {
            width: 140px;
            height: 140px;
            border: 6px solid #e9ff27ff;
            border-radius: 50%;
            overflow: hidden;
            box-sizing: border-box;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .seragam-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            /* Hero Section */
            .hero-background {
                min-height: 400px;
                padding: 20px 0;
            }
            
            /* Ekstrakurikuler Section - Menjaga 3 kolom dengan ukuran mengecil */
            .ekstra-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.5rem;
            }
            
            .ekstra-item {
                padding: 0.75rem;
                font-size: 0.8rem;
            }
            
            .ekstra-item h3 {
                font-size: 0.9rem;
            }
            
            .ekstra-icon {
                width: 2rem;
                height: 2rem;
                margin-right: 0.5rem;
            }
            
            .ekstra-icon svg {
                width: 1.25rem;
                height: 1.25rem;
            }
            
            /* Fasilitas Section - Menjaga 3 kolom dengan ukuran mengecil */
            .fasilitas-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.5rem;
            }
            
            .fasilitas-card {
                max-width: none;
                margin: 0;
            }
            
            .fasilitas-card h3 {
                font-size: 0.8rem;
            }
            
            .fasilitas-card p {
                font-size: 0.7rem;
            }
            
            /* Seragam Section */
            .seragam-container {
                overflow-x: auto;
                padding-bottom: 1rem;
            }
            
            .seraman-wrapper {
                display: flex;
                width: max-content;
                gap: 1rem;
            }
            
            .seragam-item {
                flex: 0 0 auto;
                width: 120px;
            }
            
            .seragam-circle {
                width: 100px;
                height: 100px;
            }
            
            /* General adjustments */
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            /* Statistik Section */
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            /* Untuk layar sangat kecil, ubah menjadi 2 kolom */
            .ekstra-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            
            /* MODIFIKASI DI SINI: Mengubah grid fasilitas menjadi 2 kolom */
            .fasilitas-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            /* Untuk layar extra kecil, ubah menjadi 1 kolom */
            .ekstra-grid {
                grid-template-columns: 1fr;
            }
            
            .fasilitas-grid {
                grid-template-columns: 1fr;
            }
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
                <a href="#" class="text-yellow-300 border-b-2 border-yellow-300 pb-1">Beranda</a>
                <a href="profil.php" class="hover:text-yellow-300">Profil</a>
                <a href="berita.php" class="hover:text-yellow-300">Berita & Kegiatan</a>
                <a href="ppdb.php" class="hover:text-yellow-300">PPDB</a>
                <a href="#kontak.php" class="hover:text-yellow-300">Kontak</a>
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
            <a href="#" class="block py-2 text-yellow-300 border-b border-gray-600">Beranda</a>
            <a href="profil.php" class="block py-2 border-b border-gray-600">Profil</a>
            <a href="berita.php" class="block py-2 border-b border-gray-600">Berita & Kegiatan</a>
            <a href="ppdb.php" class="block py-2 border-b border-gray-600">PPDB</a>
            <a href="#kontak.php" class="block py-2">Kontak</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-background">
        <div class="container mx-auto px-4 sm:px-6 flex flex-col md:flex-row items-center justify-between w-full">
            <!-- Teks Hero -->
            <div class="flex-1 max-w-xl md:pr-10 pl-4 sm:pl-10">
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4 sm:mb-6 leading-tight">
                    Berprestasi, Semangat,<br>Aktif, Taat, Unggul.
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-white mb-6 sm:mb-8">
                    SDN Bendungan 01 Mewujudkan Lulusan Unggul Berkarakter dan Berprestasi dalam Persaingan Global.
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4">
                    <a href="profil.html" class="bg-yellow-300 text-[#0077b6] font-semibold px-5 sm:px-7 py-2 sm:py-3 rounded-lg shadow hover:bg-yellow-400 transition text-base sm:text-lg w-full sm:w-auto text-center">
                        Profil Sekolah
                    </a>
                </div>
            </div>
            <!-- Foto Hero -->
            <div class="flex-1 flex justify-end items-center mt-6 sm:mt-10 md:mt-0 pr-4 sm:pr-10">
                <div class="relative">
                    <img src="asset/belajar.png"
                        alt="Siswa SDN Bendungan 01"
                        class="rounded-xl shadow-lg w-[220px] sm:w-[370px] h-[140px] sm:h-[260px] object-cover border-4 border-yellow-300">
                    <div class="absolute bottom-0 left-0 w-full h-8 sm:h-12 bg-yellow-300 opacity-80 rounded-b-xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Kata Sambutan Kepala Sekolah -->
    <div class="py-12 bg-[#e0f7fa]">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row items-center md:items-stretch gap-6 sm:gap-8 md:gap-12 max-w-4xl mx-auto bg-white rounded-xl p-4 sm:p-6 md:p-10 shadow-lg border border-[#b3e0f2]">
                <!-- Teks Sambutan -->
                <div class="flex-1 flex flex-col justify-center">
                    <h2 class="text-base md:text-lg font-semibold text-black mb-2">Sambutan Kepala Sekolah</h2>
                    <h3 class="text-2xl md:text-4xl font-bold text-[#0077b6] mb-4">Kiagus Dadan Ramdhan, S.Pd</h3>
                    <p class="text-black text-sm md:text-base mb-6">
                        Selamat datang di SDN Bendungan 01. Kami percaya bahwa pendidikan adalah kunci masa depan anak-anak. Bersama, mari kita ciptakan lingkungan belajar yang menyenangkan dan penuh semangat untuk membangun generasi yang berkarakter dan berprestasi.
                    </p>
                    <a href="#" class="inline-block bg-[#0077b6] text-yellow-300 font-semibold px-6 py-3 rounded-lg shadow hover:bg-yellow-300 hover:text-[#0077b6] transition text-base">
                        Sambutan Kepala Sekolah &rarr;
                    </a>
                </div>
                <!-- Foto Kepala Sekolah -->
                <div class="flex-1 flex justify-center items-center">
                    <div class="bg-white p-2 rounded-lg shadow-lg border-4 border-white">
                        <img src="asset/kepsek.png" alt="Kepala Sekolah" class="w-[260px] h-[320px] object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-white py-12 sm:py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-xl sm:text-3xl font-bold text-center mb-3 sm:mb-4 text-[#0077b6]">Keunggulan SDN Bendungan 01</h2>
            <div class="mb-6 sm:mb-8 h-[2px] w-[60px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
            <div class="pt-6 sm:pt-10 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-10">
                <!-- Card 1 -->
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-[#e0f7fa] rounded-xl flex items-center justify-center mb-6" style="width:72px;height:72px;">
                        <!-- Icon Akreditasi -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl mb-2 text-black">Akreditasi Baik</h3>
                    <p class="text-black mb-4">
                        Sekolah dengan akreditasi Baik dari BAN-S/M, menjamin mutu pendidikan terbaik.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-[#e0f7fa] rounded-xl flex items-center justify-center mb-6" style="width:72px;height:72px;">
                        <!-- Icon Kurikulum -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl mb-2 text-black">Kurikulum Unggulan</h3>
                    <p class="text-black mb-4">
                        Kurikulum Merdeka dengan penguatan karakter dan pembelajaran inovatif.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-[#e0f7fa] rounded-xl flex items-center justify-center mb-6" style="width:72px;height:72px;">
                        <!-- Icon Guru -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl mb-2 text-black">Guru Berkompeten</h3>
                    <p class="text-black mb-4">
                        Guru bersertifikasi dan berpengalaman, siap membimbing siswa menuju prestasi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Seragam Sekolah -->
    <div class="bg-[#e0f7fa] py-12">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-[#0077b6] mb-4">Jadwal Seragam Sekolah</h2>
                <div class="mb-4 sm:mb-8 h-[2px] w-[60px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-sm md:text-base text-black mb-6 max-w-2xl mx-auto">
                    Berikut jadwal penggunaan seragam siswa SDN Bendungan 01 setiap hari sekolah.
                </p>
            </div>
            <div class="seragam-container">
                <div class="seraman-wrapper flex flex-row flex-wrap justify-center gap-8">
                    <!-- Senin -->
                    <div class="seragam-item flex flex-col items-center w-48">
                        <div class="seragam-circle mb-4">
                            <img src="asset/putihmerah.jpg" alt="Seragam Senin" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-xl mb-1">Senin</div>
                        <div class="text-base text-black text-center">Merah Putih<br>Topi, dasi, atribut lengkap</div>
                    </div>
                    <!-- Selasa -->
                    <div class="seragam-item flex flex-col items-center w-48">
                        <div class="seragam-circle mb-4">
                            <img src="asset/batik.jpg" alt="Seragam Selasa" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-xl mb-1">Selasa</div>
                        <div class="text-base text-black text-center">Batik<br>Batik Sekolah</div>
                    </div>
                    <!-- Rabu -->
                    <div class="seragam-item flex flex-col items-center w-48">
                        <div class="seragam-circle mb-4">
                            <img src="asset/pramuka.jpg" alt="Seragam Rabu" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-xl mb-1">Rabu</div>
                        <div class="text-base text-black text-center">Pramuka<br>Atribut lengkap</div>
                    </div>
                    <!-- Kamis -->
                    <div class="seragam-item flex flex-col items-center w-48">
                        <div class="seragam-circle mb-4">
                            <img src="asset/bajubudaya.jpg" alt="Seragam Kamis" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-xl mb-1">Kamis</div>
                        <div class="text-base text-black text-center">Batik<br>Batik sekolah</div>
                    </div>
                    <!-- Jumat -->
                    <div class="seragam-item flex flex-col items-center w-48">
                        <div class="seragam-circle mb-4">
                            <img src="asset/putihhitam.jpg" alt="Seragam Jumat" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-xl mb-1">Jumat</div>
                        <div class="mb-8 text-base text-black text-center">Baju Muslim<br>Kemeja Putih & Celana Hitam</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ekstrakurikuler Section -->
    <div class="bg-white py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0077b6] mb-2">Ekstrakurikuler</h2>
                <div class="mb-6 h-[2px] w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">
                    SDN Bendungan 01 menyediakan berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa di berbagai bidang.
                </p>
            </div>
            
            <div class="ekstra-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Paskibra -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Paskibra</h3>
                    </div>
                    <p class="text-gray-700">Melatih kedisiplinan, patriotisme, dan keterampilan baris-berbaris untuk upacara bendera.</p>
                </div>
                
                <!-- Karate -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Karate</h3>
                    </div>
                    <p class="text-gray-700">Mengembangkan kemampuan bela diri, disiplin, fokus, dan kesehatan fisik siswa.</p>
                </div>
                
                <!-- Futsal -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Futsal</h3>
                    </div>
                    <p class="text-gray-700">Meningkatkan keterampilan sepak bola dalam ruangan, kerjasama tim, dan kebugaran jasmani.</p>
                </div>
                
                <!-- Drumband -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Drumband</h3>
                    </div>
                    <p class="text-gray-700">Mengembangkan bakat musik, sense of rhythm, dan kerjasama dalam penampilan kelompok.</p>
                </div>
                
                <!-- Pramuka -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 7h7l-5.5 4.5L16 21l-4-3-4 3 1.5-7.5L3 9h7z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Pramuka</h3>
                    </div>
                    <p class="text-gray-700">Membentuk karakter mandiri, kreatif, peduli lingkungan, dan memiliki jiwa kepemimpinan.</p>
                </div>
                
                <!-- Degung -->
                <div class="ekstra-item bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="ekstra-icon bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Degung</h3>
                    </div>
                    <p class="text-gray-700">Melestarikan seni musik tradisional Sunda dan mengembangkan apresiasi budaya daerah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistik SDN Bendungan 01 -->
     <div class="bg-white py-12 sm:py-20">
    <div class="container mx-auto px-4 sm:px-6 md:px-16">
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 sm:gap-6 md:gap-8" data-statistik>

            <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center py-6 sm:py-8 px-3 sm:px-4">
                <div class="mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div id="stat-siswa" class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2" data-count="386">0</div>
                <div class="text-xs sm:text-base text-white font-medium text-center">Siswa<br>Aktif</div>
            </div>

            <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center py-6 sm:py-8 px-3 sm:px-4">
                <div class="mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div id="stat-guru" class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2" data-count="22">0</div>
                <div class="text-xs sm:text-base text-white font-medium text-center">Guru</div>
            </div>

            <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center py-6 sm:py-8 px-3 sm:px-4">
                <div class="mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div id="stat-tendik" class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2" data-count="5">0</div>
                <div class="text-xs sm:text-base text-white font-medium text-center">Tenaga<br>Pendidik</div>
            </div>

            <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center py-6 sm:py-8 px-3 sm:px-4">
                <div class="mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div id="stat-kelas" class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2" data-count="12">0</div>
                <div class="text-xs sm:text-base text-white font-medium text-center">Kelas</div>
            </div>

            <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center py-6 sm:py-8 px-3 sm:px-4">
                <div class="mb-3 sm:mb-4">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
                <div id="stat-alumni" class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2" data-count="2500">0</div>
                <div class="text-xs sm:text-base text-white font-medium text-center">Alumni</div>
            </div>
            
        </div>
    </div>
</div>

       <!-- School Facilities Section -->
    <div class="bg-[#e0f7fa] py-12 sm:py-12">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="text-center mb-6 sm:mb-8">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold pb-2 text-[#0077b6]">Fasilitas Sekolah</h2>
                <div class="mb-6 sm:mb-8 h-[2px] w-[60px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 mt-2 sm:mt-4 max-w-2xl mx-auto">
                    SDN Bendungan 01 dilengkapi dengan fasilitas modern yang mendukung proses belajar mengajar dan pengembangan bakat siswa.
                </p>
            </div>
            <div class="fasilitas-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8 justify-center">
                <!-- Perpustakaan -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Perpustakaan" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Perpustakaan</h3>
                        <p class="text-xs text-gray-600">Ruang baca nyaman dengan koleksi 5.000+ buku dan area riset.</p>
                    </div>
                </div>
                
                <!-- Lapangan Indoor -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lapangan Indoor" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Lapangan Indoor</h3>
                        <p class="text-xs text-gray-600">Lapangan serbaguna dalam ruangan untuk berbagai kegiatan olahraga.</p>
                    </div>
                </div>
                
                <!-- Lapangan Outdoor -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lapangan Outdoor" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Lapangan Outdoor</h3>
                        <p class="text-xs text-gray-600">Lapangan luas untuk sepak bola, atletik, dan kegiatan luar ruangan.</p>
                    </div>
                </div>
                
                <!-- Lab Komputer -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lab Komputer" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Lab Komputer</h3>
                        <p class="text-xs text-gray-600">30 unit komputer dengan spesifikasi terkini untuk pembelajaran TI.</p>
                    </div>
                </div>
                
                <!-- Ruang Alat Musik Tradisional -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1605721911519-3dfeb3be25e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Ruang Alat Musik Tradisional" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Ruang Alat Musik Tradisional</h3>
                        <p class="text-xs text-gray-600">Koleksi alat musik tradisional untuk pembelajaran seni budaya.</p>
                    </div>
                </div>
                
                <!-- Musholla -->
                <div class="fasilitas-card bg-white rounded-lg overflow-hidden shadow-md transition-transform hover:scale-[1.03] border border-gray-200 max-w-xs mx-auto">
                    <div class="h-32 overflow-hidden">
                        <img src="https://i.pinimg.com/736x/99/f6/c5/99f6c533388f9c49fe857f13dd25f822.jpg" alt="Musholla" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-[#0077b6] mb-1">Musholla</h3>
                        <p class="text-xs text-gray-600">Tempat ibadah yang nyaman dan representatif untuk seluruh warga sekolah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white py-12 sm:py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800">Berita & Kegiatan Terbaru</h2>
                <p class="text-slate-500 mt-2">Ikuti informasi dan kegiatan terkini dari sekolah kami.</p>
            </div>

            <div class="flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if ($result_berita && $result_berita->num_rows > 0): ?>
                        <?php while($artikel = $result_berita->fetch_assoc()): ?>
                            <div class="bg-[#f6fbff] rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col max-w-xs w-full mx-auto border border-[#b3e0f2]">
                                <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="block h-40 overflow-hidden">
                                    <img src="<?php echo htmlspecialchars($artikel['url_gambar']); ?>" alt="<?php echo htmlspecialchars($artikel['keterangan_gambar']); ?>" class="w-full h-full object-cover">
                                </a>
                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-base font-bold mb-2 flex-grow line-clamp-2" style="min-height: 2.5rem;">
                                        <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="text-slate-800 hover:text-blue-700">
                                            <?php echo htmlspecialchars($artikel['judul']); ?>
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-3" style="min-height: 4.5rem;">
                                       <?php echo strip_tags($artikel['cuplikan']); ?>...
                                    </p>
                                    <div class="mt-auto text-right">
                                        <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                            Baca Selengkapnya &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-center col-span-full text-gray-500 py-10">Belum ada berita yang diterbitkan.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="berita.php" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </div>    

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
                    <li><a href="profil.phpl" class="hover:text-[#0077b6]">Profil</a></li>
                    <li><a href="berita.php" class="hover:text-[#0077b6]">Berita & Kegiatan</a></li>
                    <li><a href="ppdb.phpl" class="hover:text-[#0077b6]">PPDB</a></li>
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
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.10 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.10 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" />
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

    <!-- Script untuk navbar scroll effect -->
    <script>
    // Mobile menu toggle (tetap)
    document.getElementById('mobile-menu-button').onclick = function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    };
    const navbar = document.getElementById('navbar');
    const heroSection = document.querySelector('.hero-background');
    const heroHeight = heroSection.offsetHeight;
    window.addEventListener('scroll', function() {
        if(window.scrollY > heroHeight - 60) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
    
    // Animasi berhitung statistik hanya saat section terlihat
    function animateCount(id, target, duration = 1200) {
        const el = document.getElementById(id);
        let startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            let value = Math.floor(progress * target);
            if (id === "stat-alumni" && progress === 1) value = "2.500+";
            else if (id === "stat-alumni") value = Math.floor(progress * target);
            el.textContent = id === "stat-alumni" && progress === 1 ? value : value;
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = id === "stat-alumni" ? "2.500+" : target;
            }
        }
        requestAnimationFrame(step);
    }

    let statsAnimated = false;
    window.addEventListener('DOMContentLoaded', function() {
        const statsSection = document.querySelector('[data-statistik]');
        if (!statsSection) return;
        const observer = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting && !statsAnimated) {
                animateCount("stat-siswa", 386);
                animateCount("stat-guru", 22);
                animateCount("stat-tendik", 5);
                animateCount("stat-kelas", 12);
                animateCount("stat-alumni", 2500);
                statsAnimated = true;
                observer.disconnect();
            }
        }, { threshold: 0.4 });
        observer.observe(statsSection);
    });

    // Tombol balik ke atas
    document.getElementById('backToTop').onclick = function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    </script>
</body>
</html>