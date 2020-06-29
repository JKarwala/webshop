-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Mar 2020, 20:21
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `project`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_polish_ci NOT NULL,
  `img1` text COLLATE utf8mb4_polish_ci NOT NULL,
  `img2` text COLLATE utf8mb4_polish_ci NOT NULL,
  `img3` text COLLATE utf8mb4_polish_ci NOT NULL,
  `img4` text COLLATE utf8mb4_polish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `color` text COLLATE utf8mb4_polish_ci NOT NULL,
  `type` text COLLATE utf8mb4_polish_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `name`, `img1`, `img2`, `img3`, `img4`, `price`, `color`, `type`, `active`) VALUES
(1, 'Garnitur - Suit Boss', 'suitboss.jpg', '', '', '', 340, 'black', 'male', 1),
(2, 'Smoking - Elegant Men', 'suit3.jpg', '', '', '', 650, 'grey', 'male', 1),
(3, 'Sukienka - Queen Dress', 'quindress.jpg', '', '', '', 340, 'blue', 'female', 1),
(4, 'Princess - Dress', 'quindress.jpg', '', '', '', 450, 'red', 'female', 1),
(5, 'Mały Książę - KidSuit', 'juniorprince.jpg', '', '', '', 540, 'grey', 'junior', 1),
(6, 'Alpagio - Błękitny Ocean', 'dress2.jpg', '', '', '', 330, 'blue', 'female', 1),
(7, 'Vespucci - Letnia', 'dress1.jpg', '', '', '', 130, 'white', 'female', 1),
(8, 'Mirrabella - Różowy Raj', 'dress3.jpg', '', '', '', 250, 'red', 'female', 1),
(9, 'Migimolla - Grey Style', 'dress4.jpg', '', '', '', 440, 'grey', 'female', 1),
(10, 'Verbania - Orliono', 'suit1.jpg', '', '', '', 530, 'blue', 'male', 1),
(11, 'Gentelman - Suit Men', 'suit2.jpg', '', '', '', 440, 'blue', 'male', 1),
(12, 'AgressiveMR - Lompegga', 'suit4.jpg', '', '', '', 320, 'black', 'male', 1),
(13, 'BlueAgent - HaevenSuit', 'suit5.jpg', '', '', '', 630, 'blue', 'male', 1),
(14, 'WhiteAngel - Kidi', 'child1.jpg', '', '', '', 250, 'white', 'junior', 1),
(15, 'DottedDress - YourStyle', 'child2.jpg', '', '', '', 320, 'white', 'junior', 1),
(16, 'LiitlePrincess - PinkiMay', 'child3.jpg', '', '', '', 310, 'pink', 'junior', 1),
(17, 'JuniorGentelman - Rastrog', 'child5.jpg', '', '', '', 520, 'black', 'junior', 1),
(18, 'Leonadro - AllforKids', 'leonardo1.jpg', 'leonardo2.jpg', 'leonardo3.jpg', 'leonardo4.jpg', 330, 'grey', 'junior', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `email`, `name`, `surname`, `password`) VALUES
(1, 'JarekYT@gmail.com', 'Jarosław', 'Karwala', '$2y$10$uTi1h0iY6O4gxXAwQRwrUebdFlcq9g3icM.84JRQFLD/m4V08CXFu'),
(2, 'adam.marciniak@gmail.com', 'Adam', 'Marciniak', '$2y$10$G4lNftbTtL0vRuzurPLtk.IkbKIdQ7BtFTfpBcoNMabxY8innzm8a'),
(4, 'jarek.karwala@interia.pl', 'Jarek', 'Karwala', '$2y$10$wCFXfMMZNleLngNsFrp5z.fw5IykkFq/7qbMxC5g7/nX4/TtM0BR.'),
(7, 'piotr.chelmecki@interia.pl', 'Piotr', 'Chelmecki', '$2y$10$6piqK5DJPBo.Ws80fJmuVepSihloEU433cG71harUdojO1qjfQc6e');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
