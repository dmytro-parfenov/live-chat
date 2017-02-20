-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 20 2017 г., 16:17
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
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user_name`, `user_location_lat`, `user_location_lng`, `message`, `created_at`) VALUES
(434, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '2', '2017-02-16 12:45:10'),
(435, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '3', '2017-02-16 12:45:12'),
(436, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '4', '2017-02-16 12:45:14'),
(438, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '6', '2017-02-16 12:45:18'),
(439, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '7', '2017-02-16 12:48:02'),
(440, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '8', '2017-02-16 12:48:04'),
(442, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '0', '2017-02-16 12:48:07'),
(443, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '11', '2017-02-16 12:48:10'),
(445, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '13', '2017-02-16 12:48:13'),
(446, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '14', '2017-02-16 12:48:14'),
(447, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '15', '2017-02-16 12:48:16'),
(448, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '16', '2017-02-16 12:48:18'),
(449, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '17', '2017-02-16 12:48:20'),
(450, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '18', '2017-02-16 12:48:22'),
(451, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '19', '2017-02-16 12:48:24'),
(452, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '20', '2017-02-16 12:48:27'),
(453, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '21', '2017-02-16 12:48:28'),
(454, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '22', '2017-02-16 12:48:31'),
(455, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', '23', '2017-02-16 12:48:33'),
(456, 1487252427, 'dmitry', '', '', 'hello', '2017-02-16 13:40:43'),
(457, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'zxczx\\', '2017-02-20 09:52:14'),
(458, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'zxc', '2017-02-20 09:52:28'),
(459, 1487239496, 'dmitry', '48.5067393', '32.2670642', 'zxc', '2017-02-20 09:52:51');

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
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`) VALUES
(1, 'reflection', 'dmitryparfenov937@gmail.com', '$2y$10$3nO5xewTFGm1cxVWFU0.I.v0XFA77IuBuMPcypnmn2tp8CzGYlj7y', NULL);

--
-- Индексы сохранённых таблиц
--

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
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=460;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
