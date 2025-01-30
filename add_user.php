<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'report-psikotes';

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Data user yang akan ditambahkan
$username = "dimas";
$plain_password = "admin"; // Password dalam bentuk plain text
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT); // Hash password

// Query untuk menambahkan user
$query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($query) === TRUE) {
  echo "User berhasil ditambahkan!";
} else {
  echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>