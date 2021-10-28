-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2021 at 09:58 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `sale` tinyint(3) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT 'no-image.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `qty`, `sale`, `description`, `image`, `created_at`) VALUES
(1, 'Fanta Grape Flavoured Drink', 1.25, 50, 0, 'Fanta grape är en uppfriskande, mousserande läskedryck som är fylld av utsökt druvsmak. Det kupolformade läppbalsamet ger den autentiska smaken av Fanta grape samtidigt som det ger förlängd återfuktning till dina läppar. Den ikoniska designen med Fountain cup gör garanterat intryck när du använder den', 'fanta_grape.jpg', '2021-10-28 19:22:13'),
(2, 'Sierra Mist', 0.85, 20, 10, 'I en tävling av sockervatten fyllda med tillsatser finns det ingen vinnare. Sierra Mist har lika många kalorier som ett paket Now and Laters, och bara 7 gram mindre socker. Ändå hamnar den på första plats på den här listan eftersom den inte innehåller några artificiella aromer och använder sötningsmedlet Stevia Leaf Extract, som, även om det fortfarande är under utredning, kommer från växter och kan visa sig vara nyckeln till att lösa Amerikas fetmaepidemi genom att tillfredsställa vårt sötsug utan att lägga till kalorier.', 'sierra-mist.jpeg', '2021-10-28 19:22:51'),
(5, 'Pepsi', 10.50, 11, 25, 'Den ständiga nummer två i kolakriget innehåller 5 gram mer socker än en 3 Musketeers-kakaka och 1 gram mer kolhydrater. Låt det sjunka in: En av Amerikas mest populära läsk har så mycket socker. Istället för att dricka detta kan du göra en smoothie - de kan verkligen hjälpa dig att gå ner i vikt!', 'pepsi.png', '2021-10-28 17:53:16'),
(7, 'Coca Cola', 1.20, 20, 20, 'Man har varit ute efter Coca-Cola sedan starten, eftersom företaget självt är ansvarigt för de HFCS-fyllda Sprite, Barqs, Fanta, Dr. Pepper, Fuze Tea, Powerade, Monster energidryckerna med mera - för att inte tala om det sockerrika "VitaminWater". Ändå är företagets flaggskeppsdryck mindre skadlig än de flesta läskedrycker på den här listan. Det betyder dock inte att du bör dricka den. Det betyder att du inte bör dricka läsk. Om du vill ha ett hälsosammare rus utan konserveringsmedel kan du dricka te.', 'coca-cola.jpeg', '2021-10-28 17:57:21'),
(9, 'Sunkist', 1.25, 19, 10, 'Vad får man när man kombinerar kolsyrat vatten med majssirap med hög fruktos och en mängd kemikalier som är svåra att uttala? Denna citrusinspirerade klunk. Den får sin lockande orange färg från Yellow 5 och Red 40. En studie i Journal of Pediatrics kopplade Yellow 5 till hyperaktivitet hos barn och kanadensiska forskare fann att Red 40 var förorenat med kända cancerframkallande ämnen.', 'sunkist.jpeg', '2021-10-28 18:20:14'),
(10, '7up Cherry', 10.00, 10, 10, 'Ingredienser: Citronsyra, filtrerat kolsyrat vatten, majssirap med hög fruktoshalt, naturliga aromer, kaliumbenzoat (konserveringsmedel), rött 40. Ingen karamellfärg - rankningen stiger! Röd 40-rankningen sjunker.', 'zup-cherry.jpeg', '2021-10-28 19:03:36'),
(11, 'Sprite', 10.00, 10, 20, 'Sprite marknadsförs av de coolaste idrottsmännen och har en bra marknadsföring - och ett kaloriräknande som är något lägre än de andra citrusläskorna på den här listan. Men vi kan inte föreställa oss att LeBron och hans vänner faktiskt dricker en burk med kolsyrat majssirap före en match.', 'sprite.jpeg', '2021-10-28 19:05:37'),
(12, 'Schweppes Ginger Ale', 34.00, 43, 43, 'Oroa dig inte för kinin - det förknippas ofta med behandling av malaria och är också huvudingrediensen i ofarligt tonic water. Nej, frukta i stället denna dryckes vanliga mixer. Trots att den ligger nära toppen av denna lista innehåller den fortfarande lika mycket socker från HFCS som 10 croissanter. Det finns åtminstone inga artificiella aromer (och tyvärr inte heller ingefära).', 'schweppes-ginger-ale.jpeg', '2021-10-28 19:07:23'),
(13, 'Surge', 34.00, 43, 45, 'Det är inte ovanligt att "natrium- och kaliumbensoat tillsätts i vissa lightläskedrycker och fruktdrycker", berättar Leslie Bonci, R.D. Eat This, Not That! Tyvärr - särskilt eftersom Surge innehåller juice - "kan de bilda bensen, som är cancerframkallande, när de kombineras med C-vitamin, askorbinsyran i juice eller läsk', 'surge-can.jpeg', '2021-10-28 19:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'webbtest0@gmail.com', '$2y$10$N6v6/NHggKNG.raX4H3TcOz6ZgQp46mRH51rTLB46jLxP3IWeTdRa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
