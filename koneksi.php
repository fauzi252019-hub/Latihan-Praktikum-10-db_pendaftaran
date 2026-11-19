<?php


mysqli_report(MYSQLI_REPORT_OFF);

//Parameter Koneksi
$host = "localhost";
$username = "root";
$password = "";
$database = "db_pendaftaran";

// Membuat Koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Memeriksa Koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . htmlspecialchars(mysqli_connect_error()));

} 

// Mengatur karakter agar huruf dan simbol tersimpan dengan benar
mysqli_set_charset($koneksi, "utf8mb4");
