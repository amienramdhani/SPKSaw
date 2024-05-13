-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 04:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu_user`
--

CREATE TABLE `akses_menu_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_menu_user`
--

INSERT INTO `akses_menu_user` (`id`, `role_id`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(7, 1, 19),
(8, 1, 21),
(9, 2, 21),
(10, 1, 24),
(11, 2, 25),
(13, 1, 26),
(14, 1, 27),
(15, 1, 28),
(17, 1, 29),
(18, 3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `cetak`
--

CREATE TABLE `cetak` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_peminatan` int(11) NOT NULL,
  `nama_peminatan` varchar(128) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cetak`
--

INSERT INTO `cetak` (`id`, `id_siswa`, `id_peminatan`, `nama_peminatan`, `nama_siswa`, `asal_sekolah`, `alamat`, `total`) VALUES
(3, 10, 1, 'Software Development', 'Giselle', 'Sekolah Tinggi Seoul ', 'Busan', 100),
(4, 11, 1, 'Software Development', 'Karina', 'Sekolah Tinggi Seoul ', 'Incheon', 93.6),
(5, 13, 1, 'Software Development', 'Ningning', 'Sekolah Tinggi Seoul ', 'Beijing', 97);

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_daftar` varchar(128) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `no_daftar`, `nama_siswa`, `jenis_kelamin`, `asal_sekolah`, `alamat`) VALUES
(10, 'SIS01', 'Giselle', 2, 'Sekolah Tinggi Seoul ', 'Busan'),
(11, 'SIS02', 'Karina', 2, 'Sekolah Tinggi Seoul ', 'Incheon'),
(13, 'SIS03', 'Ningning', 2, 'Sekolah Tinggi Seoul ', 'Beijing');

-- --------------------------------------------------------

--
-- Table structure for table `konversi_nilai`
--

CREATE TABLE `konversi_nilai` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_peminatan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(128) NOT NULL,
  `nama_kriteria` varchar(128) NOT NULL,
  `atribut_kriteria` int(1) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `atribut_kriteria`, `bobot_kriteria`) VALUES
(19, 'C01', 'PWL/PDS/PTS', 1, 17),
(20, 'C02', 'SIGEK/DMW/PLC', 1, 17),
(21, 'C03', 'PML/OBD/MIKRO', 1, 17),
(22, 'C04', 'MPPL/DSD/EMBED', 1, 17),
(23, 'C05', 'SMQ/BDK/ROBOTIC', 1, 17),
(24, 'C06', 'BDL/SOFTC', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_peminatan` int(11) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_user`
--

CREATE TABLE `menu_user` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_user`
--

INSERT INTO `menu_user` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Member'),
(24, 'Data Perhitungan SAW'),
(25, 'Perhitungan SAW');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`) VALUES
(8, 8, 75, 65, 85, 74, 77, 81),
(9, 9, 85, 32, 25, 45, 78, 90),
(10, 10, 85, 95, 75, 45, 45, 99),
(11, 11, 85, 75, 85, 78, 77, 81),
(12, 12, 85, 32, 75, 45, 85, 99),
(13, 13, 85, 32, 75, 78, 45, 85);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_peminatan`
--

CREATE TABLE `nilai_peminatan` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_peminatan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_peminatan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peminatan`
--

CREATE TABLE `peminatan` (
  `id_peminatan` int(11) NOT NULL,
  `nama_peminatan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminatan`
--

INSERT INTO `peminatan` (`id_peminatan`, `nama_peminatan`) VALUES
(1, 'Software Development'),
(2, 'Data Science'),
(3, 'Intelligent Systen Developer ');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_user`
--

CREATE TABLE `submenu_user` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu_user`
--

INSERT INTO `submenu_user` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fa fa-fw fa-home', 1),
(2, 1, 'Data Pengguna', 'admin/pengguna', 'fa fa-fw fa-users', 1),
(3, 2, 'Profil Saya', 'user', 'fa fa-fw fa-user', 1),
(4, 2, 'Edit Profil', 'user/editUser', 'fa fa-fw fa-pencil', 1),
(5, 2, 'Ubah Password', 'user/ubahPassword', 'fa fa-fw fa-key', 1),
(19, 1, 'Role', 'admin/role', 'fa fa-fw fa-cog', 1),
(27, 25, 'Data Mahasiswa', 'pSaw/dataSiswa', 'fa fa-fw fa-child', 1),
(28, 25, 'Nilai Mahasiswa', 'pSaw/nilaiSiswa', 'fa fa-fw fa-check-square-o', 1),
(29, 25, 'Hasil Perhitungan', 'pSaw/hasilSAW', 'fa fa-fw fa-file', 1),
(30, 24, 'Data Peminatan', 'dpSaw/peminatan', 'fa fa-fw fa-random', 1),
(31, 24, 'Data Kriteria', 'dpSaw/kriteria', 'fa fa-fw fa-list-ul', 1),
(41, 25, 'Laporan', 'pSaw/Laporan', 'fa fa-fw fa-bar-chart', 1),
(43, 24, 'Data Nilai Mahasiswa', 'dpSaw/nilai', 'fa fa-fw fa-star', 1),
(44, 2, 'Hasil Rekomendasi', 'pSaw/cetak_nilai', 'fa fa-fw fa-star', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'Admin@admin.com', 'biru.png', '$2y$10$HWsHqijpW2Rog1DfFeDxKu8VH7QavbhobCUa6Hu8Wg4rdiWiCj3zm', 1, 1, '2019-10-10'),
(7, 'Member', 'member@member.com', '1.png', '$2y$10$KOjc8BzTIICti1ojZMyzVOMNd4XuwZNL4nyVBnsaaBRHlAh7KtLxO', 2, 1, '2019-10-10'),
(26, 'Siswa', 'siswa@siswa.com', 'default.png', '$2y$10$eMFPxu3/PKfi9/aV/ZhFX.ZipzJvUbiKhr0q09Zi0eaVhIsF6quU6', 3, 1, '2020-01-02'),
(27, 'murid', 'murid@murid.com', 'default.png', '$2y$10$SN6o2gy3E8zWtyaEJQiqRuIVQFAZbGyexzmea4dRfsLp16mLd4kkG', 2, 1, '2020-06-23'),
(28, 'amien', 'amien123@amien.com', 'default.png', '$2y$10$1VNJ5w09epWt0GGXxw4h.uA1B9l32YmKheiWdFuW943cIyw0GNXAC', 2, 1, '2023-05-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_menu_user`
--
ALTER TABLE `akses_menu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cetak`
--
ALTER TABLE `cetak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `konversi_nilai`
--
ALTER TABLE `konversi_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_user`
--
ALTER TABLE `menu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_peminatan`
--
ALTER TABLE `nilai_peminatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminatan`
--
ALTER TABLE `peminatan`
  ADD PRIMARY KEY (`id_peminatan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu_user`
--
ALTER TABLE `submenu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_menu_user`
--
ALTER TABLE `akses_menu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cetak`
--
ALTER TABLE `cetak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `konversi_nilai`
--
ALTER TABLE `konversi_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_user`
--
ALTER TABLE `menu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai_peminatan`
--
ALTER TABLE `nilai_peminatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminatan`
--
ALTER TABLE `peminatan`
  MODIFY `id_peminatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `submenu_user`
--
ALTER TABLE `submenu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
