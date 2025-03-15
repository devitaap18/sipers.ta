-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2025 at 04:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_aset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asets`
--

INSERT INTO `asets` (`id`, `nama`, `kode_aset`, `kategori_id`, `stok`, `created_at`, `updated_at`) VALUES
(3, 'Laptop Acer', 'ACER1', 1, 9, '2025-03-08 07:12:37', '2025-03-09 08:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_aset`
--

CREATE TABLE `kategori_aset` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_aset`
--

INSERT INTO `kategori_aset` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'ELK', NULL, NULL),
(2, 'Furnitur', 'FUR', NULL, NULL),
(3, 'Kendaraan', 'KND', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `departemen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pemohon` date NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_vp` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deskripsi_status_vp` text COLLATE utf8mb4_unicode_ci,
  `status_bpo` enum('belum diproses','sedang diproses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `user_id`, `departemen`, `tanggal_pemohon`, `perihal`, `deskripsi`, `status_vp`, `deskripsi_status_vp`, `status_bpo`, `created_at`, `updated_at`) VALUES
(5, 1, 'Manajemen', '2025-03-09', 'Peminjaman laptop', 'pinjam laptop acer 1', 'disetujui', 'ya disetujui', 'selesai', '2025-03-09 08:51:58', '2025-03-09 08:53:17');

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
(6, 5, 3, 1, '2025-03-09 08:51:58', '2025-03-09 08:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','vp','bpo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `nik`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Pak Budi', 'budiadmin', '1001', 'admin', '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(2, 'Pak Ari', 'arivp', '1002', 'vp', '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(3, 'Pak James', 'jamesbpo', '1003', 'bpo', '2025-03-05 05:43:29', '2025-03-05 05:43:29'),
(4, 'Pak Lukman', 'lukmanadmin', '1004', 'admin', '2025-03-06 07:34:28', '2025-03-06 07:34:28');

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

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
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asets`
--
ALTER TABLE `asets`
  ADD CONSTRAINT `asets_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_aset` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  ADD CONSTRAINT `pengajuan_aset_aset_id_foreign` FOREIGN KEY (`aset_id`) REFERENCES `asets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_aset_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
