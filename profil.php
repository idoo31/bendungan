<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDN Bendungan 01 - Profil Sekolah</title>
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
        /* Sticky Navbar Styles (sama seperti index) */
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
        /* Profil Sekolah Styles */
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
                <a href="#" class="text-yellow-300 border-b-2 border-yellow-300 pb-1">Profil</a>
                <a href="berita.php" class="hover:text-yellow-300">Berita & Kegiatan</a>
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
            <a href="#" class="block py-2 border-b border-gray-600">Profil</a>
            <a href="berita.php" class="block py-2 border-b border-gray-600">Berita & Kegiatan</a>
            <a href="ppdb.php" class="block py-2 border-b border-gray-600">PPDB</a>
            <a href="kontak.php" class="block py-2">Kontak</a>
        </div>
    </nav>

    <!-- Page Header -->
    <div id="header-section" class="profil-hero-bg py-4">
        <div class="container mx-auto px-4 pl-0 sm:pl-16">
            <div class="max-w-xl bg-transparent p-0">
                <h1 class="text-3xl font-bold text-yellow-300 mt-8 mb-2">Profil Sekolah</h1>
                <p class="mt-2 text-white text-base">Mengenal lebih dekat SDN Bendungan 01</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-[#e0f7fa] py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="index.php" class="text-[#0077b6] hover:text-[#023e8a]">Beranda</a>
                <span class="text-[#0077b6]">/</span>
                <span class="text-[#0077b6] font-semibold">Profil</span>
            </div>
        </div>
    </div>

    <!-- Sejarah Sekolah -->
    <div class="container mx-auto px-4 sm:px-8 md:px-16 py-8 sm:py-12">
        <div class="flex flex-col md:flex-row items-center gap-6 sm:gap-10">
            <div class="w-full md:w-1/2 max-w-2xl mx-auto">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#0077b6] mb-3 sm:mb-4">Sejarah SDN Bendungan 01</h2>
                <p class="text-gray-700 mb-3 sm:mb-4 text-sm sm:text-base">
                    Berdiri kokoh sejak tahun 1974, Sekolah Dasar Negeri (SDN) Bendungan 01 telah menjadi salah satu pilar pendidikan dasar di Desa Bendungan, Kecamatan Ciawi, Kabupaten Bogor. Dengan pengalaman panjang dalam dunia pendidikan, sekolah ini terus beradaptasi dengan perkembangan zaman, salah satunya dengan menerapkan Kurikulum Merdeka. Implementasi kurikulum ini bertujuan untuk memberikan pembelajaran yang lebih fleksibel dan berpusat pada minat serta bakat siswa, sejalan dengan visi pendidikan nasional.
                </p>
                <p class="text-gray-700 mb-3 sm:mb-4 text-sm sm:text-base">
                    Untuk mendukung tercapainya tujuan pembelajaran yang optimal, SDN Bendungan 01 Ciawi dilengkapi dengan berbagai fasilitas penunjang yang memadai. Sekolah ini memiliki ruang-ruang kelas yang nyaman, sebuah perpustakaan sebagai jantung pengetahuan, serta sarana sanitasi yang layak. Dengan lingkungan belajar yang kondusif dan didukung oleh tenaga pendidik yang berdedikasi, SDN Bendungan 01 Ciawi berkomitmen untuk mencetak generasi penerus bangsa yang cerdas, kreatif, dan berkarakter.
                </p>
                <div class="bg-[#e0f7fa] p-3 sm:p-4 rounded-lg border border-[#0077b6]">
                    <p class="text-xs sm:text-sm italic text-[#0077b6]">
                        "Pendidikan adalah bekal terbaik untuk perjalanan hidup." - Aristoteles
                    </p>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="asset/sekolah.jpeg" 
                     alt="Sejarah SDN Bendungan 01" 
                     class="w-full max-w-md h-auto rounded-lg shadow-lg border border-[#e0f7fa] mx-auto">
            </div>
        </div>
    </div>

    <!-- Visi Misi -->
    <div class="bg-[#e0f7fa] py-12">
        <div class="container mx-auto px-6 md:px-16">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-[#0077b6] mb-8">Visi dan Misi Sekolah</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <!-- Visi -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] p-2 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#0077b6]">Visi</h3>
                    </div>
                    <ol class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>Mewujudkan generasi cerdas, berkarakter, and berprestasi yang memiliki kepedulian terhadap lingkungan.</li>
                        <li>Menciptakan peserta didik yang unggul dalam ilmu pengetahuan dan teknologi dengan menjunjung tinggi nilai-nilai Pancasila dan cinta tanah air.</li>
                        <li>Menjadi sekolah berwawasan global yang mampu menghasilkan lulusan dengan kompetensi capaian dan integritas tinggi.</li>
                    </ol>
                </div>
                <!-- Misi -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#0077b6] p-2 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#0077b6]">Misi</h3>
                    </div>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>Meningkatkan kualitas pembelajaran melalui KOMUNITAS BELAJAR dalam melaksanakan Upgrading Kompetensi Guru dalam menciptakan metode yang inovatif serta pemanfaatan teknologi</li>
                        <li>Mengembangkan potensi peserta didik dalam bidang akademik maupun non-akademik melalui kegiatan intrakurikuler dan ekstrakurikuler.</li>
                        <li>Membentuk karakter disiplin, santun, dan berakhlak mulia melalui pembinaan dan teladan di lingkungan sekolah.</li>
                        <li>Menciptakan lingkungan sekolah yang bersih, asri, nyaman, dan aman untuk mendukung proses belajar yang optimal.</li>
                        <li>Meningkatkan literasi dan budaya belajar yang kuat pada seluruh warga sekolah.</li>
                        <li>Melibatkan seluruh warga sekolah dan pemangku kepentingan (stakeholder) dalam program dan kegiatan sekolah.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

        <!-- Profil Guru -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-[#0077b6] mb-8">Kenali Guru & Staf Kami</h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-10">
            Tim pendidik kami yang berdedikasi dan berpengalaman siap membimbing putra-putri Anda menjadi generasi penerus yang berprestasi dan berkarakter.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="bg-white p-6 rounded-lg shadow-primary text-center transition-transform transform hover:-translate-y-2">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden border-4 border-[#0077b6]">
                    <img src="https://placehold.co/200x200/e0f7fa/0077b6" alt="Kepala Sekolah" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-xl text-[#0077b6]">Drs. Ahmad Supriyadi, M.Pd</h3>
                <p class="text-[#023e8a] font-medium">Kepala Sekolah</p>
                <p class="text-gray-500 text-sm mt-2 italic">"Pendidikan adalah kunci untuk membuka pintu emas kebebasan."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-primary text-center transition-transform transform hover:-translate-y-2">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden border-4 border-[#0077b6]">
                    <img src="https://placehold.co/200x200/e0f7fa/0077b6" alt="Guru Kelas 6" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-xl text-[#0077b6]">Siti Rahayu, S.Pd</h3>
                <p class="text-[#023e8a] font-medium">Wali Kelas VI</p>
                <p class="text-gray-500 text-sm mt-2 italic">"Membentuk karakter dan menginspirasi mimpi setiap siswa."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-primary text-center transition-transform transform hover:-translate-y-2">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden border-4 border-[#0077b6]">
                    <img src="https://placehold.co/200x200/e0f7fa/0077b6" alt="Guru Olahraga" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-xl text-[#0077b6]">Budi Santoso, S.Pd</h3>
                <p class="text-[#023e8a] font-medium">Guru Olahraga</p>
                <p class="text-gray-500 text-sm mt-2 italic">"Membangun jiwa yang kuat dalam tubuh yang sehat."</p>
            </div>

        </div>
    </div>

    <!-- Prestasi Sekolah -->
    <div class="bg-[#e0f7fa] py-12">
        <div class="container mx-auto px-6 md:px-16">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-[#0077b6] mb-8">Prestasi Sekolah</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Prestasi 1 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">1</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Juara I Lomba Sains Nasional</h3>
                    <p class="text-gray-700">Tahun 2023 - Tingkat Kota Bogor</p>
                </div>
                <!-- Prestasi 2 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">2</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Sekolah Adiwiyata</h3>
                    <p class="text-gray-700">Penghargaan Nasional Tahun 2022</p>
                </div>
                <!-- Prestasi 3 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">3</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Juara Umum Olimpiade Matematika</h3>
                    <p class="text-gray-700">Tahun 2023 - Tingkat Provinsi Jawa Barat</p>
                </div>
                <!-- Prestasi 4 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">15</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Juara Lomba Seni</h3>
                    <p class="text-gray-700">Total kemenangan dalam 5 tahun terakhir</p>
                </div>
                <!-- Prestasi 5 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">5</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Sekolah Penggerak</h3>
                    <p class="text-gray-700">Program Kemendikbud Tahun 2022</p>
                </div>
                <!-- Prestasi 6 -->
                <div class="bg-white p-6 rounded-lg shadow-primary border border-[#e0f7fa] max-w-md mx-auto">
                    <div class="text-4xl font-bold text-[#0077b6] mb-2">98%</div>
                    <h3 class="text-lg font-bold text-[#0077b6] mb-2">Kelulusan</h3>
                    <p class="text-gray-700">Rata-rata tingkat kelulusan 5 tahun terakhir</p>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer id="footer" class="bg-[#e0f7fa] pt-8 sm:pt-10 pb-0 relative">
        <div class="container mx-auto px-4 sm:px-6 md:px-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 pb-6 sm:pb-8">
                <div>
                    <div class="flex items-center mb-3">
                        <img src="asset/logo.png" class="h-8 w-8 text-[#0077b6] mr-2" />
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
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.43.03-4.83-.95-6.43-2.98-1.55-1.99-2.3-4.42-2.12-6.86.17-2.28 1.1-4.47 2.46-6.23 1.35-1.74 3.19-3.03 5.22-3.51v4.03c-1.11.23-2.18.69-3.1 1.32-.42.28-.79.63-1.14 1.02-1.02 1.13-1.57 2.5-1.53 3.99.04 1.48.59 2.92 1.59 4.02 1.01 1.1 2.37 1.74 3.84 1.73 1.47-.02 2.85-.63 3.81-1.73 1.03-1.17 1.58-2.65 1.52-4.15-.04-1.39-.49-2.76-1.32-3.86-.89-1.16-2.25-1.85-3.68-1.92V.02z" />
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

    <!-- Tombol Back to Top -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-[#0077b6] text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300 z-40">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

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
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            // Navbar scroll effect
            if (window.scrollY > headerHeight - 60) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
            
            // Back to top button
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0');
            }
        });

        // Tombol balik ke atas
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Mobile menu close when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>