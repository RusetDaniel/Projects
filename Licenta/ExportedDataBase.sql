-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 03:39 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_traffic`
--

CREATE TABLE `accounts_traffic` (
  `Id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(255) NOT NULL,
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_traffic`
--

INSERT INTO `accounts_traffic` (`Id`, `user_id`, `date_time`, `ip`, `login`) VALUES
(221, 52, '2020-06-14 19:14:24', '127.0.0.1', 'unsuccessful'),
(222, 52, '2020-06-14 19:14:41', '127.0.0.1', 'unsuccessful'),
(223, 45, '2020-06-14 19:15:53', '127.0.0.1', 'successful'),
(224, 52, '2020-06-14 19:16:24', '127.0.0.1', 'successful'),
(225, 45, '2020-06-14 19:56:36', '127.0.0.1', 'successful'),
(226, 52, '2020-06-14 19:58:22', '127.0.0.1', 'successful'),
(227, 45, '2020-06-14 20:47:27', '127.0.0.1', 'successful'),
(228, 43, '2020-06-14 20:47:53', '127.0.0.1', 'successful'),
(229, 45, '2020-06-14 21:00:10', '127.0.0.1', 'successful'),
(230, 53, '2020-06-15 14:58:55', '127.0.0.1', 'successful'),
(231, 52, '2020-06-15 15:54:05', '127.0.0.1', 'successful'),
(232, 45, '2020-06-15 19:55:58', '127.0.0.1', 'successful'),
(233, 52, '2020-06-16 19:00:47', '127.0.0.1', 'successful'),
(234, 45, '2020-06-16 19:44:39', '127.0.0.1', 'successful'),
(235, 52, '2020-06-16 19:55:11', '127.0.0.1', 'successful'),
(236, 45, '2020-06-16 19:59:42', '127.0.0.1', 'successful'),
(237, 44, '2020-06-17 01:28:22', '127.0.0.1', 'successful'),
(238, 52, '2020-07-01 20:30:14', '127.0.0.1', 'successful'),
(239, 52, '2020-07-01 20:34:32', '127.0.0.1', 'successful'),
(240, 45, '2020-07-02 10:07:33', '127.0.0.1', 'successful'),
(241, 52, '2020-07-02 10:43:11', '127.0.0.1', 'successful'),
(242, 45, '2020-07-02 10:46:18', '127.0.0.1', 'successful'),
(243, 52, '2020-07-02 11:23:41', '127.0.0.1', 'successful'),
(244, 52, '2020-07-02 12:21:11', '127.0.0.1', 'successful'),
(245, 52, '2020-07-02 13:12:26', '127.0.0.1', 'successful'),
(246, 44, '2020-07-02 13:30:10', '127.0.0.1', 'successful'),
(247, 52, '2020-07-02 14:28:00', '127.0.0.1', 'successful'),
(248, 43, '2020-09-05 14:29:31', '127.0.0.1', 'successful'),
(249, 43, '2020-09-05 14:40:35', '127.0.0.1', 'unsuccessful'),
(250, 43, '2020-09-05 14:40:46', '127.0.0.1', 'unsuccessful'),
(251, 43, '2020-09-05 14:41:01', '127.0.0.1', 'successful'),
(252, 43, '2020-09-05 14:53:10', '127.0.0.1', 'successful'),
(253, 43, '2020-09-05 14:53:37', '127.0.0.1', 'successful');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `invoice_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `place_of_purchase` varchar(50) NOT NULL,
  `serialNr` varchar(100) NOT NULL,
  `purchaseDate` date NOT NULL,
  `warrantyLength` varchar(5) NOT NULL,
  `invoice_path` varchar(200) NOT NULL,
  `warranty_path` varchar(200) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `Address` varchar(255) NOT NULL,
  `defectDescription` text NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Waiting for confirmation'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`invoice_id`, `user_id`, `country`, `city`, `place_of_purchase`, `serialNr`, `purchaseDate`, `warrantyLength`, `invoice_path`, `warranty_path`, `Name`, `date_time`, `Address`, `defectDescription`, `Status`) VALUES
(67, 52, 'Romania', 'Craiova', 'Emag', 'AUWMK4227221', '2019-12-11', '2', '../invoiceImg/159215705619220658465ee6638002c2c.png', '', 'Samsung S10', '2020-06-14 20:50:56', '1 Mai, Str Independentei,Bloc 14,Apartament 2', 'The phone does not charge.', 'Confirmed'),
(68, 43, 'Romania', 'Bucuresti', 'Altex', 'aaaa-4444-2310-5500', '2017-12-02', '2', '../invoiceImg/15921606616502690235ee67195eb8e4.png', '', 'Smart TV LG 46', '2020-06-14 21:51:01', 'Calea Bucuresti, Nr 17, Scara 1 ,Aprt 21', 'Sound dosent work.', 'Confirmed'),
(69, 43, 'Romania', 'Bucuresti', 'Emag', 'KKKT6474GHH', '2019-02-15', '3', '../invoiceImg/159216077313547622295ee6720514b2a.png', '', 'Iphone X', '2020-06-14 21:52:53', 'Cartierul Ferentari, Str Muzelor Nr 28', 'Camera is not working.', 'Declined'),
(70, 43, 'Romania', 'Constanta', 'MediaGalaxy', 'POO47-ZZZ513', '2018-05-12', '5', '../invoiceImg/159216096720411488235ee672c7d0ed2.png', '', 'Lenovo Laptop ideapad 100', '2020-06-14 21:56:07', 'Strd. Florilor Nr 24', 'Broken cooler.', 'Declined'),
(71, 43, 'Romania', 'Cluj', 'Altex', 'UJJKHHHH4', '2020-01-09', '2', '../invoiceImg/15921611243733631495ee6736444ae5.png', '', 'Iphone 7,32 GB,Jet Black', '2020-06-14 21:58:44', 'Cartier 9 Mai,Bloc 4 , Scara 3 , Apartament 7', 'The phone it doesn\'t start.', 'Confirmed'),
(72, 53, 'Romania', 'Bihor', 'Emag', 'Z991KKKAPKAPI', '2020-01-01', '2', '../invoiceImg/159222623315006003605ee771b994c0a.png', '', 'Hp Laptop mk5', '2020-06-15 16:03:53', 'Str. Principala nr 31 Bloc 2 Aprt 17', 'Keybord is not responding.', 'Confirmed'),
(74, 52, 'Romania', 'Craiova', 'Emag', '2uihiuh32xx2', '2019-11-11', '3', '../invoiceImg/1592329106866286005ee90392c246a.png', '../warrantyImg/1592329106866286005ee90392c246a.png', 'Iphone X', '2020-06-16 20:38:26', 'Str. Principala nr 31 Bloc 2 Aprt 17', 'Not starting', 'Confirmed'),
(75, 52, 'Romania', 'Bucuresti', 'Altex', '5555224HHJLKL', '2020-01-01', '3', '../invoiceImg/15923293987417145715ee904b60f237.png', '../warrantyImg/15923293987417145715ee904b60f237.png', 'Iphone 7 get gold', '2020-06-16 20:43:18', 'Cartierul 1 Mai, Str Independentei,Bloc 14,Apartament 2', 'Screen is off.', 'Declined'),
(76, 52, 'Romania', 'Craiova', 'Emag', 'AUWZZFFGJH', '2019-11-11', '2', '../invoiceImg/15936886955518085785efdc277010d0.png', '../warrantyImg/15936886955518085785efdc277010d0.png', 'Laptop ASUS', '2020-07-02 14:18:15', 'Str nr 1 Bloc 7', 'Broken Camera', 'Waiting for confirmation'),
(77, 52, 'Romania', 'Craiova', 'Emag', 'ASHSDHSDa', '2019-11-11', '2', '../invoiceImg/159369325815699290955efdd44a1160a.png', '../warrantyImg/159369325815699290955efdd44a1160a.png', 'Abc\'X', '2020-07-02 15:34:18', 'Str nr 1 Bloc 7', 'Broken camera', 'Waiting for confirmation');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `serialNr` varchar(100) NOT NULL,
  `purchaseDate` date NOT NULL,
  `warrantyLength` varchar(4) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`serialNr`, `purchaseDate`, `warrantyLength`, `Name`, `user_id`, `Address`, `Status`) VALUES
('2uihiuh32xx2', '2019-11-11', '3', 'Iphone X', 52, 'Str. Principala nr 31 Bloc 2 Aprt 17', 'Received'),
('aaaa-4444-2310-5500', '2017-12-02', '2', 'Smart TV LG 46', 43, 'Calea Bucuresti, Nr 17, Scara 1 ,Aprt 21', 'Beeing checked'),
('AUWMK4227221', '2019-12-11', '2', 'Samsung S10', 52, '1 Mai, Str Independentei,Bloc 14,Apartament 2', 'Waiting to be received'),
('UJJKHHHH4', '2020-01-09', '2', 'Iphone 7,32 GB,Jet Black', 43, 'Cartier 9 Mai,Bloc 4 , Scara 3 , Apartament 7', 'Waiting to be received'),
('Z991KKKAPKAPI', '2020-01-01', '2', 'Hp Laptop mk5', 53, 'Str. Principala nr 31 Bloc 2 Aprt 17', 'Waiting to be received');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `evkey` varchar(45) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `blocked` datetime(6) NOT NULL,
  `user_level` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `email`, `phone`, `evkey`, `creation_date`, `verified`, `blocked`, `user_level`) VALUES
(43, 'Ruset Daniel', '$2y$10$2hMMvPHAMLA/TTURNE88IOPbpmd1V5iRX1iiomFvIFyEiaWkavjIu', 'ps.stark@yahoo.com', '0764233211', '8257e4c0e08e5ca78039dd39b97ce6e1', '2020-06-05 11:38:05.083189', 1, '2020-06-05 13:39:05.000000', 0),
(44, 'Super-admin', '$2y$10$wxvKsaFtc3o43Ds320cDB.vZYD5hlY1AK6.ToAkPlTMTOlTiU7pjO', 'superadmin@yahoo.com', '', '', '2020-05-15 09:22:53.610950', 1, '0000-00-00 00:00:00.000000', 2),
(45, 'admin', '$2y$10$wxvKsaFtc3o43Ds320cDB.vZYD5hlY1AK6.ToAkPlTMTOlTiU7pjO', 'admin@yahoo.com', '07241412412', '5e11c21b2262dffbee8137ef5f91e970', '2020-05-15 09:18:17.422486', 1, '0000-00-00 00:00:00.000000', 1),
(52, 'Ruset Daniel - Marinel', '$2y$10$wxvKsaFtc3o43Ds320cDB.vZYD5hlY1AK6.ToAkPlTMTOlTiU7pjO', 'daniel.ruset@yahoo.com', '0765233211', 'a864a1b8886ff1d38c12bafe18c143d0', '2020-06-14 17:16:16.846392', 1, '2020-06-11 21:08:30.000000', 0),
(53, 'Cristi Ionut', '$2y$10$LR.uLm.4sF1PZbmzO8O3sOF.nEqWwV00q5ErKLh78OhLA4QogppBC', 'cr.app@yahoo.com', '0825331442', '6e1fa7562f4639bbf84c641343177ef5', '2020-06-15 12:58:36.399652', 1, '0000-00-00 00:00:00.000000', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_traffic`
--
ALTER TABLE `accounts_traffic`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `serialNr` (`serialNr`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`serialNr`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_traffic`
--
ALTER TABLE `accounts_traffic`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `invoice_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_traffic`
--
ALTER TABLE `accounts_traffic`
  ADD CONSTRAINT `accounts_traffic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
