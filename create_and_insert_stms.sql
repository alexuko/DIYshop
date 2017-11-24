-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2016 at 04:44 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `client_address` varchar(255) NOT NULL,
  `item` varchar(500) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) NOT NULL DEFAULT 'Placed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `user_id`, `client_address`, `item`, `time`, `status`) VALUES
(54, 54, 'Galway', 'Item 233 Copper pipe Â£ 45.00<br>Item 2311 Sand Â£ 5.10<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<br>Item 8665 Bathroom sink Â£ 250.00<', '2016-12-09 00:39:08', 'delivered'),
(55, 54, '', 'Item 111 brick Â£ 6.00<br>Item 111 brick Â£ 6.00<br>Item 112 Water Pipe Set Â£ 10.52<br>Item 111 brick Â£ 6.00<br>Item 644 Hammer Â£ 2.90<br>Item 644 Hammer Â£ 2.90<br>Item 644 Hammer Â£ 2.90<br>Item 644 Hammer Â£ 2.90<br>Item 244 Cement Â£ 5.20<br>Item 244 Cement Â£ 5.20<br>Item 8665 Bathroom sink Â£ 250.00<br>', '2016-12-29 11:17:49', 'Placed'),
(56, 54, 'spain', 'Item 113 Circuit Braker Â£ 5.50<br>Item 8665 Bathroom sink Â£ 250.00<br>', '2016-12-29 11:24:08', 'Placed'),
(57, 54, 'spain', 'Item 112 Water Pipe Set Â£ 10.52<br>Item 113 Circuit Braker Â£ 5.50<br>Item 8665 Bathroom sink Â£ 250.00<br>', '2016-12-29 11:29:26', 'Placed'),
(58, 54, 'spain', 'Item 111 brick Â£ 6.00<br>Item 112 Water Pipe Set Â£ 10.52<br>', '2016-12-29 11:41:12', 'Placed'),
(59, 54, 'spain', 'Item 111 brick Â£ 6.00<br>', '2016-12-29 12:26:23', 'Placed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(45) DEFAULT NULL,
  `p_description` varchar(255) DEFAULT NULL,
  `p_price` decimal(5,2) DEFAULT NULL,
  `p_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_description`, `p_price`, `p_img`) VALUES
(111, 'brick', 'one  brick', '6.00', 'images/brick.png'),
(112, 'Water Pipe Set', 'One full set of water pipes', '10.52', 'images/waterpipes.png'),
(113, 'Circuit Braker', 'one simple circuit braker', '5.50', 'images/cir_brk.png'),
(233, 'Copper pipe', '25FT of copper pipe ½ inch', '45.00', 'images/copper-pipes.png'),
(244, 'Cement', '25KG bag of cement', '5.20', 'images/cement.png'),
(644, 'Hammer', 'One BlackSpur Hammer', '2.90', 'images/hammer.png'),
(2311, 'Sand', 'One 25KG bag of sand', '5.10', 'images/sandbag.png'),
(8665, 'Bathroom sink', 'One complete bathroom sink', '250.00', 'images/sink.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `contact_number` int(100) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `upassword` varchar(25) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `surname`, `address`, `email`, `contact_number`, `username`, `upassword`, `type`) VALUES
(49, 'Alejandro', 'Rivera', 'Dublin 3', 'alextek1885@hotmail.com', 894841490, 'alex', 'iQ¡ŠåI{ph', 'Admin'),
(52, 'Roberto', 'Rivera', 'D3', 'alex@gmail.com', 56565656, 'rob', '%ÕZÒƒª@\nôdÇmq<­', 'Staff'),
(53, 'dennys', 'Rivera', 'Dublin 3', 'dennys_r@gmail.com', 45454545, 'den', 'iQ¡ŠåI{ph', 'D_staff'),
(54, 'victor', 'Higueras', 'spain', 'vic@gmail.com', 89898, 'vic', 'iQ¡ŠåI{ph', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
