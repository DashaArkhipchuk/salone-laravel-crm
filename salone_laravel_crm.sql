-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 04 2024 г., 18:48
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `salone_laravel_crm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE `addresses` (
  `id` int NOT NULL,
  `salon_id` int DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `salon_id`, `region`, `district`, `city`, `street`, `created_at`, `updated_at`) VALUES
(4, 3, 'Ukraine', 'Zhytomyr region', 'Zhytomyr', 'Pokrovska', '2024-02-11 16:35:52', '2024-02-16 08:23:06'),
(5, 1, 'Odesa Oblast', 'Odesa District', 'Odesa', 'Primorska Street, 11', '2024-02-16 16:44:54', '2024-03-02 13:38:51'),
(12, 22, 'Kyiv Oblast', 'Shevchenkivskyi', 'Kyiv', 'Main Street 1', '2024-02-18 11:43:21', '2024-02-18 11:50:05'),
(16, 23, 'Kyiv Oblast', 'Kyiv', 'Kyiv', 'Main Street 123', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(17, 24, 'Lviv Oblast', 'Lviv', 'Lviv', 'Fashion Avenue 45', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(18, 25, 'Kharkiv Oblast', 'Kharkiv', 'Kharkiv', 'Elegance Lane 678', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(19, 26, 'Odesa Oblast', 'Odesa', 'Odesa', 'Sea View Boulevard 789', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(20, 27, 'Dnipropetrovsk Oblast', 'Dnipro', 'Dnipro', 'Urban Plaza 101', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(21, 28, 'Kyiv Oblast', 'Kyiv', 'Kyiv', 'Royal Avenue 234', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(22, 29, 'Lviv Oblast', 'Lviv', 'Lviv', 'Nature Street 567', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(23, 30, 'Kharkiv Oblast', 'Kharkiv', 'Kharkiv', 'Crimson Road 890', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(24, 31, 'Odesa Oblast', 'Odesa', 'Odesa', 'Sapphire Street 123', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(26, 33, 'Île-de-France', 'Paris', 'Paris', 'Champs-Élysées 789', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(27, 34, 'New York', 'Manhattan', 'New York', 'Fashion Street 456', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(28, 35, 'Tokyo', 'Chiyoda', 'Tokyo', 'Tranquility Road 101', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(29, 36, 'London', 'Westminster', 'London', 'Style Lane 234', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(30, 37, 'New South Wales', 'Sydney', 'Sydney', 'Radiance Avenue 567', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(31, 38, 'Florida', 'Miami Beach', 'Miami Beach', 'Bliss Boulevard 890', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(33, 40, 'Dubai', 'Dubai', 'Dubai', 'Glamour Lane 456', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(34, 41, 'Rio de Janeiro', 'Rio de Janeiro', 'Rio de Janeiro', 'Radiance Road 789', '2024-02-26 16:38:20', '2024-02-26 16:38:20'),
(35, 42, 'Seoul', 'Jung', 'Seoul', 'Chic Avenue 012', '2024-02-26 16:38:20', '2024-02-26 16:38:20');

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `service_id` int NOT NULL,
  `stylist_id` int NOT NULL,
  `salon_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `service_id`, `stylist_id`, `salon_id`, `schedule_id`, `created_at`, `updated_at`) VALUES
(24, 6, 15, 14, 1, 16, '2024-03-02 12:46:38', '2024-03-02 12:46:38'),
(25, 7, 15, 13, 1, 9, '2024-03-02 13:53:03', '2024-03-02 13:53:03'),
(27, 6, 15, 13, 3, 20, '2024-03-04 08:30:36', '2024-03-04 08:30:36');

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(3) NOT NULL,
  `value` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `value`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', '1.0000', '2024-02-11 20:43:41', '2024-02-11 20:43:41'),
(3, 'Ukrainian Hryvnia', 'UAH', '30.0500', '2024-02-11 20:15:31', '2024-02-11 20:15:31');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `contact_phone`, `contact_email`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'Petro', 'Petrenko', '0641223546', 'petro.petrenko@example.com', 16, '2024-03-01 13:27:12', '2024-03-01 13:27:12'),
(6, 'Customer', 'Customerovych', '0607773456', 'customer.customerovych@example.com', 18, '2024-03-01 14:35:17', '2024-03-01 14:42:58'),
(7, 'Client', 'Clientovych', '1234563344', 'client.clientovych@example.com', 19, '2024-03-01 14:57:10', '2024-03-01 14:57:10');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE `filters` (
  `id` int NOT NULL,
  `filter_name` varchar(100) NOT NULL,
  `service_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `managers`
--

CREATE TABLE `managers` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `managers`
--

INSERT INTO `managers` (`id`, `first_name`, `last_name`, `contact_phone`, `contact_email`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Ivan', 'Petrenko', '0501112233', 'ivan.petrenko@example.com', 11, '2024-02-27 15:40:11', '2024-02-27 18:59:53');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `currency_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `service_id` int NOT NULL,
  `stylist_id` int NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`id`, `currency_id`, `customer_id`, `service_id`, `stylist_id`, `value`, `created_at`, `updated_at`) VALUES
(9, 1, 5, 17, 14, '150.00', '2024-03-02 14:56:02', '2024-03-02 14:56:02'),
(10, 1, 6, 20, 15, '500.00', '2024-03-02 14:56:19', '2024-03-02 14:56:19'),
(11, 3, 5, 19, 16, '2000.00', '2024-03-02 14:56:38', '2024-03-02 14:56:38'),
(12, 1, 6, 15, 14, '300.00', '2024-03-02 14:57:12', '2024-03-02 14:57:12'),
(13, 3, 7, 18, 16, '1500.00', '2024-03-02 14:57:31', '2024-03-02 14:57:31'),
(14, 1, 7, 15, 13, '215.00', '2024-03-02 14:57:54', '2024-03-02 14:57:54'),
(15, 3, 7, 17, 13, '300.99', '2024-03-02 14:58:09', '2024-03-02 14:58:09');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
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
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `id` int NOT NULL,
  `stylist_id` int NOT NULL,
  `service_id` int NOT NULL,
  `currency_id` int DEFAULT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`id`, `stylist_id`, `service_id`, `currency_id`, `value`, `created_at`, `updated_at`) VALUES
(17, 14, 15, 3, '500.80', '2024-03-02 12:15:19', '2024-03-02 12:15:19'),
(19, 15, 15, 1, '70.90', '2024-03-02 12:16:57', '2024-03-02 12:16:57'),
(20, 13, 15, 3, '150.00', '2024-03-02 12:17:14', '2024-03-02 12:42:54'),
(23, 13, 17, 1, '100.50', '2024-03-02 14:50:13', '2024-03-02 14:50:13'),
(24, 15, 17, 3, '400.99', '2024-03-02 14:51:20', '2024-03-02 14:51:20'),
(25, 16, 18, 3, '1500.00', '2024-03-02 14:51:38', '2024-03-02 14:51:38'),
(26, 13, 18, 1, '455.90', '2024-03-02 14:52:19', '2024-03-02 14:52:19'),
(27, 14, 19, 3, '2000.00', '2024-03-02 14:52:37', '2024-03-02 14:52:37'),
(28, 15, 20, 1, '100.99', '2024-03-02 14:52:59', '2024-03-02 14:52:59');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-02-16 13:11:52', '2024-02-16 13:11:52'),
(2, 'Manager', '2024-02-16 13:11:52', '2024-02-16 13:11:52'),
(3, 'Stylist', '2024-02-16 13:12:41', '2024-02-16 13:12:41'),
(4, 'Customer', '2024-02-16 13:12:41', '2024-02-16 13:12:41');

-- --------------------------------------------------------

--
-- Структура таблицы `salons`
--

CREATE TABLE `salons` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `salons`
--

INSERT INTO `salons` (`id`, `name`, `description`, `contact_phone`, `contact_email`, `created_at`, `updated_at`) VALUES
(1, 'Salon new', 'New salon', '0633333334', 'admin@gmail.com', '2024-02-11 13:24:17', '2024-02-28 14:59:55'),
(3, 'Admin salon', 'Admin runs the salon', '3333333333', 'admin@mail.com', '2024-02-12 15:19:54', '2024-02-12 15:20:36'),
(22, 'Hairdresser`s hut', 'Hairdresser', '0637428888', 'hairdresser@gmail.com', '2024-02-18 11:43:21', '2024-02-18 11:43:21'),
(23, 'Elegance & Grace Salon', 'Upscale Salon in Kyiv offering top-notch beauty services.', '+380501234567', 'info@elegancegracesalon.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(24, 'Charm & Style Studio', 'Trendy Salon in Lviv specializing in modern hair and makeup trends.', '+380502345678', 'info@charmandstylestudio.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(25, 'Golden Touch Spa', 'Luxurious Spa in Kharkiv providing a wide range of beauty treatments.', '+380503456789', 'info@goldentouchspa.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(26, 'Divine Beauty Lounge', 'Chic Salon in Odessa with a focus on personalized beauty solutions.', '+380504567890', 'info@divinebeautylounge.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(27, 'Urban Glow Salon', 'Modern Salon in Dnipro offering cutting-edge hair and skincare services.', '+380505678901', 'info@urbanglowsalon.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(28, 'Royal Retreat Spa', 'Opulent Spa in Kyiv known for its regal ambiance and pampering services.', '+380506789012', 'info@royalretreatspa.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(29, 'Nature`s Haven Salon', 'Eco-friendly Salon in Lviv promoting natural and organic beauty products.', '+380507890123', 'info@natures-haven.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(30, 'Crimson Beauty Lounge', 'Sleek Salon in Kharkiv with a focus on modern haircuts and vibrant colors.', '+380508901234', 'info@crimsonbeautylounge.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(31, 'Sapphire Spa Oasis', 'Tranquil Spa in Odessa offering a serene escape with holistic wellness services.', '+380509012345', 'info@sapphirespaoasis.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(33, 'Parisian Glamour Spa', 'Luxury Spa in Paris providing an exquisite and relaxing experience.', '+33 6 1234 5678', 'info@parisianglamour.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(34, 'Manhattan Chic Hair Lounge', 'Fashionable Hair Lounge in New York specializing in runway-inspired looks.', '+1 212-345-6789', 'info@manhattanchic.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(35, 'Tokyo Tranquility Salon', 'Zen-inspired Salon in Tokyo offering a serene beauty experience.', '+81 3-4567-8901', 'info@tokyotranquilitysalon.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(36, 'London Style Collective', 'Stylish Salon in London known for its diverse range of beauty services.', '+44 20 1234 5678', 'info@londonstylecollective.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(37, 'Sydney Radiance Spa', 'Radiant Spa in Sydney providing rejuvenating beauty treatments.', '+61 2 3456 7890', 'info@sydneyradiance.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(38, 'Miami Beach Bliss Salon', 'Tropical Salon in Miami Beach offering beach-inspired beauty services.', '+1 305-678-9012', 'info@miamibeachbliss.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(40, 'Dubai Glam Haven', 'Glamorous Salon in Dubai known for its opulence and high-end services.', '+971 4 567 8901', 'info@dubaiglamhaven.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(41, 'Rio de Janeiro Radiance Spa', 'Vibrant Spa in Rio de Janeiro offering lively beauty experiences.', '+55 21 7890 1234', 'info@riodejaneiroradiance.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07'),
(42, 'Seoul Chic Salon', 'Chic Salon in Seoul combining K-beauty trends with global styles.', '+82 2-3456-7890', 'info@seoulchicsalon.com', '2024-02-26 16:36:07', '2024-02-26 16:36:07');

-- --------------------------------------------------------

--
-- Структура таблицы `salons_managers`
--

CREATE TABLE `salons_managers` (
  `id` int NOT NULL,
  `salon_id` int NOT NULL,
  `manager_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `salons_managers`
--

INSERT INTO `salons_managers` (`id`, `salon_id`, `manager_id`) VALUES
(19, 1, 11),
(20, 3, 11),
(21, 22, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `salons_stylists`
--

CREATE TABLE `salons_stylists` (
  `id` int NOT NULL,
  `salon_id` int NOT NULL,
  `stylist_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `salons_stylists`
--

INSERT INTO `salons_stylists` (`id`, `salon_id`, `stylist_id`) VALUES
(18, 1, 13),
(19, 3, 13),
(20, 22, 13),
(21, 1, 14),
(22, 22, 14),
(23, 23, 14),
(24, 3, 15),
(25, 22, 15),
(26, 23, 15),
(27, 3, 16),
(28, 22, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `salon_id` int NOT NULL,
  `stylist_id` int NOT NULL,
  `date` date NOT NULL,
  `start_hour` int NOT NULL,
  `end_hour` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `schedules`
--

INSERT INTO `schedules` (`id`, `salon_id`, `stylist_id`, `date`, `start_hour`, `end_hour`, `created_at`, `updated_at`) VALUES
(9, 1, 13, '2024-03-01', 13, 14, '2024-03-01 10:12:03', '2024-03-01 14:08:12'),
(10, 3, 15, '2024-03-01', 14, 15, '2024-03-01 10:12:28', '2024-03-01 10:12:28'),
(11, 3, 13, '2024-03-02', 8, 9, '2024-03-01 11:24:05', '2024-03-01 11:24:05'),
(12, 1, 13, '2024-03-02', 10, 11, '2024-03-01 11:27:47', '2024-03-01 11:27:47'),
(15, 3, 16, '2024-03-03', 12, 13, '2024-03-01 14:01:49', '2024-03-01 14:01:49'),
(16, 1, 14, '2024-03-03', 14, 15, '2024-03-01 15:43:47', '2024-03-01 15:43:55'),
(17, 22, 14, '2024-03-05', 8, 9, '2024-03-02 13:55:51', '2024-03-02 13:55:51'),
(18, 1, 14, '2024-03-06', 10, 11, '2024-03-02 13:56:07', '2024-03-02 13:56:07'),
(19, 1, 14, '2024-03-05', 15, 16, '2024-03-02 13:56:32', '2024-03-02 13:56:32'),
(20, 3, 13, '2024-03-06', 6, 7, '2024-03-02 13:57:46', '2024-03-02 13:57:46'),
(21, 1, 13, '2024-03-05', 8, 9, '2024-03-02 13:58:03', '2024-03-02 13:58:03'),
(22, 1, 13, '2024-03-06', 18, 19, '2024-03-02 13:58:48', '2024-03-02 13:58:48'),
(23, 3, 15, '2024-03-06', 12, 13, '2024-03-02 14:54:02', '2024-03-02 14:54:02'),
(24, 22, 15, '2024-03-08', 11, 12, '2024-03-02 14:54:22', '2024-03-02 14:54:22'),
(25, 3, 15, '2024-03-06', 14, 15, '2024-03-02 14:54:36', '2024-03-02 14:54:36');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price_id`, `created_at`, `updated_at`) VALUES
(15, 'Hair Care', 'Hair care description', NULL, '2024-03-02 10:51:40', '2024-03-02 10:51:49'),
(17, 'Haircut', 'Professional hair cutting service', NULL, '2024-03-02 17:48:32', '2024-03-02 17:48:32'),
(18, 'Hair Color', 'Expert hair coloring service', NULL, '2024-03-02 17:48:32', '2024-03-02 17:48:32'),
(19, 'Hairstyling', 'Creative hairstyling service', NULL, '2024-03-02 17:48:32', '2024-03-02 17:48:32'),
(20, 'Hair Extensions', 'Quality hair extension service', NULL, '2024-03-02 17:48:32', '2024-03-02 17:48:32'),
(21, 'Hair Repair', 'Hair repair description', NULL, '2024-03-04 11:44:12', '2024-03-04 11:44:12');

-- --------------------------------------------------------

--
-- Структура таблицы `stylists`
--

CREATE TABLE `stylists` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `stylists`
--

INSERT INTO `stylists` (`id`, `first_name`, `last_name`, `contact_phone`, `contact_email`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 'Oksana', 'Ivanenko', '0501234567', 'oksana.ivanenko@example.com', 13, '2024-03-01 09:34:04', '2024-03-01 09:36:20'),
(14, 'Andriy', 'Petrenko', '0672345678', 'andriy.petrenko@example.com', 14, '2024-03-01 09:40:49', '2024-03-01 09:40:49'),
(15, 'Kateryna', 'Kovalenko', '0503456789', 'kateryna.kovalenko@example.com', 15, '2024-03-01 09:41:43', '2024-03-01 09:41:43'),
(16, 'Yulia', 'Ostapenko', '1234563311', 'yulia.ostapenko@example.com', 17, '2024-03-01 13:57:41', '2024-03-01 13:57:41');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 1, 'admin', 'admin@email.com', NULL, '$2y$12$npxnhOKNbCaRLx68DjTMdOYd3NlTMxeofeh9IUKHTNxzkqCwZMcF6', NULL, '2024-02-16 10:27:46', '2024-02-16 10:27:46'),
(5, 2, 'manager', 'manager@gmail.com', NULL, '$2y$12$Th0KKxiJJ28r0PT6r6xgcuTDpQLpGa5Cle1w0bgk8EtaqLENyr2OC', NULL, '2024-02-16 10:47:42', '2024-02-16 10:47:42'),
(6, 1, 'Admin', 'admin@mail.com', NULL, '$2y$12$WVcv10EPSaEZJYwk1bmnAeZmtR.ZH5sVGVs4sWxFQSsFbnJJjHZ0q', NULL, '2024-02-23 06:43:17', '2024-02-23 06:43:17'),
(7, 2, 'maager', 'manager@email.com', NULL, '$2y$12$JqsZ6qTrs71/K2FS65gZdeEWjbeuuuREQgfEcH2V2i8k2PpjU3DY6', NULL, '2024-02-26 15:06:39', '2024-02-26 15:06:39'),
(11, 2, 'IvanPetrenko', 'ivan.petrenko@example.com', NULL, '$2y$12$VsHKkVRFrfl..Wqd1JKu1OVDQ1axyYuu83djrTMVwkChTdSLikKS6', NULL, '2024-02-27 15:36:02', '2024-02-27 15:36:02'),
(13, 3, 'OksanaIvanenko', 'oksana.ivanenko@example.com', NULL, '$2y$12$a291MlH/2jmElxH4ocmSw.x4StOFRUvqA0lzjO5OYvQlf8LoPNqHa', NULL, '2024-03-01 09:32:48', '2024-03-01 09:32:48'),
(14, 3, 'AndriyPetrenko', 'andriy.petrenko@example.com', NULL, '$2y$12$Dk1mAjopisr0QCKSmjawVuvsqkjDvXXRCB4cHahOyym/j3cdIt14O', NULL, '2024-03-01 09:38:01', '2024-03-01 09:38:01'),
(15, 3, 'KaterynaKovalenko', 'kateryna.kovalenko@example.com', NULL, '$2y$12$Rr.gZWVgE3./9W1s7oFVnuzzNabRTeM4E9b/PGhCdI21xXxi9ZYB2', NULL, '2024-03-01 09:39:46', '2024-03-01 09:39:46'),
(16, 4, 'PetroPetrenko', 'petro.petrenko@example.com', NULL, '$2y$12$DpA6aWqCTloL53ueTX0iauFGmq.2q7bic3jR0mawZAvSJMxThG6dS', NULL, '2024-03-01 13:26:24', '2024-03-01 13:26:24'),
(17, 3, 'YuliaOstapenko', 'yulia.ostapenko@example.com', NULL, '$2y$12$OWJ1BKT8S7Zgz.VOJQc5IOzFoBKCGHxFYNl9nXzF2W3laBnHXVQhy', NULL, '2024-03-01 13:56:22', '2024-03-01 13:56:22'),
(18, 4, 'CustomerCustomerovych', 'customer.customerovych@example.com', NULL, '$2y$12$pE2vhW3hMFeBWHjaWPsABOIjrL4ZN.o27XLAiyEhfN9EJnJ5xvjiO', NULL, '2024-03-01 14:42:48', '2024-03-01 14:42:48'),
(19, 4, 'ClientClientovych', 'client.clientovych@example.com', NULL, '$2y$12$ZyXdSF0R2DfU3BK8cP7P7OpmENKKdNKiWKtch7nngIFd6MxqhCMGm', NULL, '2024-03-01 14:57:10', '2024-03-01 14:57:10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_ibfk_1` (`user_id`),
  ADD KEY `accounts_ibfk_2` (`role_id`);

--
-- Индексы таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_ibfk_1` (`salon_id`);

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_ibfk_1` (`customer_id`),
  ADD KEY `appointments_ibfk_2` (`service_id`),
  ADD KEY `appointments_ibfk_3` (`stylist_id`),
  ADD KEY `appointments_ibfk_4` (`salon_id`),
  ADD KEY `appointments_ibfk_5` (`schedule_id`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filters_ibfk_1` (`service_id`);

--
-- Индексы таблицы `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_ibfk_1` (`currency_id`),
  ADD KEY `payments_ibfk_2` (`customer_id`),
  ADD KEY `payments_ibfk_3` (`service_id`),
  ADD KEY `payments_ibfk_4` (`stylist_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_ibfk_1` (`currency_id`),
  ADD KEY `stylist_id` (`stylist_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `salons_managers`
--
ALTER TABLE `salons_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salon_id` (`salon_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Индексы таблицы `salons_stylists`
--
ALTER TABLE `salons_stylists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salon_id` (`salon_id`),
  ADD KEY `stylist_id` (`stylist_id`);

--
-- Индексы таблицы `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_ibfk_1` (`salon_id`),
  ADD KEY `schedules_ibfk_2` (`stylist_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_id` (`price_id`);

--
-- Индексы таблицы `stylists`
--
ALTER TABLE `stylists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `salons`
--
ALTER TABLE `salons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `salons_managers`
--
ALTER TABLE `salons_managers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `salons_stylists`
--
ALTER TABLE `salons_stylists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `stylists`
--
ALTER TABLE `stylists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_5` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filters`
--
ALTER TABLE `filters`
  ADD CONSTRAINT `filters_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `salons_managers`
--
ALTER TABLE `salons_managers`
  ADD CONSTRAINT `salons_managers_ibfk_1` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salons_managers_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `salons_stylists`
--
ALTER TABLE `salons_stylists`
  ADD CONSTRAINT `salons_stylists_ibfk_1` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salons_stylists_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `stylists`
--
ALTER TABLE `stylists`
  ADD CONSTRAINT `stylists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
