-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 02:23 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance_list`
--

CREATE TABLE `clearance_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `clearance_owner` int(11) NOT NULL,
  `in_charge` int(11) NOT NULL,
  `office` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance_list`
--

INSERT INTO `clearance_list` (`id`, `name`, `description`, `clearance_owner`, `in_charge`, `office`, `material`, `completed`, `approved`, `date_created`) VALUES
(2, 'Shark', 'saffasf', 4, 5, 3, 2, 1, 1, '2021-08-22 21:49:42'),
(3, 'table', 'dasfsf', 4, 3, 1, 3, 0, 1, '2021-08-23 06:43:25'),
(4, 'boom', 'fdsdfsdf', 5, 4, 3, 3, 0, 1, '2021-08-23 10:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `clerance_request`
--

CREATE TABLE `clerance_request` (
  `id` int(11) NOT NULL,
  `clearance_owner` int(11) NOT NULL,
  `office_requested` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clerance_request`
--

INSERT INTO `clerance_request` (`id`, `clearance_owner`, `office_requested`, `date`, `sent`) VALUES
(2, 4, 3, '2021-08-23 08:09:53', 0),
(3, 4, 1, '2021-08-23 08:12:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `to_office` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `to_office`, `from_user`, `content`, `date`) VALUES
(1, 3, 3, 'ioiopiop', '2021-08-23 08:23:55'),
(2, 1, 4, 'hello there', '2021-08-23 08:26:37'),
(3, 3, 3, 'adadadad', '2021-08-23 11:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `in_charge` int(11) NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`, `in_charge`, `available_quantity`, `description`, `date`) VALUES
(2, 'Shark', 3, 7, 'AI memehir', '2021-08-23 05:29:02'),
(3, 'laptop', 1, 10, 'dadafaf', '2021-08-23 06:08:02'),
(4, 'bag', 1, 46, 'pc bags', '2021-08-23 06:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `to_user`, `date`, `content`, `sender`) VALUES
(1, 4, '2021-08-23 08:41:52', 'sfafsfaf', 3),
(2, 4, '2021-08-23 09:30:13', 'fsafasf', 1),
(3, 3, '2021-08-23 09:32:52', 'yyyttttttt', 1),
(7, 4, '2021-08-23 10:38:17', 'ante seweye ', 1),
(8, 4, '2021-08-23 10:38:58', 'hey', 3);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `name`, `description`) VALUES
(1, 'ioioioyu', 'jkjjkj90909'),
(3, 'HoD', 'HoD');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `work_place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `user_type`, `work_place`) VALUES
(1, 'student', 1),
(2, 'Admin', 1),
(3, 'superAdmin', 1),
(4, 'other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `office` int(11) NOT NULL,
  `incharge` int(11) NOT NULL,
  `content` text NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`office`, `incharge`, `content`, `completed`, `date`, `id`) VALUES
(1, 3, 'fsafas', 0, '2021-08-22 21:15:14', 4),
(3, 5, 'createMaterialList tommorow', 0, '2021-08-22 21:45:23', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `office` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `role`, `phone`, `password`, `office`, `user_type`) VALUES
(2, 'klklk', 2, '8908908', 'ioipo', 1, 'student'),
(3, 'esrael', 2, '121212', 'esrael', 1, 'sasa'),
(4, 'yona', 3, '0982131343', 'yona', 1, 'normal'),
(5, 'Kaleb', 2, '1234567', '123456789', 3, 'Mono');

-- --------------------------------------------------------

--
-- Table structure for table `work_place`
--

CREATE TABLE `work_place` (
  `id` int(11) NOT NULL,
  `block_no` int(11) NOT NULL,
  `office_no` int(11) NOT NULL,
  `work_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_place`
--

INSERT INTO `work_place` (`id`, `block_no`, `office_no`, `work_desc`) VALUES
(1, 512, 9, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance_list`
--
ALTER TABLE `clearance_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`clearance_owner`),
  ADD KEY `incharge` (`in_charge`),
  ADD KEY `office` (`office`),
  ADD KEY `material` (`material`);

--
-- Indexes for table `clerance_request`
--
ALTER TABLE `clerance_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clearance_owner` (`clearance_owner`),
  ADD KEY `office_requested` (`office_requested`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_office` (`to_office`),
  ADD KEY `from_user` (`from_user`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_charge` (`in_charge`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `to_user` (`to_user`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_place` (`work_place`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office` (`office`),
  ADD KEY `incharge` (`incharge`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `users_ibfk_2` (`office`);

--
-- Indexes for table `work_place`
--
ALTER TABLE `work_place`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance_list`
--
ALTER TABLE `clearance_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clerance_request`
--
ALTER TABLE `clerance_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_place`
--
ALTER TABLE `work_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clearance_list`
--
ALTER TABLE `clearance_list`
  ADD CONSTRAINT `incharge` FOREIGN KEY (`in_charge`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material` FOREIGN KEY (`material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `office` FOREIGN KEY (`office`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owner` FOREIGN KEY (`clearance_owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clerance_request`
--
ALTER TABLE `clerance_request`
  ADD CONSTRAINT `clearance_owner` FOREIGN KEY (`clearance_owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `office_requested` FOREIGN KEY (`office_requested`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`to_office`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `in_charge` FOREIGN KEY (`in_charge`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `work_place` FOREIGN KEY (`work_place`) REFERENCES `work_place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_ibfk_1` FOREIGN KEY (`office`) REFERENCES `office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `todos_ibfk_2` FOREIGN KEY (`incharge`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`office`) REFERENCES `office` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
