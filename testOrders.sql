-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 27 2025 г., 13:33
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
-- База данных: `testOrders`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Baskets`
--

CREATE TABLE `Baskets` (
  `id` int NOT NULL,
  `good_id` int NOT NULL,
  `order_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Baskets`
--

INSERT INTO `Baskets` (`id`, `good_id`, `order_id`, `quantity`) VALUES
(1, 1, 1, 5),
(2, 2, 1, 2),
(3, 4, 3, 1),
(4, 3, 2, 3),
(5, 4, 4, 2),
(6, 3, 4, 1),
(7, 4, 5, 2),
(8, 3, 5, 1),
(9, 1, 6, 3),
(10, 3, 7, 2),
(11, 3, 8, 2),
(12, 1, 8, 1),
(13, 4, 8, 2),
(14, 2, 9, 2),
(15, 3, 9, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `Goods`
--

CREATE TABLE `Goods` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `article` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Goods`
--

INSERT INTO `Goods` (`id`, `name`, `article`, `price`) VALUES
(1, 'Мячик', '758963', '200.00'),
(2, 'Шарик', '897524', '100.00'),
(3, 'Торшер', '963256', '500.00'),
(4, 'Лыжи', '963547', '400.00');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`id`, `user_id`, `date`, `is_paid`) VALUES
(1, 2, '11.05.2024', 1),
(2, 1, '12.07.2024', 1),
(3, 2, '15.11.2024', 1),
(4, 2, '27-01-2025 12:23:48', 0),
(5, 1, '27-01-2025 12:24:58', 0),
(6, 1, '27-01-2025 12:31:15', 1),
(7, 1, '27-01-2025 12:38:50', 0),
(8, 3, '27-01-2025 13:18:41', 1),
(9, 3, '27-01-2025 13:25:30', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `name` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` char(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Вася', 'vasa@vasa.ru', '85924548842'),
(2, 'Петя Петрович', 'petr@mail.ru', '87529636851'),
(3, 'Ольга', 'ollll@oli.ru', '86782593548');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Baskets`
--
ALTER TABLE `Baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Baskets_Orders_FK` (`order_id`),
  ADD KEY `Baskets_Goods_FK` (`good_id`);

--
-- Индексы таблицы `Goods`
--
ALTER TABLE `Goods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Goods_UNIQUE` (`article`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Orders_Users_FK` (`user_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Baskets`
--
ALTER TABLE `Baskets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `Goods`
--
ALTER TABLE `Goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Baskets`
--
ALTER TABLE `Baskets`
  ADD CONSTRAINT `Baskets_Goods_FK` FOREIGN KEY (`good_id`) REFERENCES `Goods` (`id`),
  ADD CONSTRAINT `Baskets_Orders_FK` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_Users_FK` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
