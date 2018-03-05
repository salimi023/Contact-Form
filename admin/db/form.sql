-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2017. Júl 24. 16:13
-- Kiszolgáló verziója: 10.1.16-MariaDB
-- PHP verzió: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `contact`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `form`
--

CREATE TABLE `form` (
  `msg_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `received` date DEFAULT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  `res_subject` varchar(500) DEFAULT NULL,
  `res_text` text,
  `res_sent` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `form`
--

INSERT INTO `form` (`msg_id`, `name`, `email`, `phone`, `message`, `received`, `stat`, `res_subject`, `res_text`, `res_sent`) VALUES
(1, 'John Doe', 'john@john.com', '555-555', 'I am John', '2017-06-29', 4, 'Response to John Doe', 'Hello John!', '2017-07-14'),
(2, 'Jon Snow', 'jon@jon.com', '446102500', 'I am Jon', '2017-06-29', 1, NULL, NULL, NULL),
(3, 'Kill Bill', 'bill@bill.com', '446102501', 'I am Bill', '2017-06-29', 1, NULL, NULL, NULL),
(4, 'Jane Doe', 'jane@jane.com', '446102502', 'I am Jane', '2017-06-29', 1, NULL, NULL, NULL),
(5, 'Uhtred Ragnarson', 'uhtred@uhtred.com', '446102503', 'I am Uhtred, son of Uhtred', '2017-06-29', 1, NULL, NULL, NULL),
(8, 'Arya Stark', 'arya@arya.com', '642158', 'I am Arya', '2017-06-29', 2, 'Respond to Arya', 'Hello Arya!', '2017-07-14'),
(9, 'Uhtred Ragnarson', 'uhtred@uhtred.com', '446102503', 'Uhtred''s second message', '2017-06-29', 4, 'Response to Uhtred Ragnarson', 'Hello Uhtred, destiny is all!', '2017-07-14'),
(10, 'Uhtred Ragnarson', 'uhtred@uhtred.com', '446102503', 'Uhtred''s third message', '2017-07-14', 3, NULL, NULL, NULL),
(11, 'John Doe', 'john@john.com', '555-555', 'John''s second message', '2017-06-29', 1, NULL, NULL, NULL),
(12, 'John Doe', 'john@john.com', '555-555', 'John''s third message', '2017-07-14', 2, '2nd response to John Doe', 'Hello John!', '2017-07-14'),
(13, 'Jon Snow', 'jon@jon.com', '446102500', 'Jon''s second message', '2017-06-29', 4, 'Response to Jon Snow', 'Hello Jon! Winter is coming!', '2017-07-14'),
(14, 'Jon Snow', 'jon@jon.com', '446102500', 'Jon''s third message', '2017-07-14', 3, NULL, NULL, NULL),
(15, 'Kill Bill', 'bill@bill.com', '446102501', 'Bill''s second message', '2017-06-29', 4, 'Response to Bill', 'Hello Bill!', '2017-07-14'),
(16, 'Kill Bill', 'bill@bill.com', '446102501', 'Bill''s third message', '2017-07-14', 3, NULL, NULL, NULL),
(17, 'Jane Doe', 'jane@jane.com', '446102502', 'Jane''s second message', '2017-06-29', 4, 'Response to Jane Doe', 'Hello Jane!', '2017-07-14'),
(18, 'Jane Doe', 'jane@jane.com', '446102502', 'Jane''s third message', '2017-07-14', 3, NULL, NULL, NULL),
(19, 'Arya Stark', 'arya@arya.com', '642158', 'Arya''s second message', '2017-06-29', 1, NULL, NULL, NULL),
(20, 'John Ford', 'ford@ford.com', '7458936145', 'I am Dr. Ford.', '2017-07-14', 1, NULL, NULL, NULL),
(21, 'John Doe', 'john@john.com', '555-555', 'John''s fourth message.', '2017-07-14', 3, NULL, NULL, NULL),
(22, 'Jon Snow', 'jon@jon.com', '446102500', 'Jon''s fourth message.', '2017-07-14', 2, '2nd response to Jon Snow', 'Hello Jon, winter is here!', '2017-07-14'),
(23, 'Kill Bill', 'bill@bill.com', '446102501', 'Bill''s fourth message.', '2017-07-14', 2, '2nd response to Bill', 'Hello Bill!', '2017-07-14'),
(24, 'Jane Doe', 'jane@jane.com', '446102502', 'Jane''s fourth message.', '2017-07-14', 2, '2nd response to Jane Doe', 'Hello Jane!', '2017-07-14'),
(25, 'Uhtred Ragnarson', 'uhtred@uhtred.com', '446102503', 'Uhtred''s fourth message.', '2017-07-14', 2, '2nd response to Uhtred Ragnarson', 'Hello Uhtred son of Uhtred!', '2017-07-14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `name`, `login`, `pass`) VALUES
(1, 'Admin', 'admin', '$2y$10$x06d5iLOnHJY5AkO/Yr7J.StwpEkAlQUqjp/cqO2BwpLvfhknP43i');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`msg_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `form`
--
ALTER TABLE `form`
  MODIFY `msg_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
