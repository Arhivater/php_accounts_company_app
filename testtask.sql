-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 08 2023 г., 11:54
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testtask`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `email`, `company_id`, `position`) VALUES
(82, 'FirstName1', 'LastName1', 'email1@gmail.com', 18, 'test_position_1'),
(89, 'FirstName2', 'LastName2', 'email2@gmail.com', 21, 'test_position_4'),
(92, 't1', 't1', 't1@email.com', 22, 'position_t1'),
(93, 't2', 't2', 't2@email.com', 23, 'position_t2'),
(94, 't3', 't3', 't3@email.com', 24, 'position_t3'),
(95, 't4', 't4', 't4@email.com', 25, 'position_t4'),
(96, 't5', 't5', 't5@email.com', 26, 'position_t5'),
(97, 't6', 't6', 't6@email.com', 27, 'position_t6'),
(98, 't7', 't7', 't7@email.com', 28, 'position_t7'),
(99, 't8', 't8', 't8@email.com', 29, 'position_t8'),
(100, 't9', 't9', 't9@email.com', 30, 'position_t9'),
(101, 't10', 't10', 't10@email.com', 31, 'position_t10'),
(102, 't11', 't11', 't11@email.com', 32, 'position_t11'),
(103, 't12', 't12', 't12@email.com', 33, 'position_t12');

-- --------------------------------------------------------

--
-- Структура таблицы `client_phones`
--

CREATE TABLE `client_phones` (
  `phone_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `client_phones`
--

INSERT INTO `client_phones` (`phone_id`, `client_id`, `phone_number`) VALUES
(163, 82, '+70000000101'),
(164, 82, '+70000000102'),
(165, 82, '+70000000103'),
(184, 89, '+70000000001'),
(185, 89, '+70000000002'),
(186, 89, '+70000000003'),
(193, 92, '+70000000301'),
(194, 92, '+70000000302'),
(195, 92, '+70000000303'),
(196, 93, '+70000000401'),
(197, 93, '+70000000402'),
(198, 93, '+70000000403'),
(199, 94, '+70000000501'),
(200, 94, '+70000000502'),
(201, 94, '+70000000503'),
(202, 95, '+70000000601'),
(203, 95, '+70000000602'),
(204, 95, '+70000000603'),
(205, 96, '+70000000701'),
(206, 96, '+70000000702'),
(207, 96, '+70000000703'),
(208, 97, '+70000000801'),
(209, 97, '+70000000802'),
(210, 97, '+70000000803'),
(211, 98, '+70000000901'),
(212, 98, '+70000000902'),
(213, 98, '+70000000903'),
(214, 99, '+70000001001'),
(215, 99, '+70000001002'),
(216, 99, '+70000001003'),
(217, 100, '+70000001101'),
(218, 100, '+70000001102'),
(219, 100, '+70000001103'),
(220, 101, '+70000001201'),
(221, 101, '+70000001202'),
(222, 101, '+70000001203'),
(223, 102, '+70000001301'),
(224, 102, '+70000001302'),
(225, 102, '+70000001303'),
(226, 103, '+70000001401'),
(227, 103, '+70000001402'),
(228, 103, '+70000001403');

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`) VALUES
(18, 'test_company_1'),
(19, 'test_company_2'),
(20, 'test_company_3'),
(21, 'test_company_4'),
(22, 'company_t1'),
(23, 'company_t2'),
(24, 'company_t3'),
(25, 'company_t4'),
(26, 'company_t5'),
(27, 'company_t6'),
(28, 'company_t7'),
(29, 'company_t8'),
(30, 'company_t9'),
(31, 'company_t10'),
(32, 'company_t11'),
(33, 'company_t12'),
(34, 'company_t13'),
(35, 'company_t14'),
(36, 'company_t15'),
(37, 'company_t16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Индексы таблицы `client_phones`
--
ALTER TABLE `client_phones`
  ADD PRIMARY KEY (`phone_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT для таблицы `client_phones`
--
ALTER TABLE `client_phones`
  MODIFY `phone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Ограничения внешнего ключа таблицы `client_phones`
--
ALTER TABLE `client_phones`
  ADD CONSTRAINT `client_phones_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
