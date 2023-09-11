-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 04:55 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `cost` varchar(11) NOT NULL,
  `driver` int(11) DEFAULT 0,
  `user` int(11) NOT NULL,
  `lcs_photo` varchar(255) NOT NULL,
  `lcs_no` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT current_timestamp(),
  `duration` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `category`, `vehicle_no`, `cost`, `driver`, `user`, `lcs_photo`, `lcs_no`, `from_date`, `to_date`, `time`, `duration`, `status`) VALUES
(137, 35, 'BA 4 KHA 3456', '1500', 0, 1, 'license.jpg', '01324165', '2022-09-13', '2022-09-14', '2022-09-13 21:47:17', 1, '2'),
(138, 35, 'BA 4 KHA 6789', '16000', 0, 1, 'license.jpg', '01324165', '2022-09-21', '2022-09-29', '2022-09-13 21:49:26', 8, '2'),
(139, 35, 'BA 4 KHA 3456', '9000', 0, 1, 'license.jpg', '01324165', '2022-09-23', '2022-09-29', '2022-09-13 21:50:02', 6, '2'),
(140, 35, 'BA 4 KHA 6789', '16000', 0, 1, 'license.jpg', '01324165', '2022-09-13', '2022-09-21', '2022-09-13 21:58:36', 8, '2'),
(141, 35, 'BA 4 KHA 6789', '16000', 0, 1, 'license.jpg', '01324165', '2022-09-29', '2022-10-07', '2022-09-13 22:00:14', 8, '2'),
(142, 35, 'BA 4 KHA 6789', '2000', 0, 1, 'license.jpg', '01324165', '2022-09-21', '2022-09-22', '2022-09-13 22:02:04', 1, '2'),
(143, 35, 'BA 4 KHA 3456', '1500', 0, 38, 'license.jpg', '0257465365', '2022-09-22', '2022-09-23', '2022-09-13 22:19:17', 1, '0'),
(146, 35, 'BA 4 KHA 3456', '1500', 0, 1, 'license.jpg', '01324165', '2022-09-13', '2022-09-14', '2022-09-13 23:07:18', 1, '0'),
(147, 35, 'BA 4 KHA 6789', '2000', 0, 1, 'license.jpg', '01324165', '2022-09-15', '2022-09-16', '2022-09-13 23:07:33', 1, '0'),
(148, 34, 'NA 4 KHA 5566', '', 0, 1, '', '', '2022-09-13', '2022-09-14', '2022-09-13 23:07:54', 0, '0'),
(149, 34, 'NA 4 KHA 5566', '', 0, 2, '', '', '2022-09-15', '2022-09-16', '2022-09-13 23:09:08', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `vname` varchar(255) NOT NULL,
  `index_search` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `vname`, `index_search`, `image`) VALUES
(34, 'Bike', 'TMP', 'Hornet.png'),
(35, 'Car', 'SKRP', 'car.jpg'),
(36, 'Bus', 'BS', 'bus.jpg'),
(37, 'Truck', 'TRK', 'Truck.png'),
(38, 'Pickup van', 'PKPFN', 'Ace Mega.jpg'),
(39, 'Van', 'FN', 'victa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `v_category` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `license_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `v_category`, `rate`, `email`, `password`, `address`, `phone`, `profile`, `license_no`, `license_photo`) VALUES
(30, 'Rupal Bhandari', 35, 950, 'rupal@gmail.com', 'rupal', 'Kathmandu', 9821539400, 'images.jpg', '01-08-9653574', 'License.jpg'),
(31, 'Bishnu Neupane', 34, 780, 'bishnu@gmail.com', 'bishnu', 'Butwal', 9856987400, 'prarik.jpg', '01-02-65987', 'License.jpg'),
(32, 'Sujit Pandey', 35, 850, 'sujit@gmail.com', 'sujit', 'Kausaltar', 9865978420, '', '01-05-69857', 'license1.jpg'),
(33, 'Bigyan Sharma', 35, 850, 'bigyan@mail.com', 'bigyan', 'Kawosati', 9856475605, '', '01-89-785694', 'license.jpeg'),
(34, 'Sujan chettri', 36, 1500, 'sujan@gmail.com', 'sujan', 'New Baneshwor', 9756482135, '', '01-02-89564213', 'divyalicense.png'),
(35, 'Bidur neupane', 36, 750, 'bidur@gmail.com', 'bidur', 'Balaju Kathmandu', 9756412300, '', '01-89-659874', 'license.jpeg'),
(36, 'Kamala Thapa', 35, 850, 'kamala@gmail.com', 'kamala', 'Sagabari Kausaltar', 9785461350, '', '01-02-8975641', 'license1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `license_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `password`, `profile`, `license_no`, `license_photo`) VALUES
(1, 'sandy', 'sandy@gmail.com', 'Suchatar', '9864258476', '1234', 'sandy.jpg', '01324165', 'license.jpg'),
(2, 'user', 'user@gmail.com', 'Atque laboriosam do', '9', 'user123', 'Scorpio_1.jpg', '777', 'Motorbike.svg.png'),
(3, 'hahaha', 'haha@gmail.com', 'Quia delectus cupid', '27', '1234', '', '', ''),
(4, 'Sujit Pangeni', 'sujit@gmail.com', 'Butwal', '9876543211', 'sujit1', 'images.jpg', '', ''),
(6, 'xenop', 'xenop@gmail.com', 'A nostrud aut omnis ', '9876789087', '1234', 'licences.JPG', '', ''),
(38, 'Sujit Pangeni', 'pangenisujit2134@gmail.com', 'kasaultar', '9847036758', 'sujit2134', 'sandy.jpg', '0257465365', 'license.jpg'),
(39, 'Hasad Cochran', 'kuhuwetyvo@gmail.com', 'Aut nisi velit do ex', '9632145870', 'Pa$$w0rd!', 'Scorpio.jpg', '', ''),
(40, 'Ram Bhahadur', 'ram@mail.com', 'butwal-31', '9864404745', 'ram123', 'Scorpio.jpg', '', ''),
(41, 'Demon Pinchai', 'abc@gmail.com', 'indonessia', '9813937783', 'ABC123$$$', 'tutor.jpg', '222333555', 'gardener.jpg'),
(42, 'Ira Strong', 'hary@mail.com', 'Explicabo Quae eu e', '9789076543', 'Pa$$w0rd!', 'd14s3pf7.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `v_no` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `seat` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `index_search` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `brand`, `price`, `v_no`, `category`, `photo`, `seat`, `description`, `index_search`) VALUES
(45, 'Honda Shine', 900, 'Ba 98 kha 2569', 34, 'Shine.jpg', 2, 'This is used mostly for regular purpose. Mostly used by Yough and old men.', 'HNTXN 0SSSTMSTLFRRKLRPRPSMSTLSTBYFNTLTMN'),
(46, 'Pulsar 150', 1000, 'Ba 89 Kha 7896', 34, 'Pulsar 150.jpg', 2, 'One of the best for every men.', 'PLSR ONF0BSTFRFRMN'),
(47, 'Honda city', 7500, 'Ba 99 kha 9867', 35, 'honda city.jpg', 5, 'The Honda City has 1 Diesel Engine and 1 Petrol Engine on offer. The Diesel engine is 1498 cc while the Petrol engine is 1498 cc. It is available with Manual & Automatic transmission. Depending upon the variant and fuel type the City has a mileage of 17.8', 'HNTST 0HNTSTHSTSLNJNNTPTRLNJNNFR0TSLNJNSKKHL0PTRLNJNSKKTSFLBLW0MNLTMTKTRNSMSNTPNTNKPN0FRNTNTFLTP0STHSMLJFTKM0STSSTRSLNTRKRNTHSLNK0FWT0FNTHLBSF'),
(48, 'Suzuki swift', 5000, 'ba 56 kha 7895', 35, 'Suzuki Swift Vxi.jpg', 5, 'Suzuki swift is used many people.', 'SSKSWFT SSKSWFTSSTMNPPL'),
(49, 'Hyundai Creta', 6800, 'Lu 56 jha 8965', 35, 'Creta.jpg', 5, 'This is used for family reserved by many people. family trip ', 'YNTKRT 0SSSTFRFMLRSRFTBMNPPLFMLTRP'),
(50, 'Nexon Ev', 7000, 'Ga 78 cha 7788', 35, 'Nexon Ev.jpg', 5, 'This is nexon ev which is mostly used nowadays. so it is new                                                                          ', 'NKSNF 0SSNKSNFHXSMSTLSTNWTSSTSN'),
(51, 'Yamaha', 850, 'Ba 99 kha 7894', 34, 'fz v2.jpg', 2, 'NTG                        ', 'YMH NTK'),
(52, 'yamaha fz v3', 1000, 'Lu 89 kha 323', 34, 'yamaha fz v3.png', 2, 'here is yamaha fz v3', 'YMHFSF HRSYMHFSF'),
(53, 'Winger', 5000, 'Na 65 kha 895', 39, 'winger.jpg', 14, 'This is best for short trip with friends family and other', 'WNJR 0SSBSTFRXRTTRPW0FRNTSFMLNT0R'),
(54, 'Haice', 15, 'Lu 55 kha 4568', 39, 'Hiace.jpg', 15, 'This is very comfortable and mostly people used,.', 'HS 0SSFRKMFRTBLNTMSTLPPLST'),
(55, 'Ace mega', 9500, 'ba 96 kha 2389', 38, 'Ace Mega.jpg', 3, 'This is used good and things to pickup                                     ', 'ASMK 0SSSTKTNT0NKSTPKP'),
(56, 'Mahendra Bolero', 7500, 'Ra 78 kha 5692', 38, 'Pick_up van.jpg', 5, 'This is used to travels family people and transfer from one place to another.                                    ', 'MHNTRBLR 0SSSTTTRFLSFMLPPLNTTRNSFRFRMNPLSTN0R'),
(57, 'red winger', 7500, 'Jha 89 kha 852', 39, 'red winger.jpeg', 14, 'This is ,mostly used\r\n', 'RTWNJR 0SSMSTLST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`user`),
  ADD KEY `category` (`category`),
  ADD KEY `bookings_ibfk_1` (`driver`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drivers_ibfk_1` (`v_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`v_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
