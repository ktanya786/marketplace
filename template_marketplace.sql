-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2019 at 07:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `template_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_template`
--

CREATE TABLE `tbl_template` (
  `tpl_id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `template_path` varchar(500) NOT NULL,
  `extracted_path` varchar(500) NOT NULL,
  `uplaoded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_template`
--

INSERT INTO `tbl_template` (`tpl_id`, `template_name`, `template_path`, `extracted_path`, `uplaoded_date`) VALUES
(6, 'IssueAnalysis', 'upload/1557077704_IssueAnalysis.zip', '', '2019-05-05 17:35:04'),
(7, 'IssueAnalysis', 'upload/1557077848_IssueAnalysis.zip', '', '2019-05-05 17:37:28'),
(8, 'IssueAnalysis', 'upload/1557077976_IssueAnalysis.zip', '', '2019-05-05 17:39:36'),
(9, 'IssueAnalysis', 'upload/1557078084_IssueAnalysis.zip', '', '2019-05-05 17:41:24'),
(10, 'IssueAnalysis', 'upload/1557078354_IssueAnalysis.zip', 'upload/extracted/1557078354/', '2019-05-05 17:45:54'),
(11, 'IssueAnalysis', 'upload/1557078686_IssueAnalysis.zip', 'upload/extracted/1557078686/', '2019-05-05 17:51:26'),
(12, 'IssueAnalysis', 'upload/1557078788_IssueAnalysis.zip', 'upload/extracted/1557078788/', '2019-05-05 17:53:08'),
(13, 'IssueAnalysis', 'upload/1557109448_IssueAnalysis.zip', 'upload/extracted/1557109448/', '2019-05-06 02:24:08'),
(14, 'IssueAnalysis', 'upload/1557109613_IssueAnalysis.zip', 'upload/extracted/1557109613/', '2019-05-06 02:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_template`
--
ALTER TABLE `tbl_template`
  ADD PRIMARY KEY (`tpl_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_template`
--
ALTER TABLE `tbl_template`
  MODIFY `tpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
