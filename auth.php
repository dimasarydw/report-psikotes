<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'report-psikotes';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mengambil data user berdasarkan username
$query = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Verifikasi password
  if (password_verify($password, $row['password'])) {
    // Jika password benar, buat session
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header("Location: index.php"); // Redirect ke halaman utama
  } else {
    echo "Password salah.";
  }
} else {
  echo "Username tidak ditemukan.";
}

$conn->close();
?>