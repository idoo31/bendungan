<?php
require_once 'app/koneksi.php';

// Ambil 6 artikel terbaru yang statusnya 'diterbitkan'
$sql = "SELECT judul, slug, penulis, waktu_terbit, LEFT(isi_konten, 200) as cuplikan, url_gambar, keterangan_gambar 
        FROM artikel 
        WHERE status = 'diterbitkan' 
        ORDER BY waktu_terbit DESC
        LIMIT 6";
$result_berita = $koneksi->query($sql);

// Fungsi untuk format waktu
function formatWaktu($waktu) {
    $timestamp = strtotime($waktu);
    $sekarang = time();
    $selisih = $sekarang - $timestamp;

    if ($selisih < 60) {
        return $selisih . ' detik yang lalu';
    } elseif ($selisih < 3600) {
        return floor($selisih / 60) . ' menit yang lalu';
    } elseif ($selisih < 86400) {
        return floor($selisih / 3600) . ' jam yang lalu';
    } else {
        return date('j M Y', $timestamp);
    }
}
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
        
        /* Custom styles for text truncation */
        .truncate-text {
            display: -webkit-box;
            -webkit-line-clamp: 8; /* Controls how many lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            .hero-background {
                min-height: auto;
                padding: 60px 0;
            }
            .seragam-container {
                overflow-x: auto;
                padding-bottom: 1rem;
            }
            /* Hapus display flex pada .seragam-wrapper agar grid Tailwind bekerja di mobile */
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav id="navbar" class="navbar fixed top-0 left-0 w-full text-white z-50 h-[80px] flex items-center">
        <div class="container mx-auto px-4 sm:px-6 flex justify-between items-center h-full">
            <div class="flex items-center space-x-3">
                <img src="asset/lambang.png" alt="Logo SDN Bendungan 01" class="h-12 w-12 p-1">
                <div>
                    <span class="block text-base sm:text-lg font-bold text-yellow-300 tracking-wide">SDN BENDUNGAN 01</span>
                    <span class="block text-xs text-white">Sekolah Dasar Negeri Unggulan</span>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 font-medium text-base">
                <a href="#" class="text-yellow-300 border-b-2 border-yellow-300 pb-1">Beranda</a>
                <a href="profil.php" class="hover:text-yellow-300">Profil</a>
                <a href="berita.php" class="hover:text-yellow-300">Berita & Kegiatan</a>
                <a href="ppdb.php" class="hover:text-yellow-300">PPDB</a>
                <a href="kontak.php" class="hover:text-yellow-300">Kontak</a>
            </div>
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Navbar (Mobile) -->
        <div id="mobile-menu" class="md:hidden hidden bg-[#223333] px-6 py-4 absolute top-[80px] left-0 w-full z-40">
            <a href="#" class="block py-2 text-yellow-300 border-b border-gray-600">Beranda</a>
            <a href="profil.php" class="block py-2 border-b border-gray-600">Profil</a>
            <a href="berita.php" class="block py-2 border-b border-gray-600">Berita & Kegiatan</a>
            <a href="ppdb.php" class="block py-2 border-b border-gray-600">PPDB</a>
            <a href="kontak.php" class="block py-2">Kontak</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-background pt-24 pb-12 md:pt-0 md:pb-0">
        <div class="container mx-auto px-4 sm:px-6 flex flex-col md:flex-row items-center justify-between w-full gap-8">
            <div class="md:flex-1 max-w-xl text-left md:text-left">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white ml-0 md:ml-12 mb-4 leading-tight">
                    Berprestasi, Semangat,<br>Aktif, Taat, Unggul.
                </h1>
                <p class="text-base sm:text-lg text-white ml-0 md:ml-12 mb-6 text-left md:text-left">
                    SDN Bendungan 01 Mewujudkan Lulusan Unggul Berkarakter dan Berprestasi dalam Persaingan Global.
                </p>
                <div class="flex justify-center md:justify-start">
                    <a href="profil.php" class="bg-yellow-300 text-[#0077b6] font-semibold px-6 py-3 ml-0 md:ml-12 rounded-lg shadow hover:bg-yellow-400 transition text-base w-full sm:w-auto">
                        Profil Sekolah
                    </a>
                </div>
            </div>
            <!-- Gambar hanya ditampilkan di desktop -->
            <div class="hidden md:flex md:flex-1 justify-center md:justify-end items-center">
                <div class="relative w-full mr-8 max-w-sm md:max-w-md">
                    <img src="asset/belajar.png"
                        alt="Siswa SDN Bendungan 01"
                        class="rounded-xl shadow-lg w-full h-auto object-cover border-4 border-yellow-300">
                    <div class="absolute bottom-0 left-0 w-full h-10 bg-yellow-300 opacity-80 rounded-b-xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sambutan Kepsek Section (Diperpanjang) -->
    <div class="py-16 bg-[#e0f7fa]">
        <style>
            /* Mobile-only: make sambutan side-by-side like desktop but scaled down */
            @media (max-width: 639px) {
                .sambutan-mobile-row { display: flex; flex-direction: row; flex-wrap: wrap; align-items: center; }
                .sambutan-mobile-row .text-col { width: 65%; }
                .sambutan-mobile-row .img-col { width: 35%; display: flex; justify-content: center; }
                .sambutan-mobile-row .text-col h2 { font-size: 0.9rem; }
                .sambutan-mobile-row .text-col h3 { font-size: 1.4rem; }
                .sambutan-mobile-row .text-col .truncate-text { font-size: 0.9rem; }
                .sambutan-mobile-row .img-col { align-items: center; justify-content: center; display: flex; }
                .sambutan-mobile-row .img-col img { width: 200px; height: auto; display: block; margin-left: auto; margin-right: auto; }
            }
        </style>
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row items-center gap-8 max-w-4xl mx-auto bg-white rounded-xl p-8 md:p-12 shadow-lg border border-[#b3e0f2] min-h-[500px] sambutan-mobile-row">
                <div class="flex-1 flex flex-col justify-center text-center md:text-left text-col">
                    <h2 class="text-base font-semibold text-black mb-1">Sambutan Kepala Sekolah</h2>
                    <h3 class="text-2xl md:text-3xl font-bold text-[#0077b6] mb-2">Kiagus Dadan Ramdhan, S.Pd</h3>
                    <!-- Foto di tengah pada mobile, di samping pada desktop -->
                    <div class="block md:hidden my-4">
                        <div class="bg-white p-2 rounded-lg shadow-lg border-4 border-white w-fit mx-auto">
                            <img src="asset/kepsek.png" alt="Kepala Sekolah" style="width:200px;max-width:80vw;" class="h-auto rounded-lg object-cover mx-auto">
                        </div>
                    </div>
                    <div class="text-black text-sm md:text-base mb-6 truncate-text text-justify">
                        <p class="mb-4">Selamat datang di SDN Bendungan 01. Kami percaya bahwa pendidikan adalah kunci masa depan anak-anak. Bersama, mari kita ciptakan lingkungan belajar yang menyenangkan dan penuh semangat untuk membangun generasi yang berkarakter dan berprestasi.</p>
                        
                        <p class="mb-4">Di era yang penuh tantangan ini, kami berkomitmen untuk memberikan pendidikan yang tidak hanya fokus pada aspek akademik, tetapi juga pengembangan karakter, kreativitas, dan keterampilan sosial siswa. Kami percaya bahwa setiap anak memiliki potensi unik yang perlu dikembangkan secara optimal.</p>
                        
                        <p class="mb-4">Kami mengimplementasikan kurikulum yang seimbang antara pengetahuan, keterampilan, dan nilai-nilai kehidupan. Dengan pendekatan pembelajaran yang berpusat pada siswa, kami berusaha menciptakan pengalaman belajar yang bermakna dan relevan dengan kehidupan sehari-hari.</p>
                        
                        <p class="mb-4">Kolaborasi antara sekolah, orang tua, dan masyarakat merupakan kunci keberhasilan pendidikan anak. Kami sangat menghargai partisipasi aktif orang tua dalam mendukung proses belajar anak di rumah dan di sekolah.</p>
                        
                        <p>Kami berharap melalui pendidikan yang holistik di SDN Bendungan 01, siswa-siswi dapat tumbuh menjadi pribadi yang berakhlak mulia, mandiri, kreatif, dan siap menghadapi tantangan masa depan dengan penuh percaya diri.</p>
                    </div>
                    <a href="profil.php" class="inline-block bg-[#0077b6] text-yellow-300 font-semibold px-6 py-3 rounded-lg shadow hover:bg-yellow-300 hover:text-[#0077b6] transition text-base self-center md:self-start">
                        Baca Sambutan Lengkap &rarr;
                    </a>
                </div>
                <!-- Gambar hanya untuk desktop (md+) -->
                <div class="hidden md:flex justify-center items-center md:order-last">
                    <div class="bg-white p-2 rounded-lg shadow-lg border-4 border-white">
                        <img src="asset/kepsek.png" alt="Kepala Sekolah" class="w-48 h-auto md:w-72 rounded-lg object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Keunggulan -->
    <div class="bg-white py-12 sm:py-20 mb-8">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-center mb-3 text-[#0077b6]">Keunggulan SDN Bendungan 01</h2>
            <div class="mb-8 h-[2px] w-[80px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
            <div class="pt-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-yellow-300 rounded-xl flex items-center justify-center mb-6 w-16 h-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-black">Akreditasi Baik</h3>
                    <p class="text-black text-sm">
                        Sekolah dengan akreditasi Baik dari BAN-S/M, menjamin mutu pendidikan terbaik.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-yellow-300 rounded-xl flex items-center justify-center mb-6 w-16 h-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-black">Kurikulum Unggulan</h3>
                    <p class="text-black text-sm">
                        Kurikulum Merdeka dengan penguatan karakter dan pembelajaran inovatif.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center px-4">
                    <div class="bg-yellow-300 rounded-xl flex items-center justify-center mb-6 w-16 h-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#0077b6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-black">Guru Berkompeten</h3>
                    <p class="text-black text-sm">
                        Guru bersertifikasi dan berpengalaman, siap membimbing siswa menuju prestasi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Jadwal Seragam Sekolah -->
    <div class="bg-[#e0f7fa] py-12">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-[#0077b6] mb-4">Jadwal Seragam Sekolah</h2>
                <div class="mb-4 h-[2px] w-[80px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-sm md:text-base text-black max-w-2xl mx-auto">
                    Berikut jadwal penggunaan seragam siswa SDN Bendungan 01 setiap hari sekolah.
                </p>
            </div>
            <div class="seragam-container">
                <div class="seragam-wrapper grid grid-cols-2 gap-4 px-4 justify-items-center md:flex md:justify-center md:flex-wrap md:gap-8 md:px-0">
                    <div class="flex flex-col items-center w-full md:w-36 col-span-2 mx-auto md:col-span-1 md:mx-0">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 border-4 border-yellow-300 rounded-full overflow-hidden bg-white mb-3">
                            <img src="asset/putihmerah.jpg" alt="Seragam Senin" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-lg mb-1">Senin</div>
                        <div class="text-sm text-black text-center">Merah Putih<br>Lengkap</div>
                    </div>
                    <div class="flex flex-col items-center w-full md:w-36">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 border-4 border-yellow-300 rounded-full overflow-hidden bg-white mb-3">
                            <img src="asset/batik.jpg" alt="Seragam Selasa" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-lg mb-1">Selasa</div>
                        <div class="text-sm text-black text-center">Batik Sekolah</div>
                    </div>
                    <div class="flex flex-col items-center w-full md:w-36">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 border-4 border-yellow-300 rounded-full overflow-hidden bg-white mb-3">
                            <img src="asset/pramuka.jpg" alt="Seragam Rabu" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-lg mb-1">Rabu</div>
                        <div class="text-sm text-black text-center">Pramuka Lengkap</div>
                    </div>
                    <div class="flex flex-col items-center w-full md:w-36">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 border-4 border-yellow-300 rounded-full overflow-hidden bg-white mb-3">
                            <img src="asset/bajubudaya.jpg" alt="Seragam Kamis" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-lg mb-1">Kamis</div>
                        <div class="text-sm text-black text-center">Batik Sekolah</div>
                    </div>
                    <div class="flex flex-col items-center w-full md:w-36">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 border-4 border-yellow-300 rounded-full overflow-hidden bg-white mb-3">
                            <img src="asset/putihhitam.jpg" alt="Seragam Jumat" class="object-cover w-full h-full" />
                        </div>
                        <div class="font-bold text-[#0077b6] text-lg mb-1">Jumat</div>
                        <div class="text-sm text-black text-center">Baju Muslim</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#0077b6] mb-2">Ekstrakurikuler</h2>
                <div class="mb-6 h-[2px] w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">
                    SDN Bendungan 01 menyediakan berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Paskibra</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Melatih kedisiplinan, patriotisme, dan keterampilan baris-berbaris.</p>
                </div>
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Karate</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Mengembangkan kemampuan bela diri, disiplin, fokus, dan kesehatan fisik.</p>
                </div>
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Futsal</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Meningkatkan keterampilan sepak bola, kerjasama tim, dan kebugaran jasmani.</p>
                </div>
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Drumband</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Mengembangkan bakat musik, ritme, dan kerjasama dalam kelompok.</p>
                </div>
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 7h7l-5.5 4.5L16 21l-4-3-4 3 1.5-7.5L3 9h7z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Pramuka</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Membentuk karakter mandiri, kreatif, peduli lingkungan, dan jiwa kepemimpinan.</p>
                </div>
                <div class="bg-[#f6fbff] rounded-xl p-6 shadow-md hover:shadow-lg transition-all border border-[#b3e0f2]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] text-yellow-300 rounded-lg flex items-center justify-center w-12 h-12 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#0077b6]">Degung</h3>
                    </div>
                    <p class="text-gray-700 text-sm">Melestarikan seni musik tradisional Sunda dan mengembangkan apresiasi budaya.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-12 sm:py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4" data-statistik>
                <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center p-4 md:p-6 md:min-h-[160px] text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div id="stat-siswa" class="text-2xl font-bold text-white" data-count="386">0</div>
                    <div class="text-xs text-white font-medium">Siswa Aktif</div>
                </div>
                <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center p-4 md:p-6 md:min-h-[160px] text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div id="stat-guru" class="text-2xl font-bold text-white" data-count="22">0</div>
                    <div class="text-xs text-white font-medium">Guru</div>
                </div>
                <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center p-4 md:p-6 md:min-h-[160px] text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <div id="stat-tendik" class="text-2xl font-bold text-white" data-count="5">0</div>
                    <div class="text-xs text-white font-medium">Tenaga Pendidik</div>
                </div>
                <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center p-4 md:p-6 md:min-h-[160px] text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div id="stat-kelas" class="text-2xl font-bold text-white" data-count="12">0</div>
                    <div class="text-xs text-white font-medium">Kelas</div>
                </div>
                <div class="bg-[#0077b6] rounded-xl shadow flex flex-col items-center justify-center p-4 md:p-6 md:min-h-[160px] text-center col-span-2 sm:col-span-1">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    <div id="stat-alumni" class="text-2xl font-bold text-white" data-count="2500">0</div>
                    <div class="text-xs text-white font-medium">Alumni</div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#e0f7fa] py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#0077b6]">Fasilitas Sekolah</h2>
                <div class="my-4 h-[2px] w-[80px] sm:w-[100px] mx-auto bg-gradient-to-r from-transparent via-[#0077b6] to-transparent"></div>
                <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">
                    Fasilitas modern untuk mendukung proses belajar mengajar dan pengembangan bakat siswa.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Perpustakaan" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Perpustakaan</h3>
                        <p class="text-xs text-gray-600">Koleksi 5.000+ buku.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lapangan Indoor" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Lapangan Indoor</h3>
                        <p class="text-xs text-gray-600">Untuk kegiatan olahraga.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lapangan Outdoor" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Lapangan Outdoor</h3>
                        <p class="text-xs text-gray-600">Untuk upacara & atletik.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lab Komputer" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Lab Komputer</h3>
                        <p class="text-xs text-gray-600">Pembelajaran TI.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1605721911519-3dfeb3be25e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Ruang Seni" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Ruang Seni</h3>
                        <p class="text-xs text-gray-600">Alat musik tradisional.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                    <img src="https://i.pinimg.com/736x/99/f6/c5/99f6c533388f9c49fe857f13dd25f822.jpg" alt="Musholla" class="w-full h-28 md:h-36 lg:h-40 object-cover">
                    <div class="p-3 md:p-4">
                        <h3 class="text-sm font-bold text-[#0077b6] mb-1">Musholla</h3>
                        <p class="text-xs text-gray-600">Tempat ibadah nyaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-12 sm:py-20">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-800">Berita & Kegiatan Terbaru</h2>
                <p class="text-slate-500 mt-2">Ikuti informasi dan kegiatan terkini dari sekolah kami.</p>
            </div>

            <div class="md:hidden">
                <div class="space-y-4">
                <?php if ($result_berita && $result_berita->num_rows > 0): ?>
                    <?php mysqli_data_seek($result_berita, 0); // Reset pointer hasil query ?>
                    <?php while($artikel = $result_berita->fetch_assoc()): ?>
                        <a href="artikel.php?slug=<?php echo htmlspecialchars($artikel['slug']); ?>" class="flex items-center gap-4 p-2 rounded-lg hover:bg-gray-100">
                            <img src="<?php echo htmlspecialchars($artikel['url_gambar']); ?>" alt="<?php echo htmlspecialchars($artikel['keterangan_gambar']); ?>" class="w-24 h-20 object-cover rounded-md flex-shrink-0">
                            <div class="flex-grow">
                                <h3 class="text-base font-semibold text-slate-800 line-clamp-2">
                                    <?php echo htmlspecialchars($artikel['judul']); ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <?php echo formatWaktu($artikel['waktu_terbit']); ?>
                                </p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 py-10">Belum ada berita yang diterbitkan.</p>
                <?php endif; ?>
                </div>
            </div>

            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                <?php if ($result_berita && $result_berita->num_rows > 0): ?>
                    <?php mysqli_data_seek($result_berita, 0); // Reset pointer hasil query ?>
                    <?php while($artikel = $result_berita->fetch_assoc()): ?>
                        <div class="bg-[#f6fbff] rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col w-full max-w-xs mx-auto border border-[#b3e0f2]">
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
                <?php endif; ?>
            </div>
            
            <?php if (!$result_berita || $result_berita->num_rows === 0): ?>
                <p class="hidden md:block text-center col-span-full text-gray-500 py-10">Belum ada berita yang diterbitkan.</p>
            <?php endif; ?>


            <div class="text-center mt-12">
                <a href="berita.php" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </div>    

    <footer id="footer" class="bg-[#e0f7fa] pt-10">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 pb-8">
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
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-[#0077b6] mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                            </svg>
                            (0251) - 8324567
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-[#0077b6] mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            s.dbendungan01@gmail.com
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-[#0077b6] mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                 <path d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 5a2 2 0 012-2h2.09a2 2 0 012 1.72c.13.81.42 1.6.87 2.29a2 2 0 01-.45 2.11l-.94.94a16 16 0 006.29 6.29l.94-.94a2 2 0 012.11-.45c.69.45 1.48.74 2.29.87A2 2 0 0122 16.92z" />
                            </svg>
                            +62 877 7004 7554
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-[#023e8a] mb-3">Ikuti Kami</h3>
                    <div class="flex items-center gap-4 mt-2">
                        <a href="https://www.instagram.com/bendungan_sd" target="_blank" class="text-gray-700 hover:text-[#0077b6]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.585-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.07-1.645-.07-4.85s.012-3.585.07-4.85c.148-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@bendungan_sd?is_from_webapp=1&sender_device=pc" target="_blank" class="text-gray-700 hover:text-[#0077b6]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.10 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.10 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#023e8a] py-3 mt-0">
            <div class="container mx-auto px-4 sm:px-6 text-center text-white text-xs sm:text-sm">
                <span>Hak cipta © 2025 SDN Bendungan 01. Seluruh hak cipta dilindungi.</span>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuButton) {
            mobileMenuButton.onclick = function() {
                if (mobileMenu) mobileMenu.classList.toggle('hidden');
            };
        }

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        const heroSection = document.querySelector('.hero-background');
        if (navbar && heroSection) {
            const heroHeight = heroSection.offsetHeight;
            window.addEventListener('scroll', function() {
                if (window.scrollY > heroHeight - 80) { // Adjusted offset
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        }
        
        // Animasi berhitung statistik
        function animateCount(el, target, duration = 1500) {
            let start = 0;
            let startTime = null;
            
            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                let current = Math.floor(progress * (target - start) + start);
                
                if (el.id === "stat-alumni") {
                    if (progress < 1) {
                         el.textContent = current.toLocaleString('id-ID');
                    } else {
                         el.textContent = "2.500+";
                    }
                } else {
                    el.textContent = current.toLocaleString('id-ID');
                }
                
                if (progress < 1) {
                    requestAnimationFrame(step);
                }
            }
            requestAnimationFrame(step);
        }

        let statsAnimated = false;
        const statsSection = document.querySelector('[data-statistik]');
        if (statsSection) {
            const observer = new IntersectionObserver(function(entries) {
                if (entries[0].isIntersecting && !statsAnimated) {
                    const counters = statsSection.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-count'));
                        animateCount(counter, target);
                    });
                    statsAnimated = true;
                    observer.disconnect();
                }
            }, { threshold: 0.4 });
            observer.observe(statsSection);
        }
    });
    </script>
</body>
</html>