<?php
session_start();
// Jika sudah login, redirect ke halaman admin
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border">
        <h1 class="text-3xl font-bold text-center text-slate-800 mb-2">Admin Panel Login</h1>
        <p class="text-center text-slate-500 mb-6">Silakan masuk untuk melanjutkan</p>

        <?php
        // Tampilkan pesan error jika ada
        if (isset($_GET['error'])) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Login Gagal!</strong>
                    <span class="block sm:inline">Username atau password salah.</span>
                  </div>';
        }
        ?>

        <form action="app/proses_login.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-lg font-medium text-slate-700 mb-2">Username</label>
                <input type="text" name="username" id="username" class="w-full text-lg px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-lg font-medium text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full text-lg px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white text-lg font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                Login
            </button>
        </form>
    </div>
</body>
</html>