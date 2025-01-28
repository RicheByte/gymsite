-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 05:33 AM
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
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `date`) VALUES
(1, 'Admin', '$2a$10$eAOPKRu5Pb20CY18pn0M5OtNakTqbedvEe/6AG8QSWuJ.33.usGYW', 'admin@example.org', '2021-09-19 14:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_replies`
--

CREATE TABLE `admin_replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `replied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calorie_leaderboard`
--

CREATE TABLE `calorie_leaderboard` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `calories_spent` int(11) NOT NULL,
  `points` int(11) GENERATED ALWAYS AS (`calories_spent` * 10) STORED,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calorie_log`
--

CREATE TABLE `calorie_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mealTime` varchar(15) NOT NULL,
  `total_calories` int(11) NOT NULL,
  `date_logged` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calorie_log`
--

INSERT INTO `calorie_log` (`id`, `user_id`, `mealTime`, `total_calories`, `date_logged`) VALUES
(1, 15, 'Lunch', 165, '2025-01-25 18:30:00'),
(2, 15, 'Lunch', 243, '2025-01-25 18:30:00'),
(3, 15, 'Lunch', 141, '2025-01-25 18:30:00'),
(4, 15, 'Snack', 299, '2025-01-25 18:30:00'),
(5, 15, '', 0, '2025-01-25 18:30:00'),
(6, 15, 'Dinner', 351, '2025-01-25 18:30:00'),
(7, 15, 'Breakfast', 364, '2025-01-25 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `calories` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `calories`, `admin_id`) VALUES
(1, 'Apple', 52, 1),
(2, 'Banana', 89, 1),
(3, 'Chicken Breast (100g)', 165, 1),
(4, 'Rice (1 cup)', 206, 1),
(5, 'Broccoli (100g)', 55, 1),
(6, 'Egg (1 large)', 78, 1),
(7, 'Milk (1 cup)', 124, 1),
(8, 'Bread (1 slice)', 79, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `publish_date` varchar(20) DEFAULT NULL,
  `publish_Time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `userID`, `title`, `description`, `publish_date`, `publish_Time`) VALUES
(4, 15, 'title-1', 'description-1', '2025-01-27', '16:49:59'),
(5, 15, 'title-2', 'description-2', '2025-01-27', '16:50:48'),
(6, 15, 'Login issue', 'I can not log to my user dashboard.How to fix that.\r\n', '2025-01-27', '17:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `slug`, `posted_by`, `admin_id`, `date`) VALUES
(1, 'Cristiano Ronaldo Returns to Manchester United', '<img class=\"w3-image\" src=\"https://assets.manutd.com/AssetPicker/images/0/0/15/128/1016013/CR_Home_21630596121972_large.jpg\" alt=\"\"><p>Manchester United is delighted to confirm the signing of Cristiano Ronaldo...</p>', 'cristiano-ronaldo-returns-to-manchester-united', 'Admin', 1, '2022-02-11 15:50:41'),
(2, 'Leo Messi signs for Paris Saint-Germain', '<p style=\"\\&quot;text-align:\" center;=\"\" \\\"=\"\"><img src=\"\\&quot;https://images.psg.media/media/209006/leo-cp.jpg?anchor=center&amp;mode=crop&amp;width=800&amp;height=500&amp;quality=80\\&quot;\" alt=\"\\&quot;\\&quot;\"><br></p><p><strong>Paris Saint-Germain is delighted to announce...wagda</strong></p><p><strong>whdgadvga</strong></p><p><strong>adhaw<br></strong></p>  ', 'leo-messi-signs-for-paris-saint-germain', 'Admin', 1, '2025-01-23 10:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `rrp`, `quantity`, `img`, `admin_id`, `date_added`) VALUES
(1, 'Smart Watch', '<p>Unique watch made with stainless steel...</p>', 29.99, 0.00, 10, 'watch.jpg', 1, '2019-03-13 17:55:22'),
(2, 'Wallet', '', 14.99, 19.99, 34, 'wallet.jpg', 1, '2019-03-13 18:52:49'),
(3, 'Headphones', '', 19.99, 0.00, 23, 'headphones.jpg', 1, '2019-03-13 18:47:56'),
(4, 'Digital Camera', '', 69.99, 0.00, 7, 'camera.jpg', 1, '2019-03-13 17:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `trainer` varchar(30) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `type`, `trainer`, `date`, `time`, `userID`) VALUES
(1, 'HIIT', 'trainer1', '2025-01-30', '13:00', 15),
(3, 'Strength Training', 'trainer2', '2025-01-26', '10:50', 15),
(4, 'Pilates', 'trainer3', '2025-01-28', '15:41', 15),
(5, 'Yoga', 'trainer4', '2025-01-28', '16:11', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(15, 'Janith', 'Harshana', 'j@gmail.com', 'user', '$2y$10$3dVkEk8BitAJREkff2lAHuAOV6m9TsArb8kO1Ep1yrBttg6V.U1Du');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_id`, `message`, `description`, `submitted_at`) VALUES
(1, 15, 'message 1', 'support description 1', '2025-01-26 18:30:00'),
(2, 15, 'message 2', 'message description 2', '2025-01-26 18:30:00'),
(3, 15, 'message 3', 'message descripton 3', '2025-01-26 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `id` int(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `weight` int(10) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `burnCalory` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`id`, `type`, `name`, `date`, `level`, `duration`, `weight`, `height`, `burnCalory`, `userID`) VALUES
(1, 'Yoga', 'workout1', '2025-01-26', 'Medium', 10, 45, 160, 300, 15),
(2, 'Pilates', 'workout2', '2025-01-26', 'High', 30, 60, 165, 400, 15),
(3, 'Pilates', 'workout3', '2025-01-26', 'Low', 25, 70, 123, 250, 15),
(4, 'HIIT', 'workout4', '2025-01-27', 'Medium', 23, 45, 153, 600, 15),
(5, 'Strength Training', 'workout5', '2025-01-27', 'Low', 40, 50, 120, 350, 15),
(6, 'Strength Training', 'workout5', '2025-01-28', 'High', 60, 187, 180, 750, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `admin_replies`
--
ALTER TABLE `admin_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `calorie_leaderboard`
--
ALTER TABLE `calorie_leaderboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `calorie_log`
--
ALTER TABLE `calorie_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`page_name`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_replies`
--
ALTER TABLE `admin_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calorie_leaderboard`
--
ALTER TABLE `calorie_leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calorie_log`
--
ALTER TABLE `calorie_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD CONSTRAINT `admin_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_messages_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admin_replies`
--
ALTER TABLE `admin_replies`
  ADD CONSTRAINT `admin_replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `user_messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_replies_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `calorie_leaderboard`
--
ALTER TABLE `calorie_leaderboard`
  ADD CONSTRAINT `calorie_leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `calorie_log`
--
ALTER TABLE `calorie_log`
  ADD CONSTRAINT `calorie_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD CONSTRAINT `user_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout`
--
ALTER TABLE `workout`
  ADD CONSTRAINT `workout_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
