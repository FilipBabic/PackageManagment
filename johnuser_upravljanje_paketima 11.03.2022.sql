-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2022 at 10:45 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `johnuser_upravljanje_paketima`
--

-- --------------------------------------------------------

--
-- Table structure for table `gradovi`
--

CREATE TABLE `gradovi` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gradovi`
--

INSERT INTO `gradovi` (`id`, `ime`, `kurir`, `created`) VALUES
(1, 'Podgorica', 'Mirko Loncarevic', '2022-01-05 15:29:41'),
(2, 'Bijelo Polje', 'Mirko Brkic', '2022-01-05 15:31:08'),
(4, 'Nikšić', 'Milan Bojic', '2022-01-05 15:58:28'),
(5, 'Kumbor', 'Darko Milutinovic', '2022-01-05 18:53:36'),
(6, 'Bec', NULL, '2022-02-16 17:47:56'),
(7, 'Beograd', NULL, '2022-02-21 15:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `klijenti`
--

CREATE TABLE `klijenti` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avansni_klijent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `br_racuna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klijenti`
--

INSERT INTO `klijenti` (`id`, `ime`, `avansni_klijent`, `created`, `email`, `pib`, `telefon`, `br_racuna`, `adresa`) VALUES
(1, 'Marbo Product 44', 'da', '2021-12-21 20:58:47', 'marbo-product.info.rs', '149922449', '066/1220049', '12-332144322355-12', 'Španskih Boraca 123'),
(2, 'WALMART', 'da', '2021-12-21 20:58:47', 'walmart@gmail.com', '196802918', '030/441233', '22-233358257493-11', 'Bulevar Mihaila Lekovića'),
(4, 'M-Transport', 'ne', '2021-12-21 21:01:37', 'mtransportsrbija@gmail.com', '445112009', '069/8870962', '123-12398456999-22', 'Vuleta Tomića 11'),
(5, 'VOLI-marketi', 'ne', '2021-12-22 02:48:35', 'volimarketing@gmail.com', '009277499', '023/121213', '12-123984561283-12', 'Mitrovićeva 99'),
(7, 'Vitorog Nameštaj', 'da', '2022-01-06 00:57:55', 'vitorog@gmai.com', '22096661253', '011/99322322', '88-120386665513-22', 'Milana Blagojevića, novosadski put 211'),
(10, 'Promet Elektronika', 'ne', '2022-01-06 01:13:42', '', '208949612535', '067/444-32-33', '88-120386665513-22', '');

-- --------------------------------------------------------

--
-- Table structure for table `kuriri`
--

CREATE TABLE `kuriri` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `br_racuna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kuriri`
--

INSERT INTO `kuriri` (`id`, `ime`, `telefon`, `created`, `email`, `adresa`, `br_racuna`) VALUES
(1, 'Mirko Loncarevic', '067/444-32-11', '2021-12-21 02:14:37', 'mirko4.loncar@gmail.com', 'Marka Celebonovica', '22-33456672343-11'),
(2, 'Mirko Brkic', '067/444-32-32', '2021-12-21 02:15:51', 'brkicmirko@gmail.com', 'Svetogorska', '13-19428568686-33'),
(3, 'Milan Bojic', '066/24009449', '2021-12-21 02:17:02', 'milan1443@yahoo.com', 'Svetog Save 4', '99-12933488754-21'),
(4, 'Darko Milutinovic', '066/2400944', '2022-01-05 15:10:39', 'dare1234@gmail.com', 'Rankeova 133', '83-12309858685-33'),
(5, 'Dejan Milovic', '', '2022-02-04 17:42:44', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

CREATE TABLE `liste` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum_od` datetime DEFAULT NULL,
  `datum_do` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`id`, `ime`, `grad`, `datum_od`, `datum_do`, `created`) VALUES
(1, 'PL1', 'Podgorica', '2022-02-09 00:00:00', '2022-03-10 00:00:00', '2022-03-10 00:10:43'),
(2, 'PL2', 'Bijelo Polje', '2022-02-09 00:00:00', '2022-03-10 00:00:00', '2022-03-10 00:12:16'),
(3, 'PL3', 'bez', '2022-02-10 00:00:00', '2022-03-11 00:00:00', '2022-03-10 12:27:09'),
(4, 'PL4', 'Bijelo Polje', '2022-02-10 00:00:00', '2022-03-11 00:00:00', '2022-03-10 12:28:11'),
(5, 'PL5', 'Kumbor', '2022-02-10 00:00:00', '2022-03-11 00:00:00', '2022-03-10 12:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `paketi`
--

CREATE TABLE `paketi` (
  `id` int(11) NOT NULL,
  `prijem` datetime DEFAULT NULL,
  `klijent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primalac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `br_telefona` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cena_dostave` double(15,2) DEFAULT NULL,
  `cena_otkupa` double(15,2) DEFAULT NULL,
  `otkup_kurir` double(15,2) DEFAULT NULL,
  `status_paketa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klijentu_placeno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `broj_liste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paketi`
--

INSERT INTO `paketi` (`id`, `prijem`, `klijent`, `primalac`, `br_telefona`, `kurir`, `grad`, `adresa`, `cena_dostave`, `cena_otkupa`, `otkup_kurir`, `status_paketa`, `klijentu_placeno`, `broj_liste`) VALUES
(1, '2021-12-17 16:28:21', 'WALMART', 'Dejan Markovic', '069/444-44-22', 'Mirko Loncarevic', 'Podgorica', 'Bulevar Mihaila Lalica 44', 15.23, 420.00, 0.00, 'na_stanju', 'da', 'PL34'),
(2, '2021-12-17 16:28:21', 'VOLI-marketi', 'Marko Ivanovic', '069/132-33-22', 'Milan Bojic', 'Nikšić', 'Bulevar Mihaila Lalica 44', 31.55, 0.00, 100.00, 'dostavljeno', 'ne', 'PL34'),
(3, '2021-12-17 16:28:21', 'WALMART', 'Mitar Dragic', '066/389-99-33', 'Mirko Brkic', 'Bijelo Polje', 'Bulevar Dejana Lukovica 94', 12.00, 0.00, 0.00, 'na_stanju', 'da', 'PL34'),
(4, '2021-12-20 22:30:33', 'WALMART', 'Jelena Trajkovic', '069/313-55-60', 'Milan Bojic', 'Nikšić', 'Marinkoviceva 3', 15.00, 1200.00, 0.00, 'na_stanju', 'da', 'PL34'),
(5, '2022-02-21 15:01:01', 'VOLI-marketi', 'Ivan Milic', '066/1234567', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 13.00, 380.00, 0.00, 'dostavljeno', 'ne', 'PL1'),
(20, '2022-02-21 19:44:53', 'Promet Elektronika', 'Jovana Mitic', '066/12344244', 'Darko Milutinovic', 'Bijelo', 'Svetog Save 411', 13.00, 233.00, 0.00, 'dostavljeno', 'ne', 'PL36'),
(21, '2022-02-22 01:23:27', 'Promet Elektronika', 'Jovana Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 45.12, 0.00, 34.22, 'na_stanju', 'ne', 'PL1'),
(22, '2022-02-22 01:30:47', 'M-Transport', 'Ivan Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 11.21, 2800.00, 0.00, 'dostavljeno', 'da', 'PL3'),
(23, '2022-02-22 01:38:51', 'Marbo Product 44', 'Jovana Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 9.11, 0.00, 0.00, 'dostavljeno', 'ne', 'PL1'),
(24, '2022-02-22 01:47:09', 'WALMART', 'Jovana Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Svetog Save 411', 13.00, 233.00, 0.00, 'na_stanju', 'da', 'PL4'),
(25, '2022-02-26 16:06:10', 'WALMART', 'asfasfasf', 'sfasfasfas', 'Mirko Loncarevic', 'Podgorica', 'safasfasfas', 15.00, 0.00, 110.70, 'dostavljeno', 'da', 'PL3'),
(26, '2022-03-01 13:42:22', 'Marbo Product 44', 'Jovana Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 45.12, 0.00, 233.34, 'na_stanju', 'da', 'PL3'),
(27, '2022-03-01 14:19:06', 'Promet Elektronika', 'Jovana Mitic', '066/12344244', 'Darko Milutinovic', 'Kumbor', 'Rankeova 133a', 45.12, 633.33, 0.00, 'na_stanju', 'ne', 'bez'),
(28, '2022-03-01 14:22:07', 'M-Transport', 'Ivan Mitic', 'sd', 'Milan Bojic', 'Podgorica', 'Rankeova 133', 9.11, 0.00, 123.13, 'na_stanju', 'da', 'PL3'),
(29, '2022-03-01 14:28:59', 'VOLI-marketi', 'Jovana Mitic', '066/12344244', 'Darko Milutinovic', 'Kumbor', 'Rankeova 133', 11.21, 0.00, 1343.13, 'dostavljeno', 'da', 'PL5'),
(30, '2022-03-01 14:29:49', 'VOLI-marketi', 'Ivan Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Svetog Save 411', 9.11, 913.00, 0.00, 'na_stanju', 'ne', 'PL1'),
(31, '2022-03-02 04:34:52', 'M-Transport', 'Jovana Mitic', '066/12344244', 'Dejan Milovic', 'Kumbor', 'Svetog Save 411', 13.00, 123.00, 0.00, 'na_stanju', 'ne', 'PL5'),
(32, '2022-03-09 01:20:29', 'Marbo Product 44', 'Jovana Mitic', '066/12344244', 'Mirko Loncarevic', 'Podgorica', 'Milana BlagojeviÄ‡a, novosadski put 211', 9.11, 222.13, 0.00, 'dostavljeno', 'da', 'PL3'),
(33, '2022-03-09 01:21:44', 'Marbo Product 44', 'Jovana Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Milana BlagojeviÄ‡a, novosadski put 211', 11.21, 633.33, 0.00, 'na_stanju', 'ne', 'PL4'),
(34, '2022-03-09 01:24:59', 'Promet Elektronika', 'Ivan Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Rankeova 133a', 9.11, 222.13, 0.00, 'na_stanju', 'ne', 'PL4'),
(35, '2022-03-09 01:25:32', 'WALMART', 'Ivan Mitic', '066/12344244', 'Darko Milutinovic', 'Kumbor', 'Milana BlagojeviÄ‡a, novosadski put 211', 13.00, 913.00, 0.00, 'dostavljeno', 'ne', 'PL5'),
(36, '2022-03-09 01:30:52', 'WALMART', 'Jovana Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Svetog Save 411', 8.44, 229.00, 0.00, 'dostavljeno', 'da', 'PL4'),
(37, '2022-03-09 01:34:36', 'Marbo Product 44', 'Ivan Mitic', 'sd', 'Darko Milutinovic', 'Kumbor', '5', 8.44, 633.33, 0.00, 'dostavljeno', 'da', 'PL5'),
(38, '2022-03-09 01:35:50', 'WALMART', 'Jovana Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Milana BlagojeviÄ‡a, novosadski put 211', 13.00, 913.00, 0.00, 'dostavljeno', 'da', 'PL4'),
(39, '2022-03-09 01:38:06', 'VOLI-marketi', 'Ivan Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Rankeova 133', 8.44, 633.33, 0.00, 'na_stanju', 'ne', 'PL4'),
(40, '2022-03-09 01:39:25', 'VOLI-marketi', 'Ivan Mitic', '066/12344244', 'Mirko Brkic', 'Bijelo Polje', 'Rankeova 133', 8.44, 633.33, 0.00, 'na_stanju', 'ne', 'PL4'),
(41, '2022-03-09 01:41:28', 'M-Transport', 'Ivan Mitic', '066/12344244', 'Darko Milutinovic', 'Kumbor', 'Svetog Save 411', 11.21, 3333.00, 0.00, 'na_stanju', 'ne', 'PL5'),
(42, '2022-03-09 01:45:29', 'VOLI-marketi', 'Jovana Nikolic', '066/12344244', 'Darko Milutinovic', 'Kumbor', 'Svetog Save 411', 200.00, 0.00, 500.00, 'vraceno', 'da', 'PL5'),
(43, '2022-03-09 16:59:34', 'VOLI-marketi', 'Jovana Mitic', '066/12344244', 'Mirko Brkic', 'Podgorica', 'Svetog Save 411', 11.21, 633.33, 0.00, 'dostavljeno', 'da', 'PL3'),
(44, '2022-03-10 12:04:18', 'WALMART', 'Pera Peric', '061616161', 'Mirko Brkic', 'Podgorica', 'Gandijeva 500', 15.00, 280.00, 0.00, 'na_stanju', 'da', 'PL3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gradovi`
--
ALTER TABLE `gradovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klijenti`
--
ALTER TABLE `klijenti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuriri`
--
ALTER TABLE `kuriri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paketi`
--
ALTER TABLE `paketi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klijenti`
--
ALTER TABLE `klijenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kuriri`
--
ALTER TABLE `kuriri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paketi`
--
ALTER TABLE `paketi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `users` (`id`, `username`, `password`, `created`) VALUES
(1, 'master', 'bracakastratovic', now());