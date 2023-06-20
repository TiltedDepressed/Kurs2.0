-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2023 г., 19:33
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Magazin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Food`
--

CREATE TABLE `Food` (
  `IdFood` int NOT NULL,
  `TypeFood` int NOT NULL,
  `FoodName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `PriceFood` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `WeightFood` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `CountFood` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ImageFood` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Food`
--

INSERT INTO `Food` (`IdFood`, `TypeFood`, `FoodName`, `PriceFood`, `WeightFood`, `CountFood`, `ImageFood`) VALUES
(1, 1, 'Калифорния хит ролл', '180', '300', '6', 'california-hit.jpg'),
(2, 1, 'Калифорния темпура', '250', '205', '6', 'california-tempura.jpg'),
(3, 1, 'Запеченый ролл «Калифорния»', '230', '182', '6', 'zapech-california.jpg'),
(4, 1, 'Филадельфия', '320', '230', '6', 'philadelphia.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `idOrder` int NOT NULL,
  `idUser` int NOT NULL,
  `OrderStatus` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Adress` varchar(255) NOT NULL,
  `telephoneNumber` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`idOrder`, `idUser`, `OrderStatus`, `Name`, `Date`, `Adress`, `telephoneNumber`, `Email`) VALUES
(2, 1, 2, 'Николай ', '2023-04-02', 'ул тывфывыф', '79521485924', 'tosltikov52@mail.ru'),
(3, 2, 2, '1', '2023-03-27', '1', '1', '1'),
(4, 1, 2, 'Николай', '2023-03-30', '1', '1', '1'),
(5, 2, 1, 'Ринат', '2023-03-26', '1', '1', '1'),
(13, 2, 1, 'Ринат', '2023-03-27', '1', '1', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `OrderStatus`
--

CREATE TABLE `OrderStatus` (
  `OrderStatusId` int NOT NULL,
  `OrderStatusName` varchar(255) NOT NULL,
  `Discription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Дамп данных таблицы `OrderStatus`
--

INSERT INTO `OrderStatus` (`OrderStatusId`, `OrderStatusName`, `Discription`) VALUES
(1, 'Новый заказ', NULL),
(2, 'Подтвержденный заказ', NULL),
(3, 'Отмененный заказ', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `TypeFood`
--

CREATE TABLE `TypeFood` (
  `idType` int NOT NULL,
  `TypeName` varchar(255) NOT NULL,
  `Discription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Дамп данных таблицы `TypeFood`
--

INSERT INTO `TypeFood` (`idType`, `TypeName`, `Discription`) VALUES
(1, 'Роллы', NULL),
(2, 'Пицца', NULL),
(3, 'Бургеры', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `IdUser` int NOT NULL,
  `UserRole` int DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `Patronymic` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `telephoneNumber` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`IdUser`, `UserRole`, `Name`, `Surname`, `Patronymic`, `Email`, `telephoneNumber`, `Login`, `Password`) VALUES
(1, 1, 'Николай', NULL, NULL, 'Net', '', 'a', 'a'),
(2, 2, 'Ринат', NULL, NULL, 'нет', '', 'rinat15best', 'rinat15best'),
(3, 3, 'unauthorized', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 'Максим', 'Тест', 'Тест', 'test', 'test', 'test', 'test'),
(11, 2, 'БетаТестер', 'БетаТестер', 'БетаТестер', 'БетаТестер', 'БетаТестер', 'БетаТестер', 'БетаТестер');

-- --------------------------------------------------------

--
-- Структура таблицы `UserRolles`
--

CREATE TABLE `UserRolles` (
  `IdRoll` int NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Дамп данных таблицы `UserRolles`
--

INSERT INTO `UserRolles` (`IdRoll`, `Name`) VALUES
(1, 'Admin'),
(2, 'Visitor'),
(3, 'unauthorized');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY (`IdFood`),
  ADD KEY `TypeFood` (`TypeFood`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `OrderStatus` (`OrderStatus`),
  ADD KEY `idUser` (`idUser`);

--
-- Индексы таблицы `OrderStatus`
--
ALTER TABLE `OrderStatus`
  ADD PRIMARY KEY (`OrderStatusId`);

--
-- Индексы таблицы `TypeFood`
--
ALTER TABLE `TypeFood`
  ADD PRIMARY KEY (`idType`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`IdUser`),
  ADD KEY `UserRole` (`UserRole`);

--
-- Индексы таблицы `UserRolles`
--
ALTER TABLE `UserRolles`
  ADD PRIMARY KEY (`IdRoll`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Food`
--
ALTER TABLE `Food`
  MODIFY `IdFood` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `idOrder` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `OrderStatus`
--
ALTER TABLE `OrderStatus`
  MODIFY `OrderStatusId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `TypeFood`
--
ALTER TABLE `TypeFood`
  MODIFY `idType` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `IdUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `UserRolles`
--
ALTER TABLE `UserRolles`
  MODIFY `IdRoll` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Food`
--
ALTER TABLE `Food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`TypeFood`) REFERENCES `TypeFood` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`OrderStatus`) REFERENCES `OrderStatus` (`OrderStatusId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `User` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserRole`) REFERENCES `UserRolles` (`IdRoll`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
