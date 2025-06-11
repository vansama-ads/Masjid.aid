-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2025 pada 17.22
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
-- Database: `masjid_aid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi_tujuan`
--

CREATE TABLE `donasi_tujuan` (
  `id_donasi` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `hp` int(15) NOT NULL,
  `penggunaan` varchar(50) DEFAULT NULL,
  `jumlah` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donasi_tujuan`
--

INSERT INTO `donasi_tujuan` (`id_donasi`, `foto`, `nama`, `alamat`, `alamat_lengkap`, `hp`, `penggunaan`, `jumlah`) VALUES
(21, 'sitihajar.jpg', 'Masjid Siti Hajar', ' Kabupaten Sidoarjo', 'Jasem, Bulusidokare, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61234', 876767676, '-', 0),
(22, 'cordoba.jpg', 'Masjid Cordoba', ' Kabupaten Sidoarjo', 'Jl. Pecantingan, RT.12/RW.4, Sekardangan Indah, Sekardangan, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61251', 8989898, 'Karpet sajadah', 25000),
(24, 'albadar.png', 'Masjid Al-Badar', ' Kabupaten Sidoarjo', 'Jl. Pecantingan, Sekardangan Indah, Sekardangan, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61215', 8654325, 'renovasi kamar mandi', 101000),
(25, 'ukhuwah.jpg', 'Masjid Ukhuwah Islamiyah', 'Kabupaten Sidoarjo', 'Sekardangan Indah, Sekardangan, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61215', 98765678, '-', 0),
(26, 'masjidagung.jpeg', 'Masjid Agung Sidoarjo', 'Kabupaten Sidoarjo', 'Jl. Sultan Agung No.36, Gajah Timur, Magersari, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 60294', 987987679, '-', 75000),
(27, 'baitussalam.jpeg', 'Masjid Baitussalam', 'Kabupaten Sidoarjo', 'Jl. Wijaya Kusuma, Sekardangan Indah, Sekardangan, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61215', 873632, 'Renovasi tempat wudhu', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `kategori` enum('qris','bank') DEFAULT NULL,
  `rekening` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama`, `kategori`, `rekening`) VALUES
(1, 'gopay', 'qris', ''),
(5, 'BCAmobile', 'bank', '1401443504 '),
(7, 'Shopeepay', 'qris', ''),
(8, 'OVO', 'qris', ''),
(10, 'BNI', 'bank', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `waktu_pembayaran` date DEFAULT current_timestamp(),
  `status` enum('gagal','pending','sukses') DEFAULT NULL,
  `bukti_pembayaran` text NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `waktu_pembayaran`, `status`, `bukti_pembayaran`, `id_transaksi`) VALUES
(27, '2025-05-30', 'sukses', '1748606711_WhatsApp Image 2025-05-24 at 08.11.54_87a9bab2.jpg', 116),
(28, '2025-06-03', 'sukses', '1748921466_Ellipse 1.png', 117),
(29, '2025-06-03', 'sukses', '1748931579_1327343_720.jpg', 118),
(30, '2025-06-05', 'sukses', '1749088067_Screenshot 2024-09-14 080024.png', 120);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `waktu` date DEFAULT current_timestamp(),
  `pesan` varchar(255) DEFAULT NULL,
  `status` enum('pending','sukses','','') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_donasi` int(11) DEFAULT NULL,
  `id_metode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `jumlah`, `waktu`, `pesan`, `status`, `user_id`, `id_donasi`, `id_metode`) VALUES
(116, 25000, '2025-05-30', 'bismilah lancar', 'sukses', 19, 22, 5),
(117, 1000, '2025-06-03', 'semoga berkah', 'sukses', 19, 24, 8),
(118, 100000, '2025-06-03', 'Semoga Berkah', 'sukses', 19, 24, 8),
(119, 100000, '2025-06-03', 'semoga diterima', 'pending', 19, 24, 1),
(120, 75000, '2025-06-05', 'semoga berguna aamiin', 'sukses', 19, 26, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `sandi` varchar(200) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `foto`, `nama`, `username`, `sandi`, `role`, `email`, `no_hp`, `alamat`) VALUES
(17, '', 'Evan Satria Mahardika', 'evan', '$2y$10$a2.oSmLznq5OJZZXzB51LOw.gvcACTiD130q96JeJLbYw6v4mcBs2', 'user', 'rukanarutin40@gmail.com', '085876335559', ''),
(19, '6826a25729104_images.jpg', 'Kamisato Ayato', 'Ayato', '$2y$10$RnOKbaqx09Sr9OwwdwzRI.fHp.oE9KOF4mt5kYr74Pim/3b94d9l.', 'admin', 'kamisato.ayato@gmail.com', '08987654321', 'Kamisato Klan,Inazuma City, Inazuma,Teyat'),
(22, '682461942524d_Untitled 04-17-2025 09-16-47.png', 'reva', 'revapacarwonu', '$2y$10$g7BLq1XDON.Q94TTrwdmWOz2d5lU/KXI.nR9nyBeppXmn.GeSXNXq', 'admin', 'satuduatiga@gmail.com', '+629765456789', ''),
(23, '', 'khanza', 'knzdysrd', '$2y$10$QwSBoDgOvs1hzoN5QEF2puoxDy1x6InWp7lOdi8pO79iqPKXJP7ZC', 'user', 'kanzz601@gmail.com', '08251389302', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `donasi_tujuan`
--
ALTER TABLE `donasi_tujuan`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_donasi` (`id_donasi`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_transaksi_metode` (`id_metode`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `donasi_tujuan`
--
ALTER TABLE `donasi_tujuan`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_metode` FOREIGN KEY (`id_metode`) REFERENCES `metode_pembayaran` (`id_metode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_donasi`) REFERENCES `donasi_tujuan` (`id_donasi`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
