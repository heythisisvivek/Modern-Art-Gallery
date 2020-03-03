-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 06:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artgallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(250) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `profilepic` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `sname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `profilepic`, `name`, `sname`, `email`, `gender`, `city`, `country`, `password`) VALUES
(1, '43235250', '', 'Admin', 'User', 'admin@gmail.com', 'Male', 'Mumbai', 'India', '$2y$10$rCp1Bzm.139Ypzu0Z4edsOIEz4wXQQUodWTpH0gNVsjK3V7Vzvf8G');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `iid` varchar(250) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `arttitle` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `artprice` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `cid` varchar(250) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `iid` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `cid`, `uid`, `iid`, `name`, `email`, `comment`, `date`) VALUES
(14, '1483643101', '1897465253', '549397793', 'Dummy User', 'dummy@gmail.com', 'Nice Drawing', '01/03/20'),
(15, '1662754704', '1897465253', '877910333', 'Dummy User', 'dummy@gmail.com', 'One of the best artist', '01/03/20'),
(16, '800666023', '744207611', '94833186', 'sam michael', 'sam@gmail.com', 'Nice Art', '03/03/20');

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE `purchased` (
  `id` int(250) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `iid` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`id`, `uid`, `iid`, `email`, `date`) VALUES
(9, '1178173478', '914242864', 'dummy@gmail.com', '03/03/20'),
(10, '1178173478', '877910333', 'sam@gmail.com', '03/03/20'),
(11, '1178173478', '950669509', 'sam@gmail.com', '03/03/20'),
(12, '1178173478', '94833186', 'sam@gmail.com', '03/03/20');

-- --------------------------------------------------------

--
-- Table structure for table `userimages`
--

CREATE TABLE `userimages` (
  `id` int(250) NOT NULL,
  `uid` int(250) NOT NULL,
  `iid` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `userImage` varchar(250) NOT NULL,
  `imagetitle` varchar(250) NOT NULL,
  `imagedescription` varchar(1000) NOT NULL,
  `imageprice` varchar(250) NOT NULL,
  `imagecategory` varchar(250) NOT NULL,
  `updateDate` varchar(250) NOT NULL,
  `imagevisit` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userimages`
--

INSERT INTO `userimages` (`id`, `uid`, `iid`, `email`, `userImage`, `imagetitle`, `imagedescription`, `imageprice`, `imagecategory`, `updateDate`, `imagevisit`) VALUES
(17, 1178173478, 914242864, 'admin@gmail.com', 'images/siteUploads/1.jpg', 'Street Art by James Wilson', 'Street art is visual art created in public locations, usually unsanctioned artwork executed outside of the context of traditional art venues. Other terms for this type of art include &quot;independent public art&quot;, &quot;post-graffiti&quot;, and &quot;neo-graffiti&quot;, and is closely related to guerrilla art.', '8845', 'Painting', '01/03/2020', 2),
(18, 1178173478, 877910333, 'admin@gmail.com', 'images/siteUploads/2.jpg', 'Heath Andrew Ledger drawing from joker', 'Heath Andrew Ledger was an Australian actor, photographer, and music video director. After performing roles in several Australian television and film productions during the 1990s, Ledger left for the United States in 1998 to further develop his film career', '87554', 'Drawing', '01/03/2020', 26),
(19, 1178173478, 94833186, 'admin@gmail.com', 'images/siteUploads/3.jpeg', 'Companion dog with his kid', 'A companion dog is a dog that does not work, providing only companionship as a pet, rather than usefulness by doing specific tasks. Many of the toy dog breeds are used only for the pleasure of their company, not as workers.', '984564', 'Drawing', '01/03/2020', 9),
(20, 1178173478, 1848809828, 'admin@gmail.com', 'images/siteUploads/4.jpg', 'Aabstract faces artists', 'Shop Abstract Faces Paintings created by thousands of emerging artists from around the world. Buy original art worry free with our 7 day money back guarantee.', '51164', 'Design', '01/03/2020', 5),
(21, 1178173478, 549397793, 'admin@gmail.com', 'images/siteUploads/8.jpeg', 'Taj mahal pencil drawings', 'The Taj Mahal is an ivory-white marble mausoleum on the south bank of the Yamuna river in the Indian city of Agra. It was commissioned in 1632 by the Mugha...', '6489', 'Drawing', '01/03/2020', 23),
(22, 1178173478, 950669509, 'admin@gmail.com', 'images/siteUploads/5.Jpg', 'Krishna Painting', 'Krishna is a major deity in Hinduism. He is worshipped as the eighth avatar of the god Vishnu and also as the supreme God in his own right.He is considered as ...', '4989', 'Painting', '01/03/2020', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `profilepic` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `seller` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `profilepic`, `name`, `sname`, `email`, `gender`, `city`, `country`, `password`, `seller`) VALUES
(12, '1178173478', 'images/userProfiles/tv-408-461607.png', 'admin', 'user', 'admin@gmail.com', 'Male', 'Mumbai', 'India', '$2y$10$DupDOfmgceOz4AZ9kaFouOmCa93TN0aNhpt7p8XDljiy0fzZ6Yaty', 1),
(13, '1897465253', '', 'Dummy', 'User', 'dummy@gmail.com', 'Male', 'Mumbai', 'India', '$2y$10$pvfohp2mHTojJ1yNvjic5.Hp2Yf4ydTFA6fW/bSAutlZjErA6FRYe', 0),
(14, '744207611', 'images/userProfiles/Pray.jpg', 'sam', 'michael', 'sam@gmail.com', 'Male', 'Mumbai', 'India', '$2y$10$i3nML56xPuMDqntj0nO.8eIRedkAFvHf3pzEtPzkaSDjrfO/YzinO', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userimages`
--
ALTER TABLE `userimages`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userimages`
--
ALTER TABLE `userimages`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
