-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: my_bd
-- Время создания: Май 10 2024 г., 23:19
-- Версия сервера: 8.3.0
-- Версия PHP: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Administrator`
--

CREATE TABLE `Administrator` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Cart`
--

CREATE TABLE `Cart` (
  `id` int NOT NULL,
  `id_client` int NOT NULL,
  `id_product` int NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'не заказан',
  `summ_itog` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Cart`
--

INSERT INTO `Cart` (`id`, `id_client`, `id_product`, `status`, `summ_itog`) VALUES
(14, 5, 1, 'заказан', 200);

-- --------------------------------------------------------

--
-- Структура таблицы `categoria`
--

CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `id_group` int NOT NULL,
  `name` text,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categoria`
--

INSERT INTO `categoria` (`id`, `id_group`, `name`, `image`) VALUES
(1, 1, 'свитера', 'my_shop.com/1/1/1.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Client`
--

CREATE TABLE `Client` (
  `id` int NOT NULL,
  `phone` text,
  `city` text,
  `username` text,
  `email` text,
  `birthday` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Client`
--

INSERT INTO `Client` (`id`, `phone`, `city`, `username`, `email`, `birthday`) VALUES
(5, '80000', 'Moscov', 'Vlad', 'vlad@mail.ru', '01.01.2001');

-- --------------------------------------------------------

--
-- Структура таблицы `Comments`
--

CREATE TABLE `Comments` (
  `id` int NOT NULL,
  `created` timestamp(6) NULL DEFAULT NULL,
  `commentatiy` text,
  `id_client` int DEFAULT NULL,
  `id_product` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` int NOT NULL,
  `name` text,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `name`, `image`) VALUES
(1, 'мужчинам', 'my_shop.com/1/1.png');

-- --------------------------------------------------------

--
-- Структура таблицы `logistic`
--

CREATE TABLE `logistic` (
  `id` int NOT NULL,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `id` int NOT NULL,
  `id_sub_categoria` int NOT NULL,
  `name` text,
  `count` int DEFAULT NULL,
  `image` text,
  `description` text NOT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`id`, `id_sub_categoria`, `name`, `count`, `image`, `description`, `price`) VALUES
(1, 1, 'свитер шёлковый мужской XL', 6, 'my_shop.com/1/1/1/1/1.png', 'описание товара', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `product_shop`
--

CREATE TABLE `product_shop` (
  `id` int NOT NULL,
  `count` int DEFAULT NULL,
  `id_shop` int DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `image` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `geocode` text NOT NULL,
  `id_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sub_categoria`
--

CREATE TABLE `sub_categoria` (
  `id` int NOT NULL,
  `id_categoria` int NOT NULL,
  `name` text,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sub_categoria`
--

INSERT INTO `sub_categoria` (`id`, `id_categoria`, `name`, `image`) VALUES
(1, 1, 'свитера из шёлка', 'my_shop.com/1/1/1/1.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group` (`id_group`);

--
-- Индексы таблицы `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logistic`
--
ALTER TABLE `logistic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sub_categoria` (`id_sub_categoria`);

--
-- Индексы таблицы `product_shop`
--
ALTER TABLE `product_shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_shop` (`id_shop`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Индексы таблицы `sub_categoria`
--
ALTER TABLE `sub_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Cart`
--
ALTER TABLE `Cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id`),
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `Product` (`id`);

--
-- Ограничения внешнего ключа таблицы `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `group` (`id`);

--
-- Ограничения внешнего ключа таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id`),
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `Product` (`id`);

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`id_sub_categoria`) REFERENCES `sub_categoria` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_shop`
--
ALTER TABLE `product_shop`
  ADD CONSTRAINT `product_shop_ibfk_1` FOREIGN KEY (`id_shop`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `product_shop_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `product_shop_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `logistic` (`id`);

--
-- Ограничения внешнего ключа таблицы `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `Administrator` (`id`);

--
-- Ограничения внешнего ключа таблицы `sub_categoria`
--
ALTER TABLE `sub_categoria`
  ADD CONSTRAINT `sub_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
