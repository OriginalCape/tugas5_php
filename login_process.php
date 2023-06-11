<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "clement", "danger123", "nama_database");

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data dari form login
$username = $_POST['clement'];
$password = $_POST['danger123'];

// Melakukan query untuk memeriksa apakah username dan password valid
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

// Memeriksa hasil query
if (mysqli_num_rows($result) > 0) {
    // Jika login berhasil, redirect ke halaman todolist
    header("Location: todolist.php");
} else {
    // Jika login gagal, tampilkan pesan error
    echo "Username atau password salah";
}

// Menutup koneksi database
mysqli_close($conn);
?>
