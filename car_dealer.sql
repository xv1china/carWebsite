-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 08 2026 г., 09:00
-- Версия сервера: 8.4.7
-- Версия PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `car_dealer`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `username`, `PASSWORD`) VALUES
(1, 'admin', '$2y$10$yYb4GrTALB00rQp3VH2ONOIeUXGIEAPbHRx/Cr4bDQMLBIoHQ696C');

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title_ka` text COLLATE utf8mb4_general_ci,
  `title_en` text COLLATE utf8mb4_general_ci,
  `title_ru` text COLLATE utf8mb4_general_ci,
  `content_ka` longtext COLLATE utf8mb4_general_ci,
  `content_en` longtext COLLATE utf8mb4_general_ci,
  `content_ru` longtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `image`, `created_at`, `title_ka`, `title_en`, `title_ru`, `content_ka`, `content_en`, `content_ru`) VALUES
(1, 'ტრაილერის როლი ტვირთის უსაფრთხო და ეფექტურ გადაზიდვაში', 'ტრაქის ტრაილერი წარმოადგენს სატვირთო გადაზიდვების ერთ-ერთ ყველაზე მნიშვნელოვან ელემენტს. სწორედ ტრაილერის ტიპი და კონსტრუქცია განსაზღვრავს, რამდენად უსაფრთხოდ, სწრაფად და ეფექტურად მოხდება ტვირთის ტრანსპორტირება. სხვადასხვა ტიპის ტრაილერი გამოიყენება განსხვავებული ტვირთისთვის — იქნება ეს კონტეინერი, მძიმე ტექნიკა, თხევადი მასალა თუ სწრაფად ფუჭებადი პროდუქტი.', 'blog_697a4a4f4924d8.26217056.jpg', '2026-01-28 17:41:35', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ახალი ლინკოლნი ვიყიდეთ', 'იუიბცუწბ უოიცბწეუცბ იოცბო8იიეცნქეო ც ცუობქეციუქეოც ცუობექოუცბქ ცუოქებეცოუქე უოცბქეუიც უ8იცქბცე', 'blog_697a4c648c9dc0.11564487.jpg', '2026-01-28 17:50:28', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'ტორენ ტო კაი ქალაქიქ', 'ოყყაებვპიაე აუიწბცოაწჰ უიცბაწოჰჰც  ციუბნწცუწბც ეცოი[ჰსა98  ნნციო[ებც ბჰუე9სცბნუეი იიმტირონრ ი ნაოიცნ ციე0ცოიანც აპოცნუოიაეაც ორ9ი9 დ ცაიმდა იე ნრპო', 'blog_697a4cd73d4723.61366931.jpg', '2026-01-28 17:52:23', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `YEAR` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `fuel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gearbox` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('available','sold') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `title`, `brand`, `model`, `YEAR`, `price`, `fuel`, `gearbox`, `mileage`, `description`, `status`, `created_at`) VALUES
(5, 'f90', 'm5', 'f10', 1029, 45678, 'დიზელი', 'ავტომატიკა', 134000, 'kai manqanaa Zmao', 'available', '2026-01-28 18:02:44'),
(2, 'volvo 123', 'volov', 'samsung 34', 2023, 65, 'დიზელი', 'ავტომატიკა', 134532, 'kargi manqanaa', 'available', '2026-01-27 20:20:12'),
(3, 'porshe', 'porshe', '911', 2025, 560000, 'დიზელი', 'ავტომატიკა', 12, 'auper', 'available', '2026-01-27 20:20:58'),
(4, 'mbw 345', 'bmw', 'f10', 2015, 12564, 'ბენზინი', 'ავტომატიკა', 123456, 'magari maSina mrata', 'available', '2026-01-27 21:11:49');

-- --------------------------------------------------------

--
-- Структура таблицы `car_images`
--

DROP TABLE IF EXISTS `car_images`;
CREATE TABLE IF NOT EXISTS `car_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `image`) VALUES
(1, 3, 'car_69791e2aa699f4.41815535.jpg'),
(2, 4, 'car_69792a151608e0.64816171.jpg'),
(3, 5, 'car_697a4f443afea9.15716549.jpg'),
(4, 1, 'car_69878126847175.53485348.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `car_main`
--

DROP TABLE IF EXISTS `car_main`;
CREATE TABLE IF NOT EXISTS `car_main` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `fuel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gearbox` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('available','sold') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title_ka` text COLLATE utf8mb4_general_ci,
  `title_en` text COLLATE utf8mb4_general_ci,
  `title_ru` text COLLATE utf8mb4_general_ci,
  `description_ka` longtext COLLATE utf8mb4_general_ci,
  `description_en` longtext COLLATE utf8mb4_general_ci,
  `description_ru` longtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_main`
--

INSERT INTO `car_main` (`id`, `title`, `brand`, `model`, `year`, `price`, `fuel`, `gearbox`, `mileage`, `description`, `status`, `created_at`, `title_ka`, `title_en`, `title_ru`, `description_ka`, `description_en`, `description_ru`) VALUES
(1, 'daf euro 6', 'daf', 'daf 34', 2222, 22000, 'დიზელი', 'ავტომატიკა', 548900, 'kai manqana', 'available', '2026-02-07 18:15:02', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `car_main_images`
--

DROP TABLE IF EXISTS `car_main_images`;
CREATE TABLE IF NOT EXISTS `car_main_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title_ka` text COLLATE utf8mb4_unicode_ci,
  `title_en` text COLLATE utf8mb4_unicode_ci,
  `title_ru` text COLLATE utf8mb4_unicode_ci,
  `description_ka` longtext COLLATE utf8mb4_unicode_ci,
  `description_en` longtext COLLATE utf8mb4_unicode_ci,
  `description_ru` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`, `title_ka`, `title_en`, `title_ru`, `description_ka`, `description_en`, `description_ru`) VALUES
(1, 'truck1', 'ravui ra', 'gallery_697e7c7cb8c2c9.70146102.jpg', 'active', '2026-02-01 02:04:44', '2026-02-01 02:04:44', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `car_main_images`
--
ALTER TABLE `car_main_images`
  ADD CONSTRAINT `fk_car_main_images_car` FOREIGN KEY (`car_id`) REFERENCES `car_main` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
