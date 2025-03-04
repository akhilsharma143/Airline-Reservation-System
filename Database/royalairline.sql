-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 05:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royalairline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `name`, `password`, `email`) VALUES
(8, 'Akhil', 'Akhil Sharma', '$2y$10$ITROKfcdo8YQA5Q4hNTgs.Wp3wifQbRYEO881T/ZhzLCHxVvzXnay', 'akhilsharmahamirpur@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `username`, `password`, `name`, `email`, `phone_no`, `address`) VALUES
(1, 'Virat123', '$2y$10$KemcjiayE4yuwJbtxekIRu2Esa4.5er/OTKakHMjdOMEPGwuuYsrS', 'Virat', 'veer@gmail.com', '9618757988', 'Mumbai'),
(2, 'Akhil123', '$2y$10$GDzRi5sSkLg9xaLL82HvW./.pg8nJ0uyf5kJ/j5599aelDz7uJUwO', 'Akhil Sharma', 'akhilsharmahamirpur@gmail.com', '8219366869', 'Hamirpur'),
(3, 'chiku', '$2y$10$PsP4Qzrxdu.FkuQAS1JOY.uw44C6jeO0YsuMfMmOPm//RSje48DBe', 'cheeks', 'test@gmail.com', '874567822', 'cdac complex mohali'),
(4, 'test', '$2y$10$1VU1Cb6zG5KHFbgeS6KNC.9xuUAsyOuHQBOhPMjikIw6Qf.97AFrW', 'test', 'test@gmail.com', '73656373', 'Mumbai'),
(5, 'gopal', '$2y$10$A6mTkC1bK/SpOu.1iJVTDu5SjsTjkebN41lgAkn1rK9T6HG2q2Mzi', 'Gopal', 'gopal11@gmail.com', '784495678', 'cdac complex mohali'),
(9, 'shubham123', '$2y$10$jEu7S5tJBM7vmArWQ6aRk.Imn7hTsgoPqFoKl4J2EZStSRmYFA2v.', 'Shubham Thakur', 'shubhu123@gmail.com', '7814218760', 'Hamirpur');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `from_city` varchar(20) DEFAULT NULL,
  `to_city` varchar(20) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `seats_economy` int(5) DEFAULT NULL,
  `seats_business` int(5) DEFAULT NULL,
  `price_economy` int(10) DEFAULT NULL,
  `price_business` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_no`, `from_city`, `to_city`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `seats_economy`, `seats_business`, `price_economy`, `price_business`) VALUES
('A1', 'Banglore', 'Kolkata', '2024-01-05', '2024-01-05', '11:00:00', '12:30:00', 299, 159, 2000, 3500),
('A2', 'Banglore', 'Delhi', '2024-01-05', '2024-01-05', '12:00:00', '14:00:00', 278, 179, 3000, 4500),
('A3', 'Banglore', 'Chandigarh', '2024-01-05', '2024-01-05', '13:00:00', '14:30:00', 250, 140, 3000, 4500),
('A4', 'Chandigarh', 'Mumbai', '2024-01-05', '2024-01-05', '14:00:00', '15:30:00', 286, 170, 2500, 4000),
('A5', 'Chandigarh', 'Banglore', '2024-01-05', '2024-01-05', '15:00:00', '16:30:00', 280, 150, 2500, 4500),
('A6', 'Chandigarh', 'Goa', '2024-01-05', '2024-01-05', '17:00:00', '18:45:00', 250, 190, 2800, 4000),
('A7', 'Delhi', 'Mumbai', '2024-01-05', '2024-01-05', '10:00:00', '11:30:00', 299, 150, 4000, 5000),
('A8', 'Delhi', 'Banglore', '2024-01-05', '2024-01-05', '14:00:00', '15:40:00', 340, 130, 3000, 4000),
('A9', 'Delhi', 'Kolkata', '2024-01-05', '2024-01-05', '12:00:00', '13:30:00', 320, 120, 4000, 5600);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(20) NOT NULL,
  `pnr` varchar(15) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` int(6) NOT NULL,
  `payment_mode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `pnr`, `payment_date`, `payment_amount`, `payment_mode`) VALUES
(323515076, '8378728', '2023-12-30', 3500, 'debit card'),
(638830911, '9380215', '2024-01-01', 2500, 'credit card'),
(866577308, '3780000', '2024-01-01', 7500, 'net banking');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `pnr` varchar(20) NOT NULL,
  `date_of_reservation` date NOT NULL,
  `flight_no` varchar(20) NOT NULL,
  `journey_date` date DEFAULT NULL,
  `class` varchar(20) NOT NULL,
  `booking_status` varchar(20) NOT NULL,
  `no_of_passengers` int(10) NOT NULL,
  `customer_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`pnr`, `date_of_reservation`, `flight_no`, `journey_date`, `class`, `booking_status`, `no_of_passengers`, `customer_id`) VALUES
('3780000', '2024-01-01', 'A4', '2024-01-05', 'economy', 'CONFIRMED', 3, 9),
('8378728', '2023-12-30', 'A1', '2024-01-05', 'business', 'CONFIRMED', 1, 5),
('9380215', '2024-01-01', 'A4', '2024-01-05', 'economy', 'CONFIRMED', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_no`,`departure_date`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `Check1` (`pnr`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`pnr`),
  ADD KEY `Check` (`customer_id`),
  ADD KEY `qwerty` (`flight_no`,`journey_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `Check1` FOREIGN KEY (`pnr`) REFERENCES `ticket_details` (`pnr`);

--
-- Constraints for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `Check` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `qwerty` FOREIGN KEY (`flight_no`,`journey_date`) REFERENCES `flights` (`flight_no`, `departure_date`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
