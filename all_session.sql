-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 28 2021 г., 13:50
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `opros`
--

-- --------------------------------------------------------

--
-- Структура таблицы `all_session`
--

CREATE TABLE `all_session` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `links` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `all_session`
--

INSERT INTO `all_session` (`id`, `name`, `links`, `status`) VALUES
(1, 'Opros1', 'link1', 1),
(4, 'opros2', 'link2', 1),
(5, 'Полина', 'polina', 1),
(6, 'opros1', 'link1', 1),
(7, 'opros2', 'link2', 1),
(8, 'link1', 'link1', 1),
(9, 'link1', 'link1', 1),
(10, 'link1', 'link1', 1),
(11, 'link1', 'link1', 1),
(12, 'link2', 'link2', 1),
(13, 'link2', 'link2', 1),
(14, 'link2', 'link2', 1),
(15, 'link2', 'link2', 1),
(16, 'link2', 'link2', 1),
(17, 'opros2', 'opros2', 1),
(18, 'Opros3', 'link3', 1),
(19, 'Opros3', 'link3', 1),
(20, 'Opros3', 'link3', 1),
(21, 'Opros3', 'link3', 1),
(22, 'Opros3', 'link3', 1),
(23, 'Opros3', 'link3', 1),
(24, 'Opros3', 'link3', 1),
(25, 'Opros3', 'link3', 1),
(26, 'Opros3', 'link3', 1),
(27, 'Opros3', 'link3', 1),
(28, 'Opros3', 'link3', 1),
(29, 'Opros3', 'link3', 1),
(30, 'Opros3', 'link3', 2),
(33, 'Полина', 'polinalina', 1),
(34, 'Полина', 'polinalina', 1),
(35, 'Полина', 'polinalina', 1),
(36, 'Полина', 'polinalina', 1),
(37, 'Полина', 'polinalina', 1),
(38, 'Полина', 'polinalina', 1),
(39, 'opros13', 'link13', 1),
(40, 'opros13', 'link13', 1),
(41, 'opros13', 'link13', 1),
(42, 'Polina', 'polina', 1),
(43, 'Опрос1', 'o1', 1),
(44, 'Yspech', 'ysp1,ysp2', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `all_session`
--
ALTER TABLE `all_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `all_session`
--
ALTER TABLE `all_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
