-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 12:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_food_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `full_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `full_name`) VALUES
(1, 'Bijay123@gmail.com', '$2y$10$SUgeekxxB1MdXVLcPjz7HOYqpmoyz8kzY7Fk1/ctBF2ItA1qHMRKu', 'Bijay');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `price`, `image_path`) VALUES
(36, 'Ham Burger', ' A hamburger is a popular type of sandwich consisting of a cooked ground meat patty, usually beef, placed between two slices of a bun. ', 199, 'images/Burger.jpg'),
(37, 'Chicken Roast', ' Chicken roast is a flavorful and savory dish made from chicken that is seasoned, marinated, and then roasted to perfection. ', 599, 'images/Roast Chicken.jpg'),
(38, 'Bucatini Pasta', ' Bucatini pasta is a type of Italian pasta that is long, thick, and hollow in the center, resembling a thick spaghetti but with a hollow core running through its length.', 499, 'images/Pasta.jpg'),
(39, 'Chicken Wings', 'Chicken wings are a popular appetizer or main dish made from the chicken wing joint and typically served either fried or baked.', 699, 'images/wings.jpg'),
(41, 'Buff MoMo', 'Momo is a type of dumpling filled with a variety of ingredients such as seasoned meat, vegetables, or cheese, enclosed in a thin dough wrapper.', 189, 'images/MOMO.jpg'),
(42, 'Mixed Pizza', ' A mixed pizza is a delightful creation that combines various toppings, flavors, and textures to create a delicious culinary experience.', 799, 'images/Pizza.jpg'),
(51, 'Classic Burger', ' A classic burger typically consists of a beef patty, lettuce, tomato, onion, pickles, cheese (usually American cheese), and condiments such as ketchup, mustard, and mayonnaise, all sandwiched between a sesame seed bun.', 299, 'images/miXED BURGER.jpg'),
(57, 'Classic Sandwish', ' A classic sandwich, beloved for its simplicity and versatility, is a culinary canvas where bread becomes a vessel for endless possibilities.', 225, 'images/sandwishes.jpg'),
(58, 'Soup noddles', ' Soup noodles are a comforting and satisfying dish enjoyed in many cultures around the world. They typically consist of noodles served in a flavorful broth, often accompanied by various toppings and garnishes', 145, 'images/Soup noddles.jpg'),
(60, 'Grilled Chicken ', ' Grilled chicken is a culinary delight characterized by tender, juicy chicken that\'s been cooked over an open flame or on a grill. It\'s a versatile dish that can be seasoned and prepared in numerous ways to suit different tastes and cuisines.', 799, 'images/Grilled chicken.jpg'),
(64, 'Mixed Pizza', ' Mixed pizza is a delightful combination of various toppings on a single pizza crust. It\'s a versatile option that allows you to enjoy a variety of flavors in one delicious bite.', 789, 'images/hariyo Pizza.jpg'),
(65, 'Mixed Chowmein', ' Mixed Chow Mein is a delightful and versatile dish that combines stir-fried noodles with a variety of vegetables, meats, and flavorful sauces.', 189, 'images/hariyo chomein.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `status`, `total`, `location`) VALUES
(2, 2, '2024-04-21 12:58:58', 'pending', 0.00, 'Basantapur'),
(3, 2, '2024-04-21 12:59:52', 'pending', 0.00, 'Basantapur'),
(23, 14, '2024-04-26 03:09:15', 'pending', 2097.00, 'Basantapur'),
(24, 16, '2024-04-26 07:11:00', 'pending', 543.00, 'Basantapur'),
(25, 17, '2024-04-26 09:41:54', 'pending', 597.00, 'Basantapur');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `quantity`) VALUES
(26, 23, 39, 3),
(27, 24, 58, 1),
(28, 24, 36, 2),
(29, 25, 36, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `r_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `r_comment` varchar(200) NOT NULL,
  `r_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`r_id`, `u_id`, `r_comment`, `r_datetime`) VALUES
(6, 16, 'This is awesome restaurant', '2024-04-25 16:26:17'),
(7, 2, 'Their Services are really awesome', '2024-04-25 16:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `phone`, `fullname`) VALUES
(1, 'bj@gmail.com', '$2y$10$0NJ5VffxvKVWwmbS5FIkZuQc5FGewqX99efu10MApePIcwTav364W', 9800000000, 'bj '),
(2, 'satish@gmail.com', '$2y$10$bUvg8WHSKjCdSD5g.xdhGeFZqvYeM4n43lOresRKNl7gngCKtcz0G', 9811111111, 'Satish Chaudhary'),
(11, 'rohan12@gmail.com', '$2y$10$OWkLUXiLQD2GApbYXmE4duphYXhInToy1BNuWndmu/mdnSca5QdEO', 9877777777, 'Rohan'),
(12, 'Bijay88@gmail.com', '$2y$10$/7OCw5iu2t4fTZJqxJ1EGuGj4SjzmByAsz0JyvXmZbXO5r84e.I2O', 9812345678, 'Bijay'),
(13, 'kabindrakoirala@gmai.com', '$2y$10$7OfW.H9XMCkiLtk4xsDbw.khLsDskeKQn//vHyEhhs/IzaeafHnKC', 9876543210, 'kabindra koirala'),
(14, 'Suman@123', '$2y$10$B6xmy2dGY.985/YwlyEl0uFtR6RaC/6wcKurwGkwhDO9tOCQIXGKG', 9800000000, 'Suman'),
(15, 'bj12@gmail.com', '$2y$10$w5NhuefTM8JaNBC6HMrWA.MXrl1RWgW/R5hwRsGxuMdkYeOyXKfoe', 9811111111, 'bijay'),
(16, 'Ajay12@gmail.com', '$2y$10$Q.QgHBQ4MB5FMz/B9x4I7e.QEkOSnLLfoK/er.TZhJ0jobP0RrLkS', 9843467921, 'Ajay Gurung'),
(17, 'rohan@123', '$2y$10$kjjBmac1xdnuWVZ.UmXOC.fsf7PbAyGFm3m/DmzvI5AmtlCWLOcue', 9849414983, 'Rohan ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `FK_review_user` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_review_user` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
