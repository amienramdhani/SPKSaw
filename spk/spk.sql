-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2020 pada 15.11
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `akses_menu_user`
--

CREATE TABLE `akses_menu_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akses_menu_user`
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
-- Struktur dari tabel `cetak`
--

CREATE TABLE `cetak` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(128) NOT NULL,
  `no_daftar` int(11) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
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
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `no_daftar`, `nama_siswa`, `jenis_kelamin`, `asal_sekolah`, `alamat`) VALUES
(1, 'SIS01', 'Udin', 1, 'SMP 1', 'Yogyakarta'),
(2, 'SIS02', 'Yuni', 2, 'SMP 1', 'Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Teknik Permesinan'),
(2, 'Teknik Pengelasan'),
(3, 'Teknik Kendaraan Ringan'),
(4, 'Teknik Perbaikan Bodi Kendaraan'),
(5, 'Teknik Mekatronika'),
(6, 'Rekayasa Perangkat Lunak'),
(7, 'Teknik Jaringan Komputer'),
(8, 'Multimedia'),
(9, 'Perbankan'),
(10, 'Teknik Ototronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konversi_nilai`
--

CREATE TABLE `konversi_nilai` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL,
  `C7` int(11) NOT NULL,
  `C8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(128) NOT NULL,
  `nama_kriteria` varchar(128) NOT NULL,
  `atribut_kriteria` int(1) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `atribut_kriteria`, `bobot_kriteria`) VALUES
(1, 'C1', 'Nilai MTK', 1, 13),
(2, 'C2', 'Nilai IPA', 1, 13),
(3, 'C3', 'Nilai Bahasa Indonesia', 1, 12),
(4, 'C4', 'Nilai Bahasa Inggris', 1, 12),
(5, 'C5', 'Nilai Tes Fisik', 1, 10),
(6, 'C6', 'Nilai Tes Psikologi', 1, 10),
(7, 'C7', 'Nilai Tes wawancara', 1, 10),
(8, 'C8', 'Tes Tulis', 1, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `no_daftar` int(11) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `id_siswa`, `id_jurusan`, `no_daftar`, `nama_siswa`, `asal_sekolah`, `alamat`, `total`) VALUES
(1, 1, 0, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(2, 1, 1, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(3, 1, 2, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(4, 1, 3, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(5, 1, 4, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(6, 1, 5, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(7, 1, 6, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(8, 1, 7, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(9, 1, 8, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(10, 1, 9, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(11, 1, 10, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(12, 1, 1, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(13, 1, 2, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(14, 1, 3, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(15, 1, 4, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(16, 1, 5, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(17, 1, 6, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(18, 1, 7, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(19, 1, 8, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(20, 1, 9, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(21, 1, 10, 0, 'Udin', 'SMP 1', 'Yogyakarta', 100),
(22, 2, 1, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 100),
(23, 2, 2, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 93.75),
(24, 2, 3, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 95),
(25, 2, 4, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 92.75),
(26, 2, 5, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 87.15),
(27, 2, 6, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 89.75),
(28, 2, 7, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 96),
(29, 2, 8, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 100),
(30, 2, 9, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 93.75),
(31, 2, 10, 0, 'Yuni', 'SMP 1', 'Yogyakarta', 97.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_user`
--

CREATE TABLE `menu_user` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_user`
--

INSERT INTO `menu_user` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Member'),
(24, 'Data Perhitungan SAW'),
(25, 'Perhitungan SAW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL,
  `C7` int(11) NOT NULL,
  `C8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`) VALUES
(1, 1, 56, 67, 80, 72, 78, 70, 75, 70),
(2, 2, 80, 90, 70, 65, 90, 95, 98, 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_jurusan`
--

CREATE TABLE `nilai_jurusan` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL,
  `C7` int(11) NOT NULL,
  `C8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL,
  `C6` int(11) NOT NULL,
  `C7` int(11) NOT NULL,
  `C8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu_user`
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
-- Dumping data untuk tabel `submenu_user`
--

INSERT INTO `submenu_user` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fa fa-fw fa-home', 1),
(2, 1, 'Data Pengguna', 'admin/pengguna', 'fa fa-fw fa-users', 1),
(3, 2, 'Profil Saya', 'user', 'fa fa-fw fa-user', 1),
(4, 2, 'Edit Profil', 'user/editUser', 'fa fa-fw fa-pencil', 1),
(5, 2, 'Ubah Password', 'user/ubahPassword', 'fa fa-fw fa-key', 1),
(19, 1, 'Role', 'admin/role', 'fa fa-fw fa-cog', 1),
(27, 25, 'Data Siswa', 'pSaw/dataSiswa', 'fa fa-fw fa-child', 1),
(28, 25, 'Nilai Siswa', 'pSaw/nilaiSiswa', 'fa fa-fw fa-check-square-o', 1),
(29, 25, 'Hasil Perhitungan', 'pSaw/hasilSAW', 'fa fa-fw fa-file', 1),
(30, 24, 'Data Jurusan', 'dpSaw/jurusan', 'fa fa-fw fa-random', 1),
(31, 24, 'Data Kriteria', 'dpSaw/kriteria', 'fa fa-fw fa-list-ul', 1),
(41, 25, 'Laporan', 'pSaw/Laporan', 'fa fa-fw fa-bar-chart', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'Admin@admin.com', 'biru.png', '$2y$10$HWsHqijpW2Rog1DfFeDxKu8VH7QavbhobCUa6Hu8Wg4rdiWiCj3zm', 1, 1, '2019-10-10'),
(7, 'Member', 'member@member.com', '1.png', '$2y$10$KOjc8BzTIICti1ojZMyzVOMNd4XuwZNL4nyVBnsaaBRHlAh7KtLxO', 2, 1, '2019-10-10'),
(26, 'Siswa', 'siswa@siswa.com', 'default.png', '$2y$10$eMFPxu3/PKfi9/aV/ZhFX.ZipzJvUbiKhr0q09Zi0eaVhIsF6quU6', 3, 1, '2020-01-02'),
(27, 'murid', 'murid@murid.com', 'default.png', '$2y$10$SN6o2gy3E8zWtyaEJQiqRuIVQFAZbGyexzmea4dRfsLp16mLd4kkG', 2, 1, '2020-06-23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses_menu_user`
--
ALTER TABLE `akses_menu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cetak`
--
ALTER TABLE `cetak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `konversi_nilai`
--
ALTER TABLE `konversi_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_user`
--
ALTER TABLE `menu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_jurusan`
--
ALTER TABLE `nilai_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu_user`
--
ALTER TABLE `submenu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses_menu_user`
--
ALTER TABLE `akses_menu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `cetak`
--
ALTER TABLE `cetak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `konversi_nilai`
--
ALTER TABLE `konversi_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `menu_user`
--
ALTER TABLE `menu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nilai_jurusan`
--
ALTER TABLE `nilai_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `submenu_user`
--
ALTER TABLE `submenu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
