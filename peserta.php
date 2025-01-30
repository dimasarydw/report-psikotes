<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Peserta Ujian</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Peserta Ujian</h1>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2 text-left">Nama Peserta</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Hasil Ujian</th>
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

        // Ambil ID Instansi dari URL
        $id_instansi = isset($_GET['id_instansi']) ? (int) $_GET['id_instansi'] : 0;

        // Query untuk mengambil data peserta berdasarkan instansi_id
        $query = "SELECT * FROM peserta WHERE instansi_id = $id_instansi"; // Menggunakan instansi_id
        $result = $conn->query($query);

        // Menampilkan data peserta
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['nama_peserta']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>
                    <a href='hasil.php?id_peserta=" . htmlspecialchars($row['id']) . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>Lihat Hasil</a>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr>";
          echo "<td colspan='3' class='border border-gray-300 px-4 py-2 text-center'>Tidak ada peserta untuk instansi ini</td>";
          echo "</tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
