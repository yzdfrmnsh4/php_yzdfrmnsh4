<?php
$host = "localhost";
$user = "root";    // atau root
$pass = "npmrundev"; // password MySQL
$db   = "testdb";

// Koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
