<?php
// Mulai session
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  // Jika belum login, redirect ke halaman login
  header("Location: login.php");
  exit(); // Pastikan tidak ada kode yang dieksekusi setelah redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Instansi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Instansi</h1>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2 text-left">Nama Instansi</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Peserta</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Ujian</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Koneksi ke database
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'report-psikotes'; // Ganti dengan nama database Anda

        $conn = new mysqli($host, $user, $password, $database);

        // Cek koneksi
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data instansi
        $query = "SELECT id, nama_instansi, tanggal_ujian, 
                         (SELECT COUNT(*) FROM peserta WHERE instansi_id = instansi.id) AS jumlah_peserta 
                  FROM instansi";
        $result = $conn->query($query);

        // Menampilkan data instansi
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['nama_instansi']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['jumlah_peserta']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['tanggal_ujian']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>
                    <a href='peserta.php?id_instansi=" . htmlspecialchars($row['id']) . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>Lihat Peserta</a>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr>";
          echo "<td colspan='4' class='border border-gray-300 px-4 py-2 text-center'>Tidak ada data instansi</td>";
          echo "</tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>