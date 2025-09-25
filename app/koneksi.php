<?php

$db_host = 'localhost'; 
$db_user = 'root'; 
$db_pass = '';
$db_name = 'bendungan';

$koneksi = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($koneksi->connect_error) {
    die('Koneksi Database Gagal: ' . $koneksi->connect_error);
}

// Mengatur character set ke utf8mb4 untuk mendukung berbagai karakter
$koneksi->set_charset('utf8mb4');

?>