-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 15.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `report-psikotes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `jumlah_peserta`, `tanggal_ujian`) VALUES
(1, 'SMA Negeri 1 Jakarta', 120, '2025-02-01'),
(2, 'SMP Negeri 3 Bandung', 85, '2025-02-03'),
(3, 'Universitas Gadjah Mada', 200, '2025-02-05'),
(4, 'SMK Negeri 2 Surabaya', 150, '2025-02-07'),
(5, 'Politeknik Negeri Malang', 180, '2025-02-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL,
  `text_soal` text NOT NULL,
  `pilihan_jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pilihan_jawaban`)),
  `kunci_jawaban` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `text_soal`, `pilihan_jawaban`, `kunci_jawaban`) VALUES
(1, 'Berapa hasil dari 5 + 3?', '{\"A\": \"6\", \"B\": \"7\", \"C\": \"8\", \"D\": \"9\"}', 'C'),
(2, 'Berapa hasil dari 9 - 4?', '{\"A\": \"4\", \"B\": \"5\", \"C\": \"6\", \"D\": \"7\"}', 'B'),
(3, 'Berapa hasil dari 3 × 2?', '{\"A\": \"5\", \"B\": \"6\", \"C\": \"7\", \"D\": \"8\"}', 'B'),
(4, 'Berapa hasil dari 8 ÷ 2?', '{\"A\": \"3\", \"B\": \"4\", \"C\": \"5\", \"D\": \"6\"}', 'B'),
(5, 'Berapa hasil dari 10 + 15?', '{\"A\": \"20\", \"B\": \"25\", \"C\": \"30\", \"D\": \"35\"}', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `instansi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id`, `nama_peserta`, `instansi_id`) VALUES
(1, 'Andi Setiawan', 1),
(2, 'Budi Santoso', 1),
(3, 'Citra Dewi', 2),
(4, 'Dewi Lestari', 2),
(5, 'Eka Putra', 3),
(6, 'Fani Rahma', 3),
(7, 'Gilang Saputra', 4),
(8, 'Hani Wulandari', 4),
(9, 'Indra Wijaya', 5),
(10, 'Joko Susilo', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `jawaban_peserta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `report`
--

INSERT INTO `report` (`id`, `peserta_id`, `pertanyaan_id`, `jawaban_peserta`) VALUES
(1, 1, 1, 'C'),
(2, 1, 2, 'B'),
(3, 1, 3, 'A'),
(4, 1, 4, 'B'),
(5, 1, 5, 'D'),
(6, 2, 1, 'B'),
(7, 2, 2, 'B'),
(8, 2, 3, 'C'),
(9, 2, 4, 'A'),
(10, 2, 5, 'C'),
(11, 3, 1, 'A'),
(12, 3, 2, 'A'),
(13, 3, 3, 'B'),
(14, 3, 4, 'C'),
(15, 3, 5, 'B'),
(16, 4, 1, 'D'),
(17, 4, 2, 'C'),
(18, 4, 3, 'A'),
(19, 4, 4, 'B'),
(20, 4, 5, 'A'),
(21, 5, 1, 'C'),
(22, 5, 2, 'B'),
(23, 5, 3, 'B'),
(24, 5, 4, 'A'),
(25, 5, 5, 'C'),
(26, 6, 1, 'B'),
(27, 6, 2, 'C'),
(28, 6, 3, 'A'),
(29, 6, 4, 'B'),
(30, 6, 5, 'D'),
(31, 7, 1, 'A'),
(32, 7, 2, 'B'),
(33, 7, 3, 'C'),
(34, 7, 4, 'B'),
(35, 7, 5, 'D'),
(36, 8, 1, 'C'),
(37, 8, 2, 'A'),
(38, 8, 3, 'B'),
(39, 8, 4, 'C'),
(40, 8, 5, 'B'),
(41, 9, 1, 'D'),
(42, 9, 2, 'B'),
(43, 9, 3, 'C'),
(44, 9, 4, 'A'),
(45, 9, 5, 'C'),
(46, 10, 1, 'B'),
(47, 10, 2, 'C'),
(48, 10, 3, 'D'),
(49, 10, 4, 'B'),
(50, 10, 5, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(5, 'dimas', '$2y$10$MmUZZT5qoM/SCzqqsKdUqeEI3cAi9hjfmEnLGocZw3HtEA7zZsPMK'),
(6, 'dimas', '$2y$10$rL0tvWnpVc6f/NILMLfmUerI/X3egMRP4cCmmSes2pkBKr9tbcyGW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instansi_id` (`instansi_id`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peserta_id` (`peserta_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `peserta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
