-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2024 pada 11.58
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblsprafif`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 2, 12500, '2024-06-09 19:21:58', '2024-06-09 21:24:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `image_profile`, `email`, `password`, `phone`, `address1`, `address2`, `address3`, `created_at`, `updated_at`) VALUES
(1, 'Rafif', 'storage/profile/profile_1717848010.jpg', 'rafif123@gmail.com', '$2y$12$E0wS0n1NUveNr.Z4l0aAM.JbwoSE6VtySP1alybhWp6IYD/FFlkR.', '12345678', 'Cilebut bumi pertiwi blok e no 3-5,kabupaten bogor jawabarat', NULL, NULL, '2024-06-03 09:16:46', '2024-06-09 23:18:43'),
(2, 'Jamal', NULL, 'jamal@gmail.com', '$2y$12$LUIXhuvUOFzWMYTScDsh8e2Qr1KfPuGyQ5vtJVZHcHuh2eFhGjixe', '12345678', 'Jl. SwadayaKecamatan Bojonggede, Kabupaten Bogor, Jawa Barat\r\n', NULL, NULL, '2024-06-03 09:16:46', '2024-06-03 09:16:46'),
(3, 'iqiqaH', NULL, 'haqiqi@gmail.com', '$2y$12$hK7f6EekQHNp7hf43O7nXe3IUhiMZqmOzCLcxPVqqHpjjX2u5LdBO', '12345', 'Villa Bogor Indah 5. Villa Bogor Indah 5, Jl. Kedung Halang, 26, Jawa Barat, ID.', NULL, NULL, '2024-06-08 20:17:51', '2024-06-08 20:17:51'),
(5, 'Doni', NULL, 'd@gmail.com', '$2y$12$WosPMd1BkPPDEclPYvi2M.mPSolHRzkeCZDf8GhWiBE6eQJSX96K2', '626546', 'Karadenan', NULL, NULL, '2024-06-10 02:30:05', '2024-06-10 02:30:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_date` datetime NOT NULL,
  `tracking_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `deliveries`
--

INSERT INTO `deliveries` (`id`, `order_id`, `shipping_date`, `tracking_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 16449192652756, '2024-06-04 11:17:58', '20240604-041758-1124', 'Diterima', '2024-06-03 21:17:58', '2024-06-08 21:17:03'),
(2, 12263219495737, '2024-06-04 12:11:59', '20240604-051159-9456', 'Dikirim', '2024-06-03 22:11:59', '2024-06-03 22:11:59'),
(3, 2943335982140, '2024-06-09 10:21:32', '20240609-032132-6470', 'Diterima', '2024-06-08 20:21:32', '2024-06-08 20:37:47'),
(4, 12633805462329, '2024-06-09 11:15:51', '20240609-041551-8208', 'Diterima', '2024-06-08 21:15:51', '2024-06-08 23:56:30'),
(5, 17298557224949, '2024-06-09 11:16:47', '20240609-041647-3375', 'Menunggu Konfirmasi', '2024-06-08 21:16:47', '2024-06-08 21:16:47'),
(6, 2702835519165, '2024-06-10 16:33:05', '20240610-093305-8574', 'Diterima', '2024-06-10 02:33:05', '2024-06-10 02:39:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `discounts`
--

INSERT INTO `discounts` (`id`, `product_id`, `start_date`, `end_date`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 9, '2024-06-08 12:00:00', '2024-06-12 12:00:00', 15, '2024-06-09 19:14:38', '2024-06-09 19:14:38'),
(2, 7, '2024-06-01 12:00:00', '2024-06-18 12:00:00', 20, '2024-06-09 19:14:53', '2024-06-09 19:14:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_19_024949_product_categories', 1),
(7, '2024_03_19_025110_products', 1),
(8, '2024_03_19_025124_customers', 1),
(9, '2024_03_19_025133_orders', 1),
(10, '2024_03_19_025143_order_details', 1),
(11, '2024_03_19_025152_payments', 1),
(12, '2024_03_19_025203_deliveries', 1),
(13, '2024_03_19_025231_product_reviews', 1),
(14, '2024_03_19_025242_wishlists', 1),
(15, '2024_03_19_042556_discounts', 1),
(16, '2024_05_08_071746_carts', 1),
(17, '2024_05_30_062649_suppliers', 1),
(18, '2024_05_30_062724_purchase_transactions', 1),
(19, '2024_06_08_132822_add_transactions_date_to_purchase_transactions_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shipping_cost`, `total_amount`, `status`, `order_date`, `created_at`, `updated_at`) VALUES
(2702835519165, 5, '48000', 173000, 'Paid', '2024-06-10 16:31:43', '2024-06-10 02:31:44', '2024-06-10 02:33:05'),
(2943335982140, 3, '25000', 87500, 'Paid', '2024-06-09 10:20:57', '2024-06-08 20:20:57', '2024-06-08 20:21:32'),
(9954099534483, 1, '25000', 37500, 'Unpaid', '2024-06-10 09:31:21', '2024-06-09 19:31:22', '2024-06-09 19:31:22'),
(12263219495737, 2, '38000', 50500, 'Paid', '2024-06-04 12:11:18', '2024-06-03 22:11:19', '2024-06-03 22:11:59'),
(12633805462329, 1, '14000', 26500, 'Paid', '2024-06-09 11:14:54', '2024-06-08 21:14:54', '2024-06-08 21:15:34'),
(16449192652756, 1, '49000', 61500, 'Paid', '2024-07-10 10:42:17', '2024-06-03 20:42:18', '2024-06-03 21:17:58'),
(17298557224949, 1, '25000', 37500, 'Paid', '2024-06-04 20:04:41', '2024-06-04 06:04:41', '2024-06-08 21:16:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_details`
--

INSERT INTO `order_details` (`product_id`, `order_id`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 16449192652756, 1, 61500, '2024-06-03 21:17:58', '2024-06-03 21:17:58'),
(2, 12263219495737, 1, 50500, '2024-06-03 22:11:59', '2024-06-03 22:11:59'),
(1, 2943335982140, 1, 87500, '2024-06-08 20:21:32', '2024-06-08 20:21:32'),
(3, 2943335982140, 1, 87500, '2024-06-08 20:21:32', '2024-06-08 20:21:32'),
(2, 12633805462329, 1, 26500, '2024-06-08 21:15:51', '2024-06-08 21:15:51'),
(3, 2702835519165, 2, 173000, '2024-06-10 02:33:05', '2024-06-10 02:33:05'),
(1, 2702835519165, 2, 173000, '2024-06-10 02:33:05', '2024-06-10 02:33:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stok_quantity` int(11) NOT NULL,
  `image1_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image2_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image5_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `product_name`, `description`, `price`, `stok_quantity`, `image1_url`, `image2_url`, `image3_url`, `image4_url`, `image5_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Anggur Hijau', 'Segarkan hari Anda dengan anggur hijau yang manis, renyah, dan penuh nutrisi. Pilihan sempurna untuk camilan sehat atau tambahan segar pada hidangan favorit Anda.', 12500, 13, 'storage/products/product_1_1727776560.png', 'storage/products/product_2_1717432115.jpg', '', '', '', '2024-06-03 09:17:21', '2024-10-01 02:56:00'),
(2, 1, 'Tomat', 'Nikmati kesegaran tomat organik kami, dipetik langsung dari kebun tanpa bahan kimia. Sempurna untuk menambah cita rasa dan nutrisi pada setiap hidangan.', 12500, 199, 'storage/products/product_1_1717432047.jpg', '', '', '', '', '2024-06-03 09:27:27', '2024-06-09 18:40:03'),
(3, 4, 'Yuzu Orange', 'jeruk yuzu khas jepang', 50000, 23, 'storage/products/product_1_1717653988.jpeg', '', '', '', '', '2024-06-05 23:06:28', '2024-06-10 02:33:05'),
(4, 4, 'Jeruk Florida', 'khas amerika', 30000, 50, 'storage/products/product_1_1717656114.jpeg', '', '', '', '', '2024-06-05 23:41:54', '2024-06-09 22:44:06'),
(5, 2, 'Brokoli', 'brokoli kribo', 10000, 55, 'storage/products/product_1_1717656252.jpg', 'storage/products/product_2_1717656252.jpg', '', '', '', '2024-06-05 23:44:12', '2024-06-09 22:44:23'),
(6, 1, 'Buah Naga', 'Segarkan hari Anda dengan buah naga organik kami yang manis dan kaya akan antioksidan. Pilihan sempurna untuk camilan sehat dan peningkat energi alami.', 15000, 12, 'storage/products/product_1_1717983756.jpeg', '', '', '', '', '2024-06-09 18:42:36', '2024-06-09 22:44:42'),
(7, 1, 'Apricot', 'Nikmati aprikot organik kami yang lezat dan kaya akan vitamin. Pilihan sempurna untuk camilan sehat atau tambahan nutrisi pada hidangan favorit Anda.', 20000, 90, 'storage/products/product_1_1717983907.jpg', 'storage/products/product_2_1717983907.jpg', '', '', '', '2024-06-09 18:45:07', '2024-06-09 22:45:03'),
(8, 1, 'Pisang', 'pisang dari kebon abah', 7000, 22, 'storage/products/product_1_1717983941.jpg', '', '', '', '', '2024-06-09 18:45:41', '2024-06-09 22:45:36'),
(9, 2, 'Pak choy', 'pak choy organik cihuyy', 17000, 99, 'storage/products/product_1_1717984085.jpeg', '', '', '', '', '2024-06-09 18:48:05', '2024-06-09 22:46:38'),
(10, 2, 'Kentang', 'kentang jombang', 6000, 45, 'storage/products/product_1_1717984223.jpg', '', '', '', '', '2024-06-09 18:50:23', '2024-06-09 22:47:06'),
(11, 2, 'Wortel', 'wortel omega', 9000, 60000, 'storage/products/product_1_1717984448.jpeg', '', '', '', '', '2024-06-09 18:54:08', '2024-06-09 22:47:37'),
(12, 4, 'Melon yubari jepang', 'melon khas jepang', 40000, 55, 'storage/products/product_1_1717984811.jpeg', '', '', '', '', '2024-06-09 19:00:11', '2024-06-09 22:47:57'),
(13, 4, 'Strawberry jepang', 'strawberry putih khas jepang', 35000, 80, 'storage/products/product_1_1717985307.jpeg', 'storage/products/product_2_1717985045.jpeg', '', '', '', '2024-06-09 19:01:38', '2024-06-09 22:48:17'),
(14, 4, 'Apel Australia', 'apel hijau khas australia', 19000, 55, 'storage/products/product_1_1717985572.jpeg', '', '', '', '', '2024-06-09 19:12:52', '2024-06-09 22:48:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Fruits', '2024-06-03 09:16:59', '2024-06-05 20:44:55'),
(2, 'Vegetables', '2024-06-05 23:00:34', '2024-06-05 23:00:34'),
(4, 'Import', '2024-06-05 23:02:50', '2024-06-05 23:02:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `customer_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(5, 3, 1, 5, 'wenaknyooo', '2024-06-08 21:06:30', '2024-06-08 21:06:30'),
(6, 3, 3, 3, 'asem cik', '2024-06-08 21:06:43', '2024-06-08 21:06:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_transactions`
--

CREATE TABLE `purchase_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `transactions_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchase_transactions`
--

INSERT INTO `purchase_transactions` (`id`, `product_id`, `supplier_id`, `quantity`, `total_price`, `transactions_date`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 200, 200000, '2024-06-08', '2024-06-03 21:53:07', '2024-06-03 21:53:07'),
(3, 1, 1, 15, 500000, '2022-06-18', '2024-06-05 21:11:58', '2024-06-08 06:38:37'),
(5, 3, 1, 25, 25000, '2024-06-10', '2024-06-09 22:43:40', '2024-06-09 22:43:40'),
(6, 4, 2, 50, 125000, '2024-06-19', '2024-06-09 22:44:06', '2024-06-09 22:44:06'),
(7, 5, 1, 55, 90000, '2024-06-04', '2024-06-09 22:44:23', '2024-06-09 22:44:23'),
(8, 6, 2, 12, 125000, '2024-06-03', '2024-06-09 22:44:42', '2024-06-09 22:44:42'),
(9, 7, 1, 90, 50, '2024-06-11', '2024-06-09 22:45:03', '2024-06-09 22:45:03'),
(10, 8, 2, 22, 124000, '2024-06-10', '2024-06-09 22:45:36', '2024-06-09 22:45:36'),
(11, 9, 2, 99, 800000, '2024-06-18', '2024-06-09 22:46:38', '2024-06-09 22:46:38'),
(12, 10, 2, 45, 125000, '2024-06-17', '2024-06-09 22:47:06', '2024-06-09 22:47:06'),
(13, 11, 2, 60000, 45000, '2024-06-25', '2024-06-09 22:47:37', '2024-06-09 22:47:37'),
(14, 12, 1, 55, 250000, '2024-06-30', '2024-06-09 22:47:57', '2024-06-09 22:47:57'),
(15, 13, 1, 80, 75000, '2024-06-18', '2024-06-09 22:48:17', '2024-06-09 22:48:17'),
(16, 14, 1, 55, 99000, '2024-06-30', '2024-06-09 22:48:34', '2024-06-09 22:48:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT INDOFRESH', 'indofresh@gmail.com', '12345', 'jalaln aksks', '2024-06-03 09:29:50', '2024-06-03 09:29:50'),
(2, 'Organic Indo', 'organik@gmail.com', '12345', 'asd', '2024-06-09 06:54:14', '2024-06-09 06:54:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Owner','Admin','Manager','Employee','Courier') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin-Rafif', 'admin@gmail.com', NULL, '$2y$12$yR.C/gpEuBMRTI24h8qgv.8Cl7kNLYyc.4BdGkcOvtbgc2xVxjxJK', 'Admin', NULL, '2024-06-03 09:16:49', '2024-06-03 09:16:49'),
(2, 'Manager-Fawwaz', 'manager@gmail.com', NULL, '$2y$12$JhibJXHadw57/NXB6GWY/.O/W2uPiP7m3WoFXX8Mk6lF2TVjlz1ZC', 'Manager', NULL, '2024-06-03 09:16:49', '2024-06-03 09:16:49'),
(3, 'Owner-RafifFZ', 'owner@gmail.com', NULL, '$2y$12$ivSPvnPnJIG8m1FUMbmMbur0ES4fqJF72U.q1a1Wfqp/Hr7QHnb4W', 'Owner', NULL, '2024-06-03 09:16:50', '2024-06-03 09:16:50'),
(4, 'Employee-FZ', 'employee@gmail.com', NULL, '$2y$12$Zsy.GSgW5dI0QmaeG0WfxuLWPBN0cFcyoXErY1r2hv3qJd71aWJa6', 'Employee', NULL, '2024-06-03 09:16:50', '2024-06-03 09:16:50'),
(5, 'Courier-JAMAL', 'courier@gmail.com', NULL, '$2y$12$AFGXY6e0bQ28akqvIIKx2O5k9IqwEFQkyM5yCRvek9eKuav7iMf8u', 'Courier', NULL, '2024-06-03 09:16:50', '2024-06-03 09:16:50');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vwproducts`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vwproducts` (
`product_category_id` varchar(255)
,`product_name` varchar(100)
,`description` text
,`price` int(11)
,`stok_quantity` int(11)
,`image1_url` varchar(255)
,`image2_url` varchar(255)
,`image3_url` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wishlists`
--

INSERT INTO `wishlists` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 5, 3, '2024-06-10 02:30:25', '2024-06-10 02:30:25'),
(2, 5, 1, '2024-06-10 02:30:44', '2024-06-10 02:30:44');

-- --------------------------------------------------------

--
-- Struktur untuk view `vwproducts`
--
DROP TABLE IF EXISTS `vwproducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwproducts`  AS SELECT `c`.`category_name` AS `product_category_id`, `p`.`product_name` AS `product_name`, `p`.`description` AS `description`, `p`.`price` AS `price`, `p`.`stok_quantity` AS `stok_quantity`, `p`.`image1_url` AS `image1_url`, `p`.`image2_url` AS `image2_url`, `p`.`image3_url` AS `image3_url` FROM (`products` `p` join `product_categories` `c` on(`p`.`product_category_id` = `c`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_customer_id_foreign` (`customer_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_category_name_unique` (`category_name`);

--
-- Indeks untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_customer_id_foreign` (`customer_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_transactions_product_id_foreign` (`product_id`),
  ADD KEY `purchase_transactions_supplier_id_foreign` (`supplier_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_customer_id_foreign` (`customer_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17298557224950;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  ADD CONSTRAINT `purchase_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_transactions_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
