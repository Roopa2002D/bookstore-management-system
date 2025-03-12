-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 07:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookcategory`
--

CREATE TABLE `bookcategory` (
  `id` int(11) NOT NULL,
  `category` text DEFAULT NULL,
  `addedtypes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookcategory`
--

INSERT INTO `bookcategory` (`id`, `category`, `addedtypes`) VALUES
(11, 'Education', 'An awesome collection of  Educational books! that boost our knowledge'),
(13, 'Motivational ', 'you can motivate yourself with the amazing collection of motivational books '),
(15, 'History', 'All  kind of Historical books are available! '),
(16, 'Mythology', 'Get know about our culture and tradition......'),
(17, 'Autobiography', 'Get to know about famous personalities life. '),
(19, 'Romantic Novels', 'Favorite Category for Fiction lovers!!'),
(20, 'Thriller', ' Boom! Mind blowing thriller books ! what is waiting for, Do purchase and enjoy!'),
(22, 'Women', 'Books based on Women and Women empowerment.!'),
(23, 'Horror', 'Books  that are paranormal and Haunted...'),
(24, 'Children', 'Comics, Rhymes and Stories for your children.'),
(25, 'Poetry', 'Obsessed with poem, here are some Poetry books..'),
(26, 'Science Fiction', 'The Books that have advanced concepts of science and technology, there you can learn heavily'),
(27, 'Comedy', 'Humor, Laugh Out Loud !!'),
(28, 'Cook', 'Books that boost our Food Habits, Diet plans and everything about Food! '),
(30, 'Business/Economics', 'Improve your Business knowledge by these books. ');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bookid` varchar(100) DEFAULT NULL,
  `bookname` varchar(100) DEFAULT NULL,
  `booktype` varchar(100) DEFAULT NULL,
  `publication` varchar(100) DEFAULT NULL,
  `year_of_pub` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `bookimage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bookid`, `bookname`, `booktype`, `publication`, `year_of_pub`, `price`, `quantity`, `bookimage`) VALUES
(11, 'E1', 'Java Programming', 'Education', 'ISBN', '2002', '230', '20', 'j1.jpg'),
(12, 'E2', 'Java Programming for beginners', 'Education', 'Kindle Edition', '2020', '550', '20', 'j2.jpg'),
(13, 'E3', 'Artificial intelligence', 'Education', 'Springer', '2020', '350', '30', 'a1.jpg'),
(14, 'E4', 'C ++ programming ', 'Education', 'Tata Mcgraw Hill', '2002', '300', '20', 'cpp1.jpg'),
(15, 'E5', 'C Programming', 'Education', 'Tata Mcgraw Hill', '2001', '400', '20', 'c1.jpg'),
(16, 'M1', 'Rich Dad Poor Dad', 'Motivational ', 'Warner books', '2000', '500', '20', 'M1.jpg'),
(17, 'M2', 'IKIGAI', 'Motivational ', 'Penguin Life', '2017', '400', '30', 'M2.jpg'),
(18, 'M3', 'Energize Your Mind', 'Motivational ', 'Penguin ', '2015', '179', '20', 'M3.jpg'),
(19, 'M4', 'Atomic Habbits', 'Motivational ', 'Random House', '2018', '200', '20', 'M4.jpg'),
(20, 'M5', 'Good Vibes Good Life', 'Motivational ', 'Hay  House India', '2018', '150', '20', 'm6.jpg'),
(21, 'H1', 'Modern Indian History ', 'History', 'Schand publication ', '2010', '450', '50', 'h1.jpg'),
(22, 'H2', 'The Guns Of August', 'History', 'Random house publication', '2009', '280', '25', 'h2.jpg'),
(23, 'H3', 'India After Gandhi', 'History', 'Harper collins', '2007', '230', '15', 'h3.jpg'),
(24, 'H4', 'The Royal Rajputs', 'History', 'Rupa Publication', '2008', '730', '10', 'h4.jpg'),
(25, 'M1', 'The Hidden Hindu', 'Mythology', 'Penguin eBury Press', '2022', '170', '30', 'my1.jpg'),
(26, 'M2', 'Mahabharata', 'Mythology', 'Wonder House books', '2022', '155', '20', 'my3.jpg'),
(27, 'M3', 'Raavan', 'Mythology', 'Harper collins', '2022', '277', '40', 'my2.jpg'),
(28, 'M4', 'Greek Mythology', 'Mythology', 'National Geographic Kids', '2011', '190', '25', 'my4.jpg'),
(29, 'A1', 'The Wings Of Fire', 'Autobiography', 'Universities press', '1999', '200', '25', 'auto.jpg'),
(30, 'A2', 'Unfinished', 'Autobiography', 'Penguin Random House', '2021', '250', '26', 'un.jpg'),
(31, 'A3', 'The Gopi Dairies', 'Autobiography', 'Harper childerns', '2023', '300', '15', 'gp.jpg'),
(32, 'A4', 'I Am Malala', 'Autobiography', 'Weidenfeld & Nicolson', '2013', '200', '20', 'MA.jpg'),
(33, 'P1', 'Arias', 'Poetry', 'Knopf', '2019', '390', '30', 'arias.jpg'),
(34, 'P2', 'Hull', 'Poetry', 'Nightboat books', '2018', '450', '15', 'hull.jpg'),
(35, 'P3', 'Im Raising', 'Poetry', 'Harper collins', '2017', '390', '20', 'imrising.jpg'),
(36, 'P4', 'Poemsia', 'Poetry', 'Kindle Edition', '2020', '300', '15', 'poemsia.jpg'),
(38, 'R1', 'Pride And Prejudice', 'Romantic Novels', 'T Eagerton whitehall', '1813', '267', '23', 'm8.jpg'),
(39, 'R2', '2 States: The story of my Marriage', 'Romantic Novels', 'Rupa Publication pvt limited', '2009', '230', '10', '2 states.jpg'),
(40, 'R3', 'The Notebook', 'Romantic Novels', 'Warner books', '1996', '300', '10', 'download.jpg'),
(41, 'R4', 'The Fault in our stars', 'Romantic Novels', 'Dutton books', '2012', '450', '20', 'rr.jpg'),
(42, 'R5', 'Wish I Could tell you', 'Romantic Novels', 'Penguin ', '2019', '230', '25', 'w.jpg'),
(43, 'R5', 'The Girl Who Knew Too Much', 'Romantic Novels', 'Penguin Random House', '2017', '300', '30', 'th.jpg'),
(44, 'W1', 'Girl, Stop Apologizing', 'Women', 'Harper collins', '2019', '320', '14', 'g.jpg'),
(45, 'R6', 'Half Girlfriend', 'Romantic Novels', 'Rupa &co', '2014', '320', '28', 'm7.jpg'),
(46, 'R6', 'I Too Had a Lovestory', 'Romantic Novels', 'Penguin ', '2008', '190', '15', 'm9.jpg'),
(47, 'E6', 'General Knowledge 2017', 'Education', 'Arihant', '2017', '290', '40', 'ENT-2.jpg'),
(48, 'B1', 'Business Research Methods', 'Business/Economics', 'Cenage Learning Standard Edition ', '2016', '470', '20', 'BUS-9.jpg'),
(49, 'B2', 'Consumer Behavior', 'Business/Economics', 'Pearson Education India', '2015', '300', '25', 'BUS-8.jpg'),
(50, 'B3', 'Next Generation Libraianship', 'Business/Economics', 'BS Publication', '2017', '368', '50', 'BUS-7.jpg'),
(51, 'B4', 'Indian Economy', 'Business/Economics', 'GENERIC :classic edition', '2015', '390', '10', 'BUS-4.jpg'),
(52, 'B5', 'Advanced Bank Management', 'Business/Economics', 'GENERIC :classic edition', '2019', '450', '15', 'BUS-3.jpg'),
(53, 'B6', 'Project Management', 'Business/Economics', 'Mc Graw hill', '2018', '300', '30', 'BUS-1.jpg'),
(54, 'CH1', '365 Bedtime Stories', 'Children', 'Om & Om Books', '2017', '120', '50', 'CHILD-1.jpg'),
(55, 'CH2', '365 Bedtime Stories for Girls', 'Children', 'Om & Om Books', '2015', '169', '35', 'CHILD-2.jpg'),
(58, 'CH3', 'Diary of Wimpy Kid', 'Children', 'Penguin ', '2010', '170', '25', 'CHILD-6.jpg'),
(59, 'CH4', 'The Kingdom Of Fantasy', 'Children', 'Om & Om Books', '2010', '200', '25', 'CHILD-8.jpg'),
(61, 'CH5', '365 Panchatantra Stories', 'Children', 'Om & Om Books', '2012', '100', '20', 'CHILD-5.jpg'),
(62, 'W2', 'Women & The Weight Loss Tamasha', 'Women', 'Westland Books pvt ltd', '2010', '230', '25', '61thN1ojjqL._AC_UF1000,1000_QL80_.jpg'),
(63, 'W3', 'Chup-Breaking The Silence About Indias Women', 'Women', 'Juggernaut', '2019', '340', '23', 'chup.jpg'),
(65, 'E7', 'Mechanics of Materials', 'Education', 'McGraw Hill', '1981', '300', '30', 'ACA-9.jpg'),
(66, 'E8', 'Science', 'Education', 'Mc Graw hill', '2005', '125', '23', 'ACA-3.jpg'),
(67, 'E9', 'Data Science and Big Data Analytics ', 'Education', 'Mc Graw hill', '2012', '200', '10', 'ACA-11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_returns`
--

CREATE TABLE `book_returns` (
  `id` int(11) NOT NULL,
  `bookid` varchar(50) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_returns`
--

INSERT INTO `book_returns` (`id`, `bookid`, `transaction_type`, `invoice_id`, `details`, `timestamp`) VALUES
(3, 'BOOK100', 'Cash on Delivery', '12345', 'i dont like this publication', '2023-08-16 04:42:31'),
(4, 'm1', 'Cash on Delivery', '12345', 'no interested\r\n', '2023-08-16 09:30:44'),
(5, 'M1', 'Cash on Delivery', '12345', 'not intersterd', '2023-08-16 10:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `bookid` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finalcart`
--

CREATE TABLE `finalcart` (
  `id` int(11) NOT NULL,
  `cartid` varchar(100) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `perticulars` varchar(100) DEFAULT NULL,
  `totalamount` varchar(100) DEFAULT NULL,
  `billingdate` date DEFAULT NULL,
  `mode_pay` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finalcart`
--

INSERT INTO `finalcart` (`id`, `cartid`, `userid`, `phone`, `perticulars`, `totalamount`, `billingdate`, `mode_pay`, `address`) VALUES
(5, NULL, 'roopa', '9739771628', 'BOOK100 x 2, BOOK103 x 1', '1500', '2023-08-16', 'Card', 'Navanagar, BGK'),
(6, NULL, 'roopa', '9739771628', '', '0', '2023-08-16', 'Cash On Delivery', 'bgk'),
(7, NULL, 'roopa', '9739771628', 'BOOK100 x 1', '250', '2023-08-16', 'Cash On Delivery', 'bgk'),
(8, NULL, 'roopa', '9739771628', 'BOOK100 x 1', '250', '2023-08-16', 'Card', 'bgk'),
(9, NULL, 'roopa', '9739771628', 'M1 x 1, H1 x 1', '620', '2023-08-16', 'Card', 'bgk'),
(10, NULL, 'roopa', '9739771628', 'E1 x 1, M1 x 1', '730', '2023-08-16', 'Cash On Delivery', 'bgk'),
(11, NULL, 'roopa', '9739771628', 'H1 x 1, M1 x 1, H1 x 150', '10125950', '2023-08-16', 'Cash On Delivery', 'bgk'),
(12, NULL, 'test', '1111111111', 'E6 x 1, B4 x 2', '1910', '2023-12-30', 'Cash On Delivery', 'bgk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `password`, `name`, `phone`, `address`, `place`, `email`) VALUES
(3, 'roopa', '123', 'Roopa', '9739771628', 'bagalkot', 'bagalkot', 'roopadesai2002@gmail.com'),
(4, 'test', '12345', 's', '1111111111', 'bagalkot', 'bagalkot', 'test@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookcategory`
--
ALTER TABLE `bookcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_returns`
--
ALTER TABLE `book_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finalcart`
--
ALTER TABLE `finalcart`
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
-- AUTO_INCREMENT for table `bookcategory`
--
ALTER TABLE `bookcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `book_returns`
--
ALTER TABLE `book_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `finalcart`
--
ALTER TABLE `finalcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
