-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 07, 2023 at 06:40 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CityRoute`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bus`
--

CREATE TABLE `Bus` (
  `BusId` int(10) NOT NULL,
  `StrStnName` varchar(200) NOT NULL,
  `StrStnLatLng` varchar(100) NOT NULL,
  `EndStnName` varchar(200) NOT NULL,
  `EndStnLatLng` varchar(100) NOT NULL,
  `SubCatStatus` int(10) NOT NULL DEFAULT '0',
  `ActiveStatus` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Bus`
--

INSERT INTO `Bus` (`BusId`, `StrStnName`, `StrStnLatLng`, `EndStnName`, `EndStnLatLng`, `SubCatStatus`, `ActiveStatus`) VALUES
(2, 'S.P.Ring Road Approach BRTS', '23.02505,72.67142', 'Bhadaj Circle', '23.08313,72.49534', 0, 0),
(9, 'Maninagar BRTS', '22.99780,72.61203', 'Gota Cross Road', '23.09883,72.53171', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `BusStopData`
--

CREATE TABLE `BusStopData` (
  `StnId` int(20) NOT NULL,
  `StnName` varchar(200) NOT NULL,
  `StnLat` varchar(20) NOT NULL,
  `StnLng` varchar(20) NOT NULL,
  `BusId` varchar(10) NOT NULL,
  `BusCat` varchar(5) NOT NULL,
  `StnSeq` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `BusStopData`
--

INSERT INTO `BusStopData` (`StnId`, `StnName`, `StnLat`, `StnLng`, `BusId`, `BusCat`, `StnSeq`) VALUES
(1, 'S.P.Ring Road Approach BRTS', '23.02505', '72.67142', '2', 'U/D', '1'),
(2, 'Odhav Talav BRTS', '23.02454', '72.66539', '2', 'U/D', '2'),
(3, 'Morlidhar Society BRTS', '23.02405', '72.66240', '2', 'U/D', '3'),
(4, 'Chhotalal Ni Chali BRTS', '23.02355', '72.65882', '2', 'U/D', '4'),
(5, 'Vallabh Nagar BRTS', '23.02296', '72.65487', '2', 'U/D', '5'),
(6, 'Odhav Fire Station BRTS', '23.02239', '72.65079', '2', 'U/D', '6'),
(7, 'Grid Station BRTS', '23.02134', '72.64361', '2', 'U/D', '7'),
(8, 'Soni Ni Chali BRTS', '23.02056', '72.63836', '2', 'U/D', '8'),
(9, 'Ajit Mill Char Rasta BRTS', '23.02007', '72.63333', '2', 'U/D', '9'),
(10, 'Soma Textiles BRTS', '23.02015', '72.62897', '2', 'U/D', '10'),
(11, 'Narayana Hospital BRTS', '23.02152', '72.62352', '2', 'U/D', '11'),
(12, 'Rakhiyal Char Rasta BRTS', '23.02222', '72.61927', '2', 'U/D', '12'),
(13, 'Patel Mills BRTS', '23.02200', '72.61299', '2', 'U/D', '13'),
(14, 'Kalupur BRTS', '23.02826', '72.60017', '2', 'U/D', '14'),
(15, 'Gee bazaar', '23.03136', '72.59973', '2', 'U/D', '15'),
(16, 'Prem Darwaja BRTS', '23.03730', '72.59486', '2', 'U/D', '16'),
(17, 'Delhi Darwaja BRTS', '23.03771', '72.58986', '2', 'U/D', '17'),
(18, 'Sarkari Litho Press Cabin', '23.03947', '72.58625', '2', 'U/D', '18'),
(19, 'Sarkari Litho Press BRTS', '23.04172', '72.58519', '2', 'U/D', '19'),
(20, 'Hanumanpura BRTS', '23.04496', '72.58376', '2', 'U/D', '20'),
(21, 'Gurudwara BRTS', '23.04862', '72.58239', '2', 'U/D', '21'),
(22, 'Juna Vadaj BRTS', '23.05677', '72.57167', '2', 'U/D', '22'),
(23, 'Ramapir No Tekaro BRTS', '23.06167', '72.57172', '2', 'U/D', '23'),
(24, 'N R Patel Park BRTS', '23.06636', '72.57172', '2', 'U/D', '24'),
(25, 'Bhavsar Hostel BRTS', '23.06765', '72.56864', '2', 'U/D', '25'),
(26, 'Akhbarnagar BRTS', '23.06757', '72.56384', '2', 'U/D', '26'),
(27, 'Pragatinagar BRTS', '23.06466', '72.55609', '2', 'U/D', '27'),
(28, 'Shastrinagar BRTS', '23.06223', '72.55299', '2', 'U/D', '28'),
(29, 'Jaimangal BRTS', '23.05764', '72.54935', '2', 'U/D', '29'),
(30, 'Parasnagar BRTS', '23.05555', '72.54327', '2', 'U/D', '30'),
(31, 'Parshwanath Jain Mandir BRTS', '23.05761', '72.53924', '2', 'U/D', '31'),
(32, 'Bhuyangdev BRTS', '23.06055', '72.53553', '2', 'U/D', '32'),
(33, 'Sattadhar Char Rasta BRTS', '23.06294', '72.53279', '2', 'U/D', '33'),
(34, 'Sola Bridge BRTS', '23.06490', '72.52965', '2', 'U/D', '34'),
(35, 'Science City Approach BRTS', '23.07008', '72.52302', '2', 'U/D', '35'),
(36, 'Shukan Mall', '23.07292', '72.51503', '2', 'U/D', '36'),
(37, 'Hetarth Party Plot', '23.07667', '72.50778', '2', 'U/D', '37'),
(38, 'Science City', '23.08055', '72.49973', '2', 'U/D', '38'),
(39, 'Bhadaj Circle', '23.08313', '72.49534', '2', 'U/D', '39'),
(40, 'Maninagar BRTS', '22.99780', '72.61203', '9', 'U/D', '1'),
(41, 'Swaminarayan Mandir BRTS', '22.99491', '72.61171', '9', 'U/D', '2'),
(42, 'Jawahar Chowk BRTS', '22.99519', '72.60507', '9', 'U/D', '3'),
(43, 'Bhairavnath Road BRTS', '22.99567', '72.59915', '9', 'U/D', '4'),
(44, 'Mira Cinema Char Rasta BRTS', '22.99915', '72.59325', '9', 'U/D', '5'),
(45, 'Kankariya Telephone Exchange BRTS', '23.00256', '72.59286', '9', 'U/D', '6'),
(46, 'Mangal Park BRTS', '23.00362', '72.58994', '9', 'U/D', '7'),
(47, 'Bhulabhai Park BRTS', '23.00680', '72.59115', '9', 'U/D', '8'),
(48, 'Geeta Mandir BRTS', '23.01311', '72.59138', '9', 'U/D', '9'),
(49, 'Astodiya Darwaja BRTS', '23.01699', '72.59223', '9', 'U/D', '10'),
(50, 'Astodiya Chakala BRTS', '23.01874', '72.58855', '9', 'U/D', '11'),
(51, 'Municipal Corporation Office BRTS', '23.01973', '72.58618', '9', 'U/D', '12'),
(52, 'Raikhad Char Rasta BRTS', '23.02166', '72.58266', '9', 'U/D', '13'),
(53, 'Lokamanya Tilak Bag BRTS', '23.02197', '72.58039', '9', 'U/D', '14'),
(54, 'M J Library BRTS', '23.02390', '72.57043', '9', 'U/D', '15'),
(55, 'Law Garden BRTS', '23.02398', '72.55903', '9', 'U/D', '16'),
(56, 'Vasundhara Society BRTS', '23.02783', '72.55204', '9', 'U/D', '17'),
(57, 'LD Engg. College BRTS', '23.03505', '72.54889', '9', 'U/D', '18'),
(58, 'Gulbai Tekra Approach BRTS', '23.02935', '72.54704', '9', 'U/D', '19'),
(59, 'Panjrapole Char Rasta BRTS', '23.02653', '72.54418', '9', 'U/D', '20'),
(60, 'L Colony BRTS', '23.02360', '72.54292', '9', 'U/D', '21'),
(61, 'Nehrunagar BRTS', '23.02272', '72.54168', '9', 'U/D', '22'),
(62, 'Jhansi Ki Rani BRTS', '23.02307', '72.53631', '9', 'U/D', '23'),
(63, 'Shivranjani BRTS', '23.02433', '72.53128', '9', 'U/D', '24'),
(64, 'Himmatlal Park BRTS', '23.02990', '72.53248', '9', 'U/D', '25'),
(65, 'Andhjan Mandal BRTS', '23.03464', '72.53601', '9', 'U/D', '26'),
(66, 'University BRTS', '23.03971', '72.53853', '9', 'U/D', '27'),
(67, 'Memnagar BRTS', '23.04560', '72.54246', '9', 'U/D', '28'),
(68, 'Shree Valinath Chowk BRTS', '23.04917', '72.54501', '9', 'U/D', '29'),
(69, 'Sola Cross Road BRTS', '23.05276', '72.54687', '9', 'U/D', '30'),
(70, 'Parasnagar BRTS', '23.05555', '72.54327', '9', 'U/D', '31'),
(71, 'Parshwanath Jain Mandir BRTS', '23.05761', '72.53924', '9', 'U/D', '32'),
(72, 'Bhuyangdev BRTS', '23.06055', '72.53553', '9', 'U/D', '33'),
(73, 'Sattadhar Char Rasta BRTS', '23.06294', '72.53279', '9', 'U/D', '34'),
(74, 'Sola Bridge BRTS', '23.06490', '72.52965', '9', 'U/D', '35'),
(75, 'Science City Approach BRTS', '23.07008', '72.52302', '9', 'U/D', '36'),
(76, 'Gujarat High Court', '23.07952', '72.52639', '9', 'U/D', '37'),
(77, 'Sola Bhagwat', '23.08608', '72.52838', '9', 'U/D', '38'),
(78, 'Gota Cross Road', '23.09883', '72.53171', '9', 'U/D', '39'),
(79, 'Sola Bridge BRTS', '23.06490', '72.52965', '7', 'U/D', '1'),
(80, 'S.P.Ring Road Approach BRTS', '23.02505', '72.67142', '11', 'U/D', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `amount`, `customer`, `city`) VALUES
(1, '2020-10-01', 100, 'john', 'london'),
(2, '2020-10-02', 125, 'philip', 'ohio'),
(3, '2020-10-03', 140, 'jose', 'barkley'),
(4, '2020-10-04', 160, 'tom', 'north carolina'),
(5, '2020-11-02', 128, 'duck', 'ohio'),
(6, '2020-09-04', 150, 'tucker', 'north carolina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bus`
--
ALTER TABLE `Bus`
  ADD PRIMARY KEY (`BusId`);

--
-- Indexes for table `BusStopData`
--
ALTER TABLE `BusStopData`
  ADD PRIMARY KEY (`StnId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BusStopData`
--
ALTER TABLE `BusStopData`
  MODIFY `StnId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
