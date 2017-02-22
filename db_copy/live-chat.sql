-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 22 2017 г., 22:42
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `live-chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL,
  `user_id_device` varchar(25) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_os` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `devices`
--

INSERT INTO `devices` (`id`, `user_id_device`, `device_type`, `device_os`) VALUES
(1, '1487771635', 'Desktop', 'Windows'),
(2, '1487771821', 'Mobile', 'Android'),
(4, '1487773991', 'Desktop', 'Windows'),
(5, '1487774177', 'Desktop', 'Windows'),
(6, '1487774219', 'Mobile', 'IOS'),
(7, '1487774373', 'Mobile', 'Windows'),
(8, '1487774470', 'Tablet', 'IOS'),
(9, '1487774526', 'Desktop', 'Other'),
(10, '1487774562', 'Desktop', 'Windows'),
(11, '1487790378', 'Desktop', 'Windows');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_location_lat` varchar(255) NOT NULL,
  `user_location_lng` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=476 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user_name`, `user_location_lat`, `user_location_lng`, `message`, `created_at`) VALUES
(461, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'how are you?', '2017-02-20 15:42:49'),
(462, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'i am fine', '2017-02-20 15:42:55'),
(463, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'test', '2017-02-20 15:42:58'),
(464, 1487363359, 'dmitry', '48.50793300000001', '32.262316999999996', 'test from home', '2017-02-20 21:01:09'),
(465, 1487363359, 'dmitry', '48.50793300000001', '32.262316999999996', 'test 1', '2017-02-20 21:01:26'),
(466, 1487363359, 'dmitry', '48.50793300000001', '32.262316999999996', 'test 2', '2017-02-20 21:01:31'),
(467, 1487363359, 'dmitry', '48.50793300000001', '32.262316999999996', 'test 3', '2017-02-20 21:01:35'),
(468, 1487363359, 'dmitry', '48.50793300000001', '32.262316999999996', 'test 4', '2017-02-20 21:01:37'),
(469, 1487662117, 'loh', '48.5067393', '32.2670642', 'test 5', '2017-02-21 07:28:43'),
(470, 1487662117, 'loh', '48.5067393', '32.2670642', 'test 6', '2017-02-21 07:28:46'),
(471, 1487662135, 'parf', '48.5067393', '32.2670642', 'test 7', '2017-02-21 07:29:00'),
(472, 1487662135, 'parf', '48.5067393', '32.2670641', 'test 8', '2017-02-21 08:10:02'),
(473, 1487662135, 'parf', '', '', 'awdawd', '2017-02-21 15:47:02'),
(474, 1487662135, 'parf', '48.506746799999995', '32.2670414', 'test', '2017-02-22 10:29:22'),
(475, 1487662135, 'parf', '48.5067646', '32.2670132', 'test 2', '2017-02-22 13:35:08');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `title`, `meta_keywords`, `meta_description`) VALUES
(1, 'Live chat', 'Live chat', 'live, chat, laravel', 'Live chat');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` enum('admin','moderator') NOT NULL DEFAULT 'moderator',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `permission`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'reflection', 'dmitryparfenov937@gmail.com', '$2y$10$kbcPSfkhZfqoDduQBYZJAONp9atH77m6QvWuX8mAzNgmQHnvnICzi', 'admin', 'gpUiKfJTJPtH6zHoIYACDMmOB3ysuRwtyVrn8q8Nqo4V0IZ4iusxfDrSaSWW', '2017-02-22 07:24:34', '2017-02-22 07:24:34'),
(7, 'moderator user', 'moderator@gmail.com', '$2y$10$oN6UzNFPgOPI44I0enf9cur0SyCygsNxtX4AKdUvK2r80wuhu7cem', 'moderator', 'lYVVjz1m1Vh7imrMHeGOJGa9azMEEgB0RSZJUORgm9IswMAFWsrv6GS6JuYG', '2017-02-22 07:22:18', '2017-02-22 07:22:18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=476;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
