<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "clement", "danger123", "nama_database");

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan daftar tugas
$query = "SELECT * FROM todolist";
$result = mysqli_query($conn, $query);

// Menampilkan daftar tugas
echo "<h2>Todolist</h2>";
echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row['task'] . "</li>";
}
echo "</ul>";

// Menutup koneksi database
mysqli_close($conn);
?>
