-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 16 2017 г., 13:10
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
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_location_lat` varchar(255) NOT NULL,
  `user_location_lng` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `user_id`, `user_name`, `user_location_lat`, `user_location_lng`, `message`, `created_at`) VALUES
(357, 1487187779, 'loh', '', '', 'xc', '2017-02-15 19:55:00'),
(358, 1487189650, 'dmitry', '', '', 'hello', '2017-02-15 20:14:16'),
(360, 1487189650, 'dmitry', '', '', 'awd', '2017-02-15 20:14:58'),
(361, 1487189650, 'dmitry', '', '', '123', '2017-02-15 20:15:07'),
(362, 1487189650, 'dmitry', '48.496690799999996', '32.255707', 'saawd', '2017-02-15 20:15:45'),
(363, 1487189650, 'dmitry', '48.496690799999996', '32.255707', '12343345345', '2017-02-15 20:18:13'),
(364, 1487189650, 'dmitry', '', '', 'cxvxcv', '2017-02-15 20:18:49'),
(365, 1487189650, 'dmitry', '48.496690799999996', '32.255707', 'awdawd', '2017-02-15 20:19:12'),
(367, 1487189650, 'dmitry', '48.496690799999996', '32.255707', 'awdawdaw', '2017-02-15 21:49:18'),
(368, 1486999912, 'dmitry', '', '', 'zxczxc', '2017-02-16 07:09:15'),
(369, 1487229000, 'zxc', '', '', 'asdasdas', '2017-02-16 07:10:28'),
(370, 1487231348, 'parf', '48.506740799999996', '32.2670753', '123', '2017-02-16 08:11:53'),
(371, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'xc', '2017-02-16 08:12:43'),
(372, 1487231348, 'parf', '48.506740799999996', '32.2670753', '1234124124124', '2017-02-16 08:13:35'),
(373, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'zxczxczxc', '2017-02-16 08:14:56'),
(374, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'xxxxxx', '2017-02-16 08:17:50'),
(375, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'hello', '2017-02-16 08:18:17'),
(376, 1487231348, 'parf', '', '', 'awdawdaw', '2017-02-16 08:19:35'),
(377, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'hello', '2017-02-16 08:19:46'),
(378, 1487231348, 'parf', '48.506740799999996', '32.2670753', 's', '2017-02-16 08:21:09'),
(379, 1487231348, 'parf', '48.506740799999996', '32.2670753', 'awdawd', '2017-02-16 08:21:50'),
(380, 1487233324, 'dmitry', '48.506740799999996', '32.2670753', '123', '2017-02-16 09:32:31'),
(381, 1487233324, 'dmitry', '48.506740799999996', '32.2670753', 'awd', '2017-02-16 10:03:47'),
(382, 1487239435, 'loh', '48.506740799999996', '32.2670753', 'hello', '2017-02-16 10:04:50'),
(383, 1487239496, 'dmitry', '48.506740799999996', '32.2670753', 'hello loh', '2017-02-16 10:05:03');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=384;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
