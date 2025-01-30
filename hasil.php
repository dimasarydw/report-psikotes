<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Ujian</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Hasil Ujian</h1>
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

    // Ambil ID Peserta dari URL
    $id_peserta = isset($_GET['id_peserta']) ? (int) $_GET['id_peserta'] : 0;

    // Query untuk mengambil nama peserta
    $query_nama = "SELECT nama_peserta FROM peserta WHERE id = $id_peserta";
    $result_nama = $conn->query($query_nama);
    $nama_user = '';

    if ($result_nama->num_rows > 0) {
      $row_nama = $result_nama->fetch_assoc();
      $nama_user = htmlspecialchars($row_nama['nama_peserta']);
    }

    // Menampilkan nama peserta
    echo "<h2 class='text-xl font-semibold text-gray-700'>Nama Peserta: $nama_user</h2>";
    ?>

    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2 text-left">Soal</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Jawaban Peserta</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Kunci Jawaban</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Query untuk mengambil data report berdasarkan peserta_id
        $query = "SELECT r.jawaban_peserta, p.text_soal, p.kunci_jawaban 
                  FROM report r 
                  JOIN pertanyaan p ON r.pertanyaan_id = p.id 
                  WHERE r.peserta_id = $id_peserta";
        $result = $conn->query($query);

        $total_nilai = 0;
        $total_soal = 0;

        // Menampilkan data hasil ujian
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $total_soal++;
            $status = ($row['jawaban_peserta'] === $row['kunci_jawaban']) ? 'Benar' : 'Salah';
            if ($status === 'Benar') {
              $total_nilai++;
            }

            echo "<tr>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['text_soal']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['jawaban_peserta']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . htmlspecialchars($row['kunci_jawaban']) . "</td>";
            echo "<td class='border border-gray-300 px-4 py-2'>" . $status . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr>";
          echo "<td colspan='4' class='border border-gray-300 px-4 py-2 text-center'>Tidak ada data hasil ujian</td>";
          echo "</tr>";
        }

        // Menghitung total nilai sebagai persentase
        $persentase_nilai = ($total_nilai / $total_soal) * 100;

        // Menampilkan total nilai sebagai tombol
        echo "<tr class='font-bold'>";
        echo "<td colspan='3' class='border border-gray-300 px-4 py-2 text-right'>Total Nilai:</td>";
        echo "<td class='border border-gray-300 px-4 py-2'>
                <button class='bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded'>
                  " . round($persentase_nilai) . "% 
                </button>
              </td>";
        echo "</tr>";

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
