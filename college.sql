-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 07:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_fees`
--

CREATE TABLE `additional_fees` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_fees`
--

INSERT INTO `additional_fees` (`id`, `department`, `fee`, `created_at`, `updated_at`) VALUES
(3, 'Library', 3000.00, '2024-12-24 10:24:05', '2024-12-24 10:24:05'),
(4, 'hostel', 35000.00, '2024-12-24 10:24:29', '2024-12-24 10:24:29'),
(9, 'lab', 13000.00, '2025-02-13 19:20:10', '2025-02-13 19:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `bb-bcs`
--

CREATE TABLE `bb-bcs` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bb-bcs`
--

INSERT INTO `bb-bcs` (`id`, `category`, `fee`) VALUES
(1, 'ebc', 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `bba`
--

CREATE TABLE `bba` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bba`
--

INSERT INTO `bba` (`id`, `category`, `fee`) VALUES
(3, 'NT', 14000.00),
(6, 'OBC', 140000.00);

-- --------------------------------------------------------

--
-- Table structure for table `bba-i`
--

CREATE TABLE `bba-i` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bba-i`
--

INSERT INTO `bba-i` (`id`, `category`, `fee`) VALUES
(1, 'obc', 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `be`
--

CREATE TABLE `be` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `be`
--

INSERT INTO `be` (`id`, `category`, `fee`) VALUES
(1, 'obc', 120000.00);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `fee`) VALUES
(7, 'BBA', 25000.00),
(27, 'MBA', 25000.00),
(29, 'MCA', 120000.00),
(32, 'BBA-I', 25000.00),
(33, 'BB-BCS', 510000.00),
(34, 'BE', 140000.00);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`, `reset_token`) VALUES
(1, 'admin', '123qwe', 'someshwar@manasvi.tech\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mba`
--

CREATE TABLE `mba` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mba`
--

INSERT INTO `mba` (`id`, `category`, `fee`) VALUES
(1, 'open', 130000.00),
(2, 'obc', 70000.00);

-- --------------------------------------------------------

--
-- Table structure for table `mca`
--

CREATE TABLE `mca` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `paid_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `course_name`, `category`, `total_fee`, `paid_fee`, `remaining_fee`) VALUES
(4, 'somesh', 'MCA', 'obc', 250000.00, 114159.00, 135841.00),
(6, 'ramesh', 'MBA', 'obc', 82000.00, 22000.00, 60000.00),
(7, 'raju', 'BBA-I', 'obc', 28000.00, 20000.00, 8000.00),
(8, 'rahula', 'MBA', 'obc', 85000.00, 23000.00, 62000.00),
(13, 'sam', 'MCA', 'obc', 65000.00, 15000.00, 50000.00),
(14, 'dipak yadav', 'MCA', 'open', 48222.00, 12000.00, 36222.00),
(15, 'ritesh', 'MCA', 'open', 120000.00, 12000.00, 108000.00),
(22, 'omkar', 'BBA', 'NT', 14000.00, 13000.00, 1000.00),
(24, 'Akash', 'MCA', 'open', 63000.00, 63000.00, 0.00),
(25, 'sidhu', 'BBA', 'obc', 191000.00, 50000.00, 141000.00),
(26, 'vZ', 'BB-BCS', 'ebc', 28000.00, 12000.00, 16000.00),
(27, 'suresh', 'BE', 'obc', 155000.00, 0.00, 155000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paid_fee` decimal(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `student_id`, `paid_fee`, `transaction_date`) VALUES
(21, 4, 25000.00, '2024-12-24 10:08:54'),
(24, 7, 20000.00, '2024-12-24 11:26:27'),
(25, 6, 20000.00, '2024-12-24 11:48:29'),
(26, 8, 21000.00, '2024-12-24 12:52:26'),
(27, 4, 12000.00, '2024-12-24 13:02:14'),
(29, 14, 12000.00, '2024-12-25 10:59:33'),
(31, 4, 12.00, '2024-12-28 12:32:46'),
(32, 4, 12000.00, '2024-12-28 12:57:39'),
(33, 4, 556.00, '2024-12-28 13:01:32'),
(34, 24, 50000.00, '2024-12-30 14:47:15'),
(35, 4, 14.00, '2024-12-30 16:13:50'),
(36, 4, 555.00, '2025-01-21 10:11:41'),
(37, 4, 22.00, '2025-01-21 10:12:45'),
(38, 25, 50000.00, '2025-02-13 20:21:31'),
(39, 22, 13000.00, '2025-02-17 06:06:57'),
(40, 13, 15000.00, '2025-02-17 12:46:53'),
(41, 8, 1000.00, '2025-02-17 12:48:26'),
(42, 8, 1000.00, '2025-02-17 12:49:43'),
(43, 4, 50000.00, '2025-02-17 13:10:37'),
(44, 4, 15000.00, '2025-02-17 13:14:21'),
(45, 4, 12000.00, '2025-02-17 13:16:02'),
(46, 24, 13000.00, '2025-02-17 15:53:28'),
(47, 6, 2000.00, '2025-02-19 07:12:08'),
(48, 26, 12000.00, '2025-02-19 11:22:37'),
(49, 4, 12000.00, '2025-02-20 12:32:53'),
(50, 15, 12000.00, '2025-02-21 12:31:25'),
(51, 4, 10000.00, '2025-02-21 12:44:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_fees`
--
ALTER TABLE `additional_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bb-bcs`
--
ALTER TABLE `bb-bcs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bba`
--
ALTER TABLE `bba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bba-i`
--
ALTER TABLE `bba-i`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `be`
--
ALTER TABLE `be`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mba`
--
ALTER TABLE `mba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mca`
--
ALTER TABLE `mca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_fees`
--
ALTER TABLE `additional_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bb-bcs`
--
ALTER TABLE `bb-bcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bba`
--
ALTER TABLE `bba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bba-i`
--
ALTER TABLE `bba-i`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `be`
--
ALTER TABLE `be`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mba`
--
ALTER TABLE `mba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mca`
--
ALTER TABLE `mca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
