<?php
require_once 'koneksi.php';
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'save') {
    $nama_penanya = $_POST['nama_penanya'];
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];
    $status = $_POST['status'];

    $stmt = $koneksi->prepare("INSERT INTO tanya_jawab (nama_penanya, pertanyaan, jawaban, status, waktu_jawab) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $nama_penanya, $pertanyaan, $jawaban, $status);
    $stmt->execute();
    $stmt->close();
} elseif ($action === 'update') {
    $id = (int)$_POST['id'];
    $nama_penanya = $_POST['nama_penanya'];
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];
    $status = $_POST['status'];

    $stmt = $koneksi->prepare("UPDATE tanya_jawab SET nama_penanya = ?, pertanyaan = ?, jawaban = ?, status = ?, waktu_jawab = NOW() WHERE id = ?");
    $stmt->bind_param("ssssi", $nama_penanya, $pertanyaan, $jawaban, $status, $id);
    $stmt->execute();
    $stmt->close();
}

$koneksi->close();
header("Location: ../admin.php?page=tanyajawab");
exit();
?>