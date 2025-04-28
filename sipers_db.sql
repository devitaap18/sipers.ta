-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2025 at 04:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asets`
--

CREATE TABLE `asets` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_aset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asets`
--

INSERT INTO `asets` (`id`, `nama`, `kode_aset`, `kategori_id`, `stok`, `created_at`, `updated_at`) VALUES
(3, 'Laptop Acer', 'ACER1', 1, 9, '2025-03-08 07:12:37', '2025-04-19 23:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_aset`
--

CREATE TABLE `kategori_aset` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_aset`
--

INSERT INTO `kategori_aset` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'ELK', NULL, NULL),
(2, 'Furnitur', 'FUR', NULL, NULL),
(3, 'Kendaraan', 'KNDRN', NULL, '2025-04-19 23:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_27_124626_create_users_table', 1),
(6, '2025_02_28_132814_create_pengajuan_table', 1),
(7, '2025_03_06_123829_create_kategori_aset_table', 2),
(8, '2025_03_06_125844_create_asets_table', 3),
(9, '2025_03_08_075739_create_pengajuan_asets_table', 4),
(10, '2025_03_08_101630_create_pengajuan_asets_table', 5),
(11, '2025_03_08_142729_create_pengajuan_table', 6),
(12, '2025_03_08_142902_create_pengajuan_asets_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ms_menu`
--

CREATE TABLE `ms_menu` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int UNSIGNED DEFAULT '0',
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ms_menu`
--

INSERT INTO `ms_menu` (`id`, `menu_name`, `url`, `order`, `icon`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Login', '/login', 1, NULL, NULL, NULL, NULL),
(2, 'Logout', '/logout', 2, NULL, NULL, NULL, NULL),
(3, 'Admin Dashboard', '/admin/dashboard', 3, NULL, NULL, NULL, NULL),
(4, 'Admin Pengajuan', '/admin/pengajuan', 4, NULL, NULL, NULL, NULL),
(5, 'Admin Pengajuan Create', '/admin/pengajuan/create', 5, NULL, NULL, NULL, NULL),
(6, 'Admin Pengajuan Store', '/admin/pengajuan/store', 6, NULL, NULL, NULL, NULL),
(7, 'Admin Pengajuan Show', '/admin/pengajuan/{id}', 7, NULL, NULL, NULL, NULL),
(8, 'BPO Dashboard', '/bpo/dashboard', 8, NULL, NULL, NULL, NULL),
(9, 'BPO Kelola Kategori', '/bpo/kelola_kategori', 9, NULL, NULL, NULL, NULL),
(10, 'BPO Kelola Kategori Update', '/bpo/kelola_kategori/update/{id}', 10, NULL, NULL, NULL, NULL),
(11, 'BPO Kelola Aset', '/bpo/kelola_aset', 11, NULL, NULL, NULL, NULL),
(12, 'BPO Kelola Aset Store', '/bpo/kelola_aset/store', 12, NULL, NULL, NULL, NULL),
(13, 'BPO Kelola Aset Update', '/bpo/kelola_aset/update/{id}', 13, NULL, NULL, NULL, NULL),
(14, 'BPO Kelola Aset Destroy', '/bpo/kelola_aset/{id}', 14, NULL, NULL, NULL, NULL),
(15, 'BPO Pengajuan', '/bpo/pengajuan', 15, NULL, NULL, NULL, NULL),
(16, 'BPO Pengajuan Update Status', '/bpo/pengajuan/{id}/update-status', 16, NULL, NULL, NULL, NULL),
(17, 'Superadmin Dashboard', '/superadmin/dashboard', 17, NULL, NULL, NULL, NULL),
(18, 'Superadmin Kelola User', '/superadmin/kelola-user', 18, NULL, NULL, NULL, NULL),
(19, 'Superadmin Kelola User Create', '/superadmin/kelola-user/create', 19, NULL, NULL, NULL, NULL),
(20, 'Superadmin Kelola User Store', '/superadmin/kelola-user/store', 20, NULL, NULL, NULL, NULL),
(21, 'Superadmin Kelola User Edit', '/superadmin/kelola-user/edit', 21, NULL, NULL, NULL, NULL),
(22, 'Superadmin Kelola User Update', '/superadmin/kelola-user/update', 22, NULL, NULL, NULL, NULL),
(23, 'Superadmin Kelola User Destroy', '/superadmin/kelola-user/destroy', 23, NULL, NULL, NULL, NULL),
(24, 'VP Dashboard', '/vp/dashboard', 24, NULL, NULL, NULL, NULL),
(25, 'VP Daftar Ajuan', '/vp/daftar_ajuan', 25, NULL, NULL, NULL, NULL),
(26, 'VP Daftar Ajuan Update Status', '/vp/daftar_ajuan/{id}/update-status', 26, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_role`
--

CREATE TABLE `ms_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ms_role`
--

INSERT INTO `ms_role` (`id`, `role_name`) VALUES
(1, 'admin'),
(3, 'bpo'),
(4, 'superadmin'),
(2, 'vp');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id`, `name`, `username`, `nik`, `company`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Pak Budi', 'budiadmin', '1001', 'Petrokimia Gresik', 1, '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(2, 'Pak Ari', 'arivp', '1002', 'Petrokimia Gresik', 2, '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(3, 'Pak James', 'jamesbpo', '1003', 'Petrokimia Gresik', 3, '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(4, 'Pak Lukman', 'lukmanadmin', '1004', 'Petrokimia Gresik', 1, '2025-03-06 07:34:28', '2025-03-17 23:39:11'),
(5, 'Pak Mada', 'madasuperadmin', '1111', 'Petrokimia Gresik', 4, '2025-03-18 04:36:14', '2025-03-18 04:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `departemen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pemohon` date NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_vp` enum('pending','disetujui','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deskripsi_status_vp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status_bpo` enum('belum diproses','sedang diproses','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `user_id`, `departemen`, `tanggal_pemohon`, `perihal`, `deskripsi`, `status_vp`, `deskripsi_status_vp`, `status_bpo`, `created_at`, `updated_at`) VALUES
(6, 1, 'Manajemen', '2025-04-20', 'Peminjaman laptop', 'pinjam laptop 1', 'disetujui', 'disetujui', 'belum diproses', '2025-04-20 03:29:21', '2025-04-23 18:31:54'),
(7, 1, 'Manajemen', '2025-04-24', 'Peminjaman laptop', 'pinjam laptop 2', 'disetujui', 'disetujui', 'belum diproses', '2025-04-23 18:25:28', '2025-04-23 18:31:46'),
(8, 1, 'Manajemen', '2025-04-28', 'Peminjaman laptop', 'pinjam laptop 1', 'pending', NULL, 'belum diproses', '2025-04-28 08:51:30', '2025-04-28 08:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_aset`
--

CREATE TABLE `pengajuan_aset` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `aset_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_aset`
--

INSERT INTO `pengajuan_aset` (`id`, `pengajuan_id`, `aset_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(7, 6, 3, 1, '2025-04-20 03:29:21', '2025-04-20 03:29:21'),
(8, 7, 3, 2, '2025-04-23 18:25:28', '2025-04-23 18:25:28'),
(9, 8, 3, 1, '2025-04-28 08:51:30', '2025-04-28 08:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `role_id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`role_id`, `menu_id`) VALUES
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(2, 24),
(2, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asets_kode_aset_unique` (`kode_aset`),
  ADD KEY `asets_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `kategori_aset`
--
ALTER TABLE `kategori_aset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_aset_nama_unique` (`nama`),
  ADD UNIQUE KEY `kategori_aset_kode_unique` (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_menu`
--
ALTER TABLE `ms_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_name` (`menu_name`),
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `ms_role`
--
ALTER TABLE `ms_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_aset_pengajuan_id_foreign` (`pengajuan_id`),
  ADD KEY `pengajuan_aset_aset_id_foreign` (`aset_id`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`role_id`,`menu_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asets`
--
ALTER TABLE `asets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_aset`
--
ALTER TABLE `kategori_aset`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ms_menu`
--
ALTER TABLE `ms_menu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ms_role`
--
ALTER TABLE `ms_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asets`
--
ALTER TABLE `asets`
  ADD CONSTRAINT `asets_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_aset` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ms_menu`
--
ALTER TABLE `ms_menu`
  ADD CONSTRAINT `ms_menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `ms_menu` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD CONSTRAINT `ms_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_user` FOREIGN KEY (`user_id`) REFERENCES `ms_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  ADD CONSTRAINT `pengajuan_aset_aset_id_foreign` FOREIGN KEY (`aset_id`) REFERENCES `asets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_aset_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD CONSTRAINT `role_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `ms_menu` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
