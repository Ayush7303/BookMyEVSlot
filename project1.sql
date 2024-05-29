-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 08:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingtb`
--

CREATE TABLE `bookingtb` (
  `bookingid` int(11) NOT NULL,
  `slotid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `vehicleid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` time NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slottb`
--

CREATE TABLE `slottb` (
  `slotid` int(11) NOT NULL,
  `stationid` int(11) NOT NULL,
  `voltage` float NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stationtb`
--

CREATE TABLE `stationtb` (
  `stationid` int(11) NOT NULL,
  `stationname` varchar(200) NOT NULL,
  `location` varchar(2000) NOT NULL,
  `city` varchar(200) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stationtb`
--

INSERT INTO `stationtb` (`stationid`, `stationname`, `location`, `city`, `latitude`, `longitude`, `available`) VALUES
(1, 'ST01', 'Central Zone Fly-Over Bridge,Millennium Market Pay & Use Toilet , Pillar No. 35, Ring Road', 'surat', 21.188767, 72.840551, 1),
(2, 'ST02', 'Open Plot Near School No. 81, Una Pani Road, Lal Darwaja', 'surat', 21.205683, 72.835822, 1),
(3, 'ST03', 'Open Plot beside Gopi-Talav Multi Level Parking, Navsari Bazar', 'surat', 21.190002, 72.827912, 1),
(4, 'ST04', 'Open Plot near D - Mart, Pandesara', 'surat', 21.148862, 72.816117, 1),
(5, 'ST05', 'Multilevel Parking beside Sardar Smruti Bhavan, Varachha', 'surat', 21.213454, 72.850707, 1),
(6, 'ST06', 'Below Fly Over Bridge,Opp. Nana Varachha Health Center, Nana Varachha', 'surat', 21.2262342, 72.8896539, 1),
(7, 'ST07', 'Sarthana Nature Park,Nr Sarthana Jakat Naka, Surat Kamrej Road', 'surat\r\n', 21.230115, 72.898626, 1),
(8, 'ST08', 'Shayama Prasad Mukhrji Community Hall, Parvat Patiya', 'surat', 21.1961694704084, 72.8607034975559, 1),
(9, 'ST09', 'Muli-Level Parking, Behind Millenium Textile Market, Umarwada', 'surat', 21.188157, 72.843975, 1),
(10, 'ST10', 'Katargam Community Hall, Vastadevi Road, Katargam', 'surat', 21.21715, 72.834451, 1),
(11, 'ST11', 'Open Plot near Causeway, Katargam', 'surat', 21.220258, 72.807234, 1),
(12, 'ST12', 'Kansanagar Sports Ground, Near Katargam Lake Garden,Katargam', 'surat', 21.227545, 72.837285, 1),
(13, 'ST13', 'SMC Health Club,Ved Road', 'surat', 21.2210998097565, 72.8220625435957, 1),
(14, 'ST14', 'Below Parley Point Bridge In front of 24 Carat Mithai', 'surat', 21.1748020639742, 72.7945630146005, 1),
(15, 'ST15', 'South East Zone Office, SMC, Model Town Road, Dumbhal', 'surat', 21.1837354630496, 72.8600003975557, 1),
(16, 'ST16', 'Open Plot near Valentine Theatre, near Sai Mandir, Opp. Central Mall, Dumas Road', 'surat', 21.154171, 72.763613, 1),
(17, 'ST17', 'Parking Area of Night Food Plaza,Behind Lake view Garden,Piplod', 'surat', 21.163531, 72.781095, 1),
(18, 'ST18', 'Below Anu-Vrat Dwar Fly-Over Bridge, Udhana Magdalla Road', 'surat', 21.159934, 72.796685, 1),
(19, 'ST19', 'Vesu Fire station, VIP road, Vesu', 'surat', 21.1419556794449, 72.781616897555, 1),
(20, 'ST20', 'Open Plot beside Palanpore BRTS Bus Depot, Palanpore', 'surat', 21.206089, 72.773898, 1),
(21, 'ST21', 'Jyotindra Dave Udhyan,Opp. Jogani Nagar, Honey Park Road,Adajan', 'surat', 21.202926, 72.791407, 1),
(22, 'ST22', 'Below Star bazar bridge, Surat Hazira Road, Adaja', 'surat', 21.18641, 72.793724, 1),
(23, 'ST23', 'Adajan Sports Complex, Opp. Atman Park, Near L.P. Savani Road, Adajan', 'surat', 21.1959980525118, 72.7878081839325, 1),
(24, 'ST24', 'Sanjeevkumar Auditorium,Behind Rajhans Cinema ,Pal', 'surat', 21.1858096078833, 72.7847254236254, 1),
(25, 'ST25', 'Jahangirpura Community Hall Parking Area', 'surat', 21.2295369979381, 72.7900131896354, 1),
(33, 'ST26', 'rustmapura', 'surat', 21.5, 72.9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertb`
--

CREATE TABLE `usertb` (
  `USERID` int(11) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `EMAIL` varchar(300) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `MOBILENO` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertb`
--

INSERT INTO `usertb` (`USERID`, `USERNAME`, `EMAIL`, `PASSWORD`, `MOBILENO`) VALUES
(1, 'Ayush', 'ayushrana07@gmail.com', 'Ayushr@n@07', '6353348637'),
(10, 'jeshanpatel', 'pateljesu1510@gmail.com', 'Jeshan@07', '7069170879'),
(13, 'wizard07', 'wizard07@gmail.com', 'Wizard@07', '6532145982'),
(29, 'dhwani', 'dhwani1@gmail.com', 'Dhwani07@', '5236598744');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletb`
--

CREATE TABLE `vehicletb` (
  `VEHICLEID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `VEHICLENAME` varchar(200) NOT NULL,
  `VEHICLENUMBER` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicletb`
--

INSERT INTO `vehicletb` (`VEHICLEID`, `USERID`, `VEHICLENAME`, `VEHICLENUMBER`) VALUES
(2, 13, 'TATA NEXON', 'GJ05CR0707'),
(3, 13, 'OLA', 'GJ04AH1234'),
(4, 13, 'TATA NEXON', 'DH04FG5647');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingtb`
--
ALTER TABLE `bookingtb`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `ck3` (`slotid`),
  ADD KEY `ck4` (`userid`),
  ADD KEY `ck5` (`vehicleid`);

--
-- Indexes for table `slottb`
--
ALTER TABLE `slottb`
  ADD PRIMARY KEY (`slotid`),
  ADD KEY `ck2` (`stationid`);

--
-- Indexes for table `stationtb`
--
ALTER TABLE `stationtb`
  ADD PRIMARY KEY (`stationid`);

--
-- Indexes for table `usertb`
--
ALTER TABLE `usertb`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `vehicletb`
--
ALTER TABLE `vehicletb`
  ADD PRIMARY KEY (`VEHICLEID`),
  ADD KEY `c1` (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingtb`
--
ALTER TABLE `bookingtb`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slottb`
--
ALTER TABLE `slottb`
  MODIFY `slotid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stationtb`
--
ALTER TABLE `stationtb`
  MODIFY `stationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `usertb`
--
ALTER TABLE `usertb`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `vehicletb`
--
ALTER TABLE `vehicletb`
  MODIFY `VEHICLEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingtb`
--
ALTER TABLE `bookingtb`
  ADD CONSTRAINT `ck3` FOREIGN KEY (`slotid`) REFERENCES `slottb` (`slotid`),
  ADD CONSTRAINT `ck4` FOREIGN KEY (`userid`) REFERENCES `usertb` (`USERID`),
  ADD CONSTRAINT `ck5` FOREIGN KEY (`vehicleid`) REFERENCES `vehicletb` (`VEHICLEID`);

--
-- Constraints for table `slottb`
--
ALTER TABLE `slottb`
  ADD CONSTRAINT `ck2` FOREIGN KEY (`stationid`) REFERENCES `stationtb` (`stationid`);

--
-- Constraints for table `vehicletb`
--
ALTER TABLE `vehicletb`
  ADD CONSTRAINT `c1` FOREIGN KEY (`USERID`) REFERENCES `usertb` (`USERID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
