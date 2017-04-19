-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 19 2017 г., 20:36
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nsign`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ingridients`
--

CREATE TABLE IF NOT EXISTS `ingridients` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingridients`
--

INSERT INTO `ingridients` (`id`, `name`, `reg_date`, `active`) VALUES
(1, 'Помидоры', '2017-04-19 14:19:41', 1),
(2, 'Огурцы', '2017-04-19 14:19:49', 1),
(3, 'Кабачки', '2017-04-19 14:19:59', 1),
(4, 'кунжут', '2017-04-19 15:43:03', 0),
(5, 'сосисочки', '2017-04-19 15:43:13', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ingridients_for_products`
--

CREATE TABLE IF NOT EXISTS `ingridients_for_products` (
  `id` int(11) NOT NULL,
  `ingridient_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingridients_for_products`
--

INSERT INTO `ingridients_for_products` (`id`, `ingridient_id`, `product_id`) VALUES
(16, 5, 2),
(17, 4, 2),
(18, 3, 2),
(19, 2, 2),
(20, 1, 2),
(21, 2, 1),
(22, 1, 1),
(28, 3, 3),
(29, 2, 3),
(30, 5, 5),
(31, 2, 5),
(32, 1, 5),
(33, 5, 4),
(34, 4, 4),
(35, 3, 4),
(36, 2, 4),
(37, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1492621273),
('m170419_165816_products', 1492621277);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `reg_date`, `active`) VALUES
(3, 'третье блюдо', '2017-04-19 15:54:32', 1),
(4, 'Четвертое блюдо', '2017-04-19 15:54:44', 1),
(5, 'второе блюдо', '2017-04-19 16:33:58', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ingridients`
--
ALTER TABLE `ingridients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ingridients_for_products`
--
ALTER TABLE `ingridients_for_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ingridients`
--
ALTER TABLE `ingridients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `ingridients_for_products`
--
ALTER TABLE `ingridients_for_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
