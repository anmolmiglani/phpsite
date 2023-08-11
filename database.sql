-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 01:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Name` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Pic` varchar(100) NOT NULL,
  `UserType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Name`, `Phone`, `Username`, `Password`, `Pic`, `UserType`) VALUES
('Admin', '9876543210', 'admin@gmail.com', '$2y$10$gHa0T97gQ.FW7DHMBm7sB.1TUzBmMUuJS3ENMpCN/EFu.c0KXwhN2', '1690025061teadybear.jpg', 'admin'),
('Piyush', '6780123454', 'piyush@gmail.com', '$2y$10$C4YdP98xtw19jsNi0Bua5ueVBVPj0J1sBPoezE9rUniaayg0k5lXu', '1690879986teadybear.jpg', 'admin'),
('Sonia', '8847235716', 'sonia123@gmail.com', '$2y$10$Z2eP7zsfOhqAY2kewSx3A.CyBGshLvp2tCJazOmwh3/bp/KpvQybO', '1690881768teaddybear2.jfif', 'normal'),
('Varun', '9087654321', 'varun@gmail.com', '$2y$10$ke46QVFkgGZCiVHGNXc8MObJx/Hv5a7J/X6B/FcCh7OmztqA4Fwwe', '1690803078gift2.jfif', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
