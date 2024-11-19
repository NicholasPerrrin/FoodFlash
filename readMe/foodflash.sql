-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 08:26 PM
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
-- Database: `foodflash`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `customerID`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `cartitemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartID`, `itemID`, `cartitemID`) VALUES
(1, 10, 1),
(1, 10, 2),
(2, 1, 3),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `itemID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `itemName` varchar(30) NOT NULL,
  `price` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`itemID`, `restaurantID`, `itemName`, `price`) VALUES
(1, 1, 'tacos', 3.00),
(3, 1, 'Fire-Grilled Tacos', 20.00),
(5, 2, 'Fire-Grilled Tacos', 20.00),
(6, 1, 'Smoky Chipotle Quesa', 15.00),
(7, 2, 'Smoky Chipotle Quesa', 15.00),
(8, 1, 'Tres Leches Flan', 8.00),
(9, 2, 'Tres Leches Flan', 8.00),
(10, 4, 'Maple Bacon Burger', 17.00),
(11, 4, 'All-Day Loaded Break', 12.00),
(12, 4, 'Old-School Banana Split', 8.00),
(13, 5, 'Dragon Fire Roll', 8.00),
(14, 5, 'Matcha Mochi Ice Cream', 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `timePlaced` datetime NOT NULL,
  `ETA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurantID` int(11) NOT NULL,
  `restaurantName` varchar(30) NOT NULL,
  `estimatedPrice` decimal(19,2) NOT NULL,
  `restaurantLocation` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `descript` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurantID`, `restaurantName`, `estimatedPrice`, `restaurantLocation`, `category`, `descript`) VALUES
(1, 'Mexican Fiesta', 15.00, 'Detroit, MI', 'Mexican', 'A cozy spot with adobe walls, hand-painted tiles, and papel picado. The air smells of fresh tortillas and meats, while soft mariachi music sets a warm, welcoming vibe.'),
(2, 'My Mexican Restaurant', 20.00, 'Warren, MI', 'Mexican', 'Chic decor with neon accents and modern art. The open kitchen highlights chefs crafting fusion dishes, blending authentic flavors with a contemporary twist. A lively, urban atmosphere.'),
(4, 'The Greasy Spoon', 15.00, 'Warren, MI', 'American', ''),
(5, 'Sakura Blossom Bistro', 20.00, 'Warren, MI', 'Sushi', '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `customerID`, `restaurantID`, `rating`, `text`) VALUES
(1, 4, 1, 1, 'this is a really good place!');

-- --------------------------------------------------------

--
-- Table structure for table `savedorder`
--

CREATE TABLE `savedorder` (
  `savedOrderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customerID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customerID`, `username`, `email`, `password`) VALUES
(4, 'nperrin1', 'perrinnick7@gmail.com', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartitemID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurantID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`);

--
-- Indexes for table `savedorder`
--
ALTER TABLE `savedorder`
  ADD PRIMARY KEY (`savedOrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `savedorder`
--
ALTER TABLE `savedorder`
  MODIFY `savedOrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
