<?php
// Koneksi ke database MySQL
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'login_db';

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Memproses data login
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan query untuk memeriksa data login
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    // Login berhasil, redirect ke halaman sukses atau halaman lainnya
    header("Location: todolist.php");
} else {
    // Login gagal, redirect ke halaman login dengan pesan error
    header("Location: login.php?error=1");
}

mysqli_close($connection);
?>
