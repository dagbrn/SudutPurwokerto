-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 10:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sudutpurwokerto`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_lengkap`, `email`, `username`, `password`, `role`) VALUES
(3, 'Darrell Gibran', 'antbalnive@gmail.com', 'dgibran', '$2y$12$BGEjF/er7L95kxF7Is.pPOlaYO0v6V8ctYRdoO6MAxl6CPqssKQ.C', 'admin'),
(5, 'Ammar Yasin', 'gonz@gmail.com', 'gonz', '$2y$10$/p9tZAWDJjiO01PXVe397e4nzphBrIphZQ4NNUXiYKg8EP2I8JeOK', 'user'),
(7, 'ata', 'ata@gmail.com', 'ata', '$2y$10$vnP0vNSPA8sjcBOd4zZuluO2OrDT3ONERc6efw6BX.F4ACY1d.Ir6', 'user'),
(8, 'ata', 'ata@gmail.com', 'ataa', '$2y$10$wD.BAuHu3V8VYyE0UBZp6e2M0lN9Lsc7N.rAQUpcuW4XaqQXZBXru', 'user'),
(9, 'Athaya Raihan Annafi', 'athaya@gmail.com', 'nfii', '$2y$10$07FU2VBrccpjTLmOmSp93O3mDHXaxDs/HE3G/J.u9QpgMqMZwJa56', 'user'),
(10, 'Andi Supandi', 'andi@gmail.com', 'andi', '$2y$10$fzvKgSNlYx6cUjEklXAaAu5fC5C6SGDvjR4t.Lgd6nQRcbYap6qKq', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(100) NOT NULL,
  `tanggal_event` date NOT NULL,
  `lokasi_event` text NOT NULL,
  `deskripsi_event` text NOT NULL,
  `waktu_event` text NOT NULL,
  `tiket_event` text NOT NULL,
  `socmed_event` varchar(100) NOT NULL,
  `foto_event` varchar(255) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `tanggal_event`, `lokasi_event`, `deskripsi_event`, `waktu_event`, `tiket_event`, `socmed_event`, `foto_event`, `tgl`) VALUES
(2, 'Economic Project', '2024-12-19', 'Gor Satria Purwokerto', 'Economic Project 2024 adalah acara tahunan yang diselenggarakan oleh Mahasiswa Fakultas Ekonomi dan Bisnis Universitas Jenderal Soedirman. Acara ini merupakan platform untuk menyalurkan kreativitas dan kemampuan mahasiswa dalam merancang sebuah event yang menarik dan bermanfaat bagi masyarakat. Dengan tema \"Fun Games Casino,\" Economic Project 2024 menghadirkan nuansa segar dalam hiburan di Kota Purwokerto, sekaligus menjadi sarana untuk menyatukan komunitas, menginspirasi kreativitas, dan mendukung ekonomi lokal dengan menarik wisatawan.', '16:00 WIB - 23.00 WIB', 'Informasi mengenai harga tiket dan cara pembelian akan tersedia di situs resmi acara. Tiket dapat dibeli secara online maupun di lokasi acara.', '@economicproject', '1733680181_download.jpg', '2024-12-09 00:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_postingan` int(11) NOT NULL,
  `type_postingan` enum('kuliner','wisata','event') NOT NULL,
  `id_akun` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_postingan`, `type_postingan`, `id_akun`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 2, 'event', 5, 'Terima kasih informasinya!!', '2024-12-09 18:15:11'),
(2, 102, 'kuliner', 3, 'tes', '2024-12-09 20:12:19'),
(4, 102, 'kuliner', 3, 'Enak sekali makanannya!', '2024-12-09 20:25:48'),
(5, 2, 'wisata', 9, 'Sejuk sekali udara disana!!', '2024-12-09 20:27:56'),
(6, 2, 'event', 9, 'Doakan saya punya gandengan ya ges pas nonton!!!', '2024-12-09 20:28:48'),
(7, 102, 'kuliner', 9, 'Makasih rekomendasinya!!', '2024-12-10 09:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_kuliner`
--

CREATE TABLE `tempat_kuliner` (
  `id_kuliner` int(11) NOT NULL,
  `nama_kuliner` varchar(100) NOT NULL,
  `lokasi_kuliner` varchar(255) NOT NULL,
  `deskripsi_kuliner` text NOT NULL,
  `range_harga` text NOT NULL,
  `menu` text NOT NULL,
  `jam_kuliner` text NOT NULL,
  `foto_kuliner` varchar(255) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_kuliner`
--

INSERT INTO `tempat_kuliner` (`id_kuliner`, `nama_kuliner`, `lokasi_kuliner`, `deskripsi_kuliner`, `range_harga`, `menu`, `jam_kuliner`, `foto_kuliner`, `tgl`) VALUES
(102, 'Umaeh Inyong', 'Jalan Raya Baturraden KM 14, Purwokerto, Jawa Tengah.', 'Rumah makan dengan konsep tradisional yang kental dengan citra rasa Banyumasnya menempati gedung lawas yang masih mempertahankan keasliannya, ditambah dengan perabotan klasik dan beragam menu makanan dan minuman khas dengan nama Banyumasan. Di dalam rumah makan ini pengunjung dapat melihat pajangan oleh-oleh batik, soklat (coklat), dan beberapa mainan klasik yang dapat dibeli. Sedangkan di dalam terdapat beberapa ruang dengan perabotan tradisional berupa meja dan kursi kayu maupun anyaman rotan. Selain itu, di dinding resto juga terdapat bingkai foto lama Kota Purwokerto. Umaeh Inyong cocok untuk berbagai acara seperti pesta, family gathering, arisan, kopdar, reuni, dan lainnya. Menu makanan dan minuman tradisional disini sangat beragam, seperti Lembutan kali serayu, Sega gemblung, Mendoan, Bakmi Gongso, es badeg, es asem jawa, es dawet begalan dan lainnya. Bagi anda pecinta masakan tradisional sangat pas jika berkunjung ke Umaeh Inyong Resto.', 'Rp20.000 - Rp 50.000 per orang.', 'Soto Sokaraja, Nasi Goreng Kampung, Sate Blater, Gecot Tahu', 'Setiap Hari 10.00 - 22.00 WIB.', '1733680084_Umaeh-Inyong-1.jpg', '2024-12-09 00:48:04'),
(103, 'Djago Jowo', 'Jl. Gelora Indah I, Mangunjaya, Purwokerto Lor, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah', 'Restaurant ini memiliki konsep bangunan yang unik dengan model bangunanya berupa joglo tetapi memiliki dekorasi yang mewah. Meskipun bangunanya terlihat kuno dan sangat tradisional, nampaknya tidak berpengaruh pada kualitas masakanya. Restaurant ini memberikan suasana makan seperti jaman dahulu di desa karena suasananya yang begitu santai dan ditambah lagi dengan tempatnya yang nyaman sehingga memberikan kepuasan tersendiri bagi pelanggan yang khususnya berasal dari daerah perkotaan. Restaurant ini menyajikan menu masakan khas pedesaan seperti ayam bakar, ayam goreng, bebek goreng, dan masih banyak lagi. Untuk anda yang menyukai sambal dengan selera pedas, maka restaurant ini sangat bagi anda. Restaurant ini menawarkan aneka sambel berupa sambal terasi, sambal ijo yang sangat nikmat, dan satu lagi sambal bawang. ', 'Rp25.000 - Rp 50.000 per orang.', 'Ayam Kampung Asli (Jago), Sayuran khas kampung, Kopi, Teh', 'Setiap Hari 10.00 - 22.00 WIB.', 'djagojowo.jpg', '2024-12-10 22:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_wisata`
--

CREATE TABLE `tempat_wisata` (
  `id_wisata` int(11) NOT NULL,
  `nama_wisata` varchar(100) NOT NULL,
  `lokasi_wisata` varchar(255) NOT NULL,
  `deskripsi_wisata` text NOT NULL,
  `fasilitas_wisata` text NOT NULL,
  `tiket_wisata` text NOT NULL,
  `jam_wisata` text NOT NULL,
  `foto_wisata` varchar(255) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_wisata`
--

INSERT INTO `tempat_wisata` (`id_wisata`, `nama_wisata`, `lokasi_wisata`, `deskripsi_wisata`, `fasilitas_wisata`, `tiket_wisata`, `jam_wisata`, `foto_wisata`, `tgl`) VALUES
(2, 'Lokawisata Baturraden', 'Jalan Raya Baturraden KM 14, Purwokerto, Jawa Tengah.', 'Lokawisata Baturraden adalah salah satu destinasi wisata unggulan yang terletak di kaki Gunung Slamet. Dengan ketinggian sekitar 640-750 mdpl, kawasan ini menawarkan suasana yang sejuk dan pemandangan alam yang memukau, menjadikannya tempat ideal untuk bersantai dan menikmati keindahan alam.', 'Kolam Renang, Taman Air, Pemandian Air Panas, Spot Foto Intagramable', 'Senin-Jumat Rp20.000 per orang. Sabtu, Minggu, Hari Libur Nasional Rp25.000 per orang.', 'Senin-Jumat, 07.00 - 16.00 WIB. Sabtu-Minggu 07.00-17.00 WIB.', '1733679936_baturraden.jpg', '2024-12-09 00:45:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tempat_kuliner`
--
ALTER TABLE `tempat_kuliner`
  ADD PRIMARY KEY (`id_kuliner`);

--
-- Indexes for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tempat_kuliner`
--
ALTER TABLE `tempat_kuliner`
  MODIFY `id_kuliner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
