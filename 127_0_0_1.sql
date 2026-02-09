-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 09 2026 г., 17:46
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
CREATE DATABASE IF NOT EXISTS `car_dealer` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `car_dealer`;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `image`) VALUES
(1, 3, 'car_69791e2aa699f4.41815535.jpg'),
(2, 4, 'car_69792a151608e0.64816171.jpg'),
(3, 5, 'car_697a4f443afea9.15716549.jpg'),
(4, 1, 'car_69878126847175.53485348.jpg'),
(5, 2, 'car_6988aef1552763.06794155.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_main`
--

INSERT INTO `car_main` (`id`, `title`, `brand`, `model`, `year`, `price`, `fuel`, `gearbox`, `mileage`, `description`, `status`, `created_at`, `title_ka`, `title_en`, `title_ru`, `description_ka`, `description_en`, `description_ru`) VALUES
(3, 'daf 14', 'daf', 'auro 6', 2020, 340000, 'დიზელი', 'მექანიკა', 340000, 'magari mankana', 'available', '2026-02-08 15:47:56', 'daf 14', 'daf 14', 'daf 14', 'magari mankana', 'magari mankana', 'magari mankana'),
(4, 'vfv', 'fvfv', 'fvfv', 345345, 23452, 'ელექტრო', 'მექანიკა', 4435235, 'k\'ndvkean vj vai nvrianenvri n ipinavo voipoWNWVIOR', 'available', '2026-02-08 20:10:36', 'vfv', 'vfv', 'vfv', 'k\'ndvkean vj vai nvrianenvri n ipinavo voipoWNWVIOR', 'k\'ndvkean vj vai nvrianenvri n ipinavo voipoWNWVIOR', 'k\'ndvkean vj vai nvrianenvri n ipinavo voipoWNWVIOR'),
(5, 'OIBVOI', 'votka', '4545', 3434, 34543, 'ბენზინი', 'ავტომატიკა', 9494949, 'adkjdr voaenveojnv', 'available', '2026-02-08 20:11:45', 'OIBVOI', 'OIBVOI', 'OIBVOI', 'adkjdr voaenveojnv', 'adkjdr voaenveojnv', 'adkjdr voaenveojnv'),
(6, '34545', 'dfvdfv', 'fh16', 2022, 85000, 'ბენზინი', 'ავტომატიკა', 120000, 'oaubcoiuwbcoiwbc  wuocnwi0c ouiwenciw couiiWBCCHw', 'available', '2026-02-08 20:13:16', '34545', '34545', '34545', 'oaubcoiuwbcoiwbc  wuocnwi0c ouiwenciw couiiWBCCHw', 'oaubcoiuwbcoiwbc  wuocnwi0c ouiwenciw couiiWBCCHw', 'oaubcoiuwbcoiwbc  wuocnwi0c ouiwenciw couiiWBCCHw');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_main_images`
--

INSERT INTO `car_main_images` (`id`, `car_id`, `image_path`, `is_main`, `sort_order`, `created_at`, `image`) VALUES
(1, 3, '', 0, 0, '2026-02-08 15:55:46', 'car_6988b2020190a7.37178798.jpg'),
(2, 4, '', 0, 0, '2026-02-08 20:10:36', 'car_6988edbcc44d79.41644396.jpg'),
(3, 5, '', 0, 0, '2026-02-08 20:11:45', 'car_6988ee01a3d740.46377843.png'),
(4, 5, '', 0, 0, '2026-02-08 20:11:45', 'car_6988ee01a50a07.84739357.png'),
(5, 5, '', 0, 0, '2026-02-08 20:11:45', 'car_6988ee01a5eed5.61449586.jpg'),
(6, 6, '', 0, 0, '2026-02-08 20:13:16', 'car_6988ee5cedd7d2.76339422.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`, `title_ka`, `title_en`, `title_ru`, `description_ka`, `description_en`, `description_ru`) VALUES
(2, NULL, NULL, 'gallery_698a10c25fed32.80471709.webp', 'active', '2026-02-09 20:52:18', '2026-02-09 20:52:18', NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, 'gallery_698a1125755662.01227020.webp', 'active', '2026-02-09 20:53:57', '2026-02-09 20:53:57', NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, 'gallery_698a112c507422.54355542.webp', 'active', '2026-02-09 20:54:04', '2026-02-09 20:54:04', NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, 'gallery_698a11341ea5e9.38849623.webp', 'active', '2026-02-09 20:54:12', '2026-02-09 20:54:12', NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, 'gallery_698a115c496490.60528271.webp', 'active', '2026-02-09 20:54:52', '2026-02-09 20:54:52', NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, 'gallery_698a116472a811.74894959.webp', 'active', '2026-02-09 20:55:00', '2026-02-09 20:55:00', NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, 'gallery_698a116c86aab0.25719157.webp', 'active', '2026-02-09 20:55:08', '2026-02-09 20:55:08', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `car_main_images`
--
ALTER TABLE `car_main_images`
  ADD CONSTRAINT `fk_car_main_images_car` FOREIGN KEY (`car_id`) REFERENCES `car_main` (`id`) ON DELETE CASCADE;
--
-- База данных: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Структура таблицы `myguests`
--

DROP TABLE IF EXISTS `myguests`;
CREATE TABLE IF NOT EXISTS `myguests` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `userstable`
--

DROP TABLE IF EXISTS `userstable`;
CREATE TABLE IF NOT EXISTS `userstable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `userstable`
--

INSERT INTO `userstable` (`id`, `name`, `email`, `created_at`) VALUES
(1, 'პაკო', '0000-00-00', '0000-00-00'),
(2, 'John Doe', '0000-00-00', '2025-01-01'),
(3, 'fdg', '0000-00-00', '0000-00-00'),
(4, 'ბონდო', '0000-00-00', '0000-00-00'),
(5, 'ბებო', '0000-00-00', '0000-00-00'),
(6, 'გრიშა ონიანი', '0000-00-00', '0000-00-00'),
(47, 'gege', 'gege@gmail.com', '0000-00-00'),
(46, 'gege', 'gege@gmail.com', '0000-00-00'),
(45, 'gege', 'gege@gmail.com', '0000-00-00'),
(44, 'gege', 'gege@gmail.com', '0000-00-00'),
(43, 'gege', 'gege@gmail.com', '0000-00-00');
--
-- База данных: `usertable`
--
CREATE DATABASE IF NOT EXISTS `usertable` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `usertable`;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userName` text COLLATE utf8mb4_general_ci NOT NULL,
  `Email` text COLLATE utf8mb4_general_ci NOT NULL,
  `Password` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `userName`, `Email`, `Password`) VALUES
(1, 'oto', 'oto@gmail.com', 'oto12123123'),
(2, '', '', ''),
(3, 'oto', 'oto@gmail.com', 'oto12123123'),
(4, 'xv1cha', 'xvcha23@gmail.com', 'xv1cha1974'),
(5, '', '', ''),
(6, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(9, '123', 'otogg2008@gmail.com', '123123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
