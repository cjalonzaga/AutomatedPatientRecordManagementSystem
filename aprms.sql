-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 12:56 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aprms`
--

-- --------------------------------------------------------

--
-- Table structure for table `patientmed`
--

CREATE TABLE `patientmed` (
  `med_id` int(10) NOT NULL,
  `med_date` date DEFAULT NULL,
  `med_name` varchar(50) NOT NULL,
  `med_dosage` varchar(50) NOT NULL,
  `med_timing` varchar(50) NOT NULL,
  `patient_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientmed`
--

INSERT INTO `patientmed` (`med_id`, `med_date`, `med_name`, `med_dosage`, `med_timing`, `patient_id`) VALUES
(2, '2021-02-27', 'Amoxicilin', '500mg', '2x a day', 1),
(3, '2021-02-27', 'Paracetamol', '500mg', '3x a day', 4),
(5, '2021-02-28', 'Paracetamol', '500mg', '3x a day', 3),
(6, '2021-02-28', 'Biogesic Paracetamol', '250mg', '3x a day', 2),
(8, '2021-03-14', 'Paracetamol', '100mg', '3x a day', 5),
(9, '2021-03-16', 'Amoxicilin', '100mg', '2x a day', 6),
(10, '2021-03-24', 'shabu', '1mg', '3x a day', 7);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientid` int(10) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(10) NOT NULL,
  `birthplace` text NOT NULL,
  `religion` varchar(32) NOT NULL,
  `sex` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `height` varchar(20) NOT NULL,
  `weight` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientid`, `lastname`, `firstname`, `middle`, `address`, `birthdate`, `age`, `birthplace`, `religion`, `sex`, `status`, `height`, `weight`) VALUES
(1, 'Alonzaga', 'Cris John', 'Suyom', 'Sinamay Alimodian', '1996-12-01', 24, 'Brgy. Sinamay Alimodian, Iloilo', 'Roman Catholic', 'Male', 'Single', '1.65', 56),
(2, 'Smith', 'John', 'Hitzeman', 'Boston', '2000-02-29', 21, '7 Cities Alimodian', 'Roman Catholic', 'Male', 'Widowed', '1.78', 59),
(3, 'Alonzaga', 'Ann Jenet', 'Suyom', 'Sinamay Alimodian', '2004-07-17', 32, '7 Cities Alimodian', 'Roman Catholic', 'Female', 'Single', '1.65', 59),
(4, 'Alonzaga', 'Angeline', 'Suyom', 'Sinamay Alimodian', '2002-01-11', 19, 'Brgy. Sinamay Alimodian, Iloilo', 'Roman Catholic', 'Female', 'Single', '1.50', 36),
(6, 'Alonzaga ', 'Kyle Patrick', 'Aboilo', 'Sinamay Alimodian', '2009-05-21', 11, 'Iloilo City', 'Roman Catholic', 'Male', 'Single', '1.65', 50),
(7, 'Darrell', 'Dimebag', 'Pantera', 'Texas USA', '2004-03-23', 19, 'Texas USA', 'Roman Catholic', 'Male', 'Single', '1.65', 36);

-- --------------------------------------------------------

--
-- Table structure for table `patientvitals`
--

CREATE TABLE `patientvitals` (
  `vitals_id` int(11) NOT NULL,
  `date_entry` date NOT NULL,
  `bp` varchar(30) NOT NULL,
  `rr` varchar(30) NOT NULL,
  `pr` varchar(30) NOT NULL,
  `temp` int(10) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientvitals`
--

INSERT INTO `patientvitals` (`vitals_id`, `date_entry`, `bp`, `rr`, `pr`, `temp`, `patient_id`) VALUES
(24, '2021-02-20', '110/90', '21', '32', 35, 1),
(25, '2021-02-20', '120/90', '21', '32', 36, 1),
(26, '2021-02-20', '120/90', '21', '32', 35, 1),
(27, '2021-02-20', '120/80', '27', '73', 36, 2),
(28, '2021-02-20', '120/90', '24', '78', 35, 2),
(29, '2021-02-20', '110/90', '32', '21', 36, 3),
(30, '2021-02-24', '120/80', '21', '32', 37, 2),
(31, '2021-02-24', '120/80', '23', '33', 35, 3),
(32, '2021-02-25', '12/90', '21', '32', 36, 4),
(33, '2021-02-27', '120/100', '21', '32', 35, 1),
(35, '2021-03-14', '120/90', '32', '21', 36, 5),
(36, '2021-03-16', '120/110', '21', '22', 35, 6),
(37, '2021-03-23', '120/110', '21', '24', 34, 7);

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis`
--

CREATE TABLE `patient_diagnosis` (
  `diagnosis_id` int(10) NOT NULL,
  `diagnose_date` date NOT NULL,
  `subjective` tinytext NOT NULL,
  `objective` tinytext NOT NULL,
  `assesment` tinytext NOT NULL,
  `plan` tinytext NOT NULL,
  `patient_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_diagnosis`
--

INSERT INTO `patient_diagnosis` (`diagnosis_id`, `diagnose_date`, `subjective`, `objective`, `assesment`, `plan`, `patient_ID`) VALUES
(1, '2021-03-03', 'Sample Text', 'Sample Text', 'Sample Text', 'Sample Text', 1),
(2, '2021-03-03', 'sample1', 'sample123', 'sample123', 'sample test', 1),
(4, '2021-03-03', 'sample 1234', 'Test1234', 'Test56', 'Test73', 3),
(5, '2021-03-05', 'Test Subjective', 'Test Objective', 'Test Assesment', 'Test Plan', 5),
(6, '2021-03-16', 'Sample123', 'sample', 'sample', 'sample 123', 6),
(7, '2021-03-16', 'sa', 'sa', 'ds', 'ew', 4),
(8, '2021-03-19', 'saoer', 'asd', 'uoi', 'qwer', 2),
(9, '2021-03-24', 'sample S', 'sample O', 'sample A', 'sample P', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patientmed`
--
ALTER TABLE `patientmed`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientid`);

--
-- Indexes for table `patientvitals`
--
ALTER TABLE `patientvitals`
  ADD PRIMARY KEY (`vitals_id`);

--
-- Indexes for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patientmed`
--
ALTER TABLE `patientmed`
  MODIFY `med_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patientvitals`
--
ALTER TABLE `patientvitals`
  MODIFY `vitals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  MODIFY `diagnosis_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
