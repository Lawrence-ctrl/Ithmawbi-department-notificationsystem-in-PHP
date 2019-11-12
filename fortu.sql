-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2019 at 08:08 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fortu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_photo` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_photo`, `admin_name`, `admin_email`, `admin_pass`, `created_date`, `modified_date`) VALUES
(1, 'admin.jpeg', 'TU IT', 'tuhmawbi@gmail.com', '5d41402abc4b2a76b9719d911017c592', '2019-07-07 11:10:46', '2019-07-07 11:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `chat_admin_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `messages` text NOT NULL,
  `status` int(11) NOT NULL,
  `timee` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `chat_admin_id`, `from_user_id`, `to_user_id`, `messages`, `status`, `timee`) VALUES
(1, 1, 0, 2, 'hi', 1, '2019-08-06 03:29:53'),
(57, 7, 0, 1, 'hi', 0, '2019-08-24 14:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `examdates`
--

CREATE TABLE `examdates` (
  `examdates_id` int(11) NOT NULL,
  `examdates_subjects` varchar(255) NOT NULL,
  `examdates_year_id` int(11) NOT NULL,
  `examdates_date` date NOT NULL,
  `examdates_times` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examdates`
--

INSERT INTO `examdates` (`examdates_id`, `examdates_subjects`, `examdates_year_id`, `examdates_date`, `examdates_times`, `created_date`, `updated_date`) VALUES
(1, 'Wireless and mobile communication', 6, '2019-03-25', 2, '2019-08-19 03:16:06', '2019-08-19 03:16:06'),
(2, 'Network Planning and Management', 6, '2019-03-26', 2, '2019-08-19 03:16:24', '2019-08-19 03:16:24'),
(3, 'HSS', 6, '2019-03-29', 2, '2019-08-19 03:16:40', '2019-08-19 03:16:40'),
(4, 'Project Management', 6, '2019-03-28', 2, '2019-08-19 03:18:39', '2019-08-19 03:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`) VALUES
(1, 7, '0000-00-00 00:00:00'),
(2, 2, '0000-00-00 00:00:00'),
(3, 2, '2019-08-24 14:14:42'),
(4, 7, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_adminid` int(11) NOT NULL,
  `post_userid` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_photo` varchar(255) NOT NULL,
  `post_year` int(11) NOT NULL,
  `post_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_adminid`, `post_userid`, `post_content`, `post_photo`, `post_year`, `post_status`, `created_date`, `updated_date`) VALUES
(1, 1, 0, 'hello Teachers', '5d4b31bc2dc53__106768061_gettyimages-1126199440.jpg', 0, 1, '2019-08-08 02:47:00', '2019-08-08 02:47:00'),
(2, 1, 0, 'Hello students from first year', '5d4b31cb4cb93_istockphoto-940891868-612x612.jpg', 1, 2, '2019-08-08 02:47:15', '2019-08-08 02:47:15'),
(4, 0, 7, 'Hello ec from sayar account', '5d4b323ae54b5_nature-benefits.jpg.860x0_q70_crop-scale.jpg', 7, 3, '2019-08-08 02:49:06', '2019-08-08 02:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `saved_id` int(11) NOT NULL,
  `saved_post_id` int(11) NOT NULL,
  `saved_user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `timetable_year_id` int(11) NOT NULL,
  `timetable_day_id` int(11) NOT NULL,
  `timeone` varchar(255) NOT NULL,
  `timetwo` varchar(255) NOT NULL,
  `timethree` varchar(255) NOT NULL,
  `timefour` varchar(255) NOT NULL,
  `timefive` varchar(255) NOT NULL,
  `timesix` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `timetable_year_id`, `timetable_day_id`, `timeone`, `timetwo`, `timethree`, `timefour`, `timefive`, `timesix`, `created_date`, `updated_date`) VALUES
(1, 6, 1, 'NPM (L)', 'NPM (L)', 'Presentation', 'Presentation', 'Presentation', 'Presentation', '2019-08-07 16:19:44', '2019-08-07 16:19:44'),
(2, 6, 2, 'PM (L)', 'PM (L)', 'NPM (P)', 'HSS (L)', 'HSS (L)', 'HSS (L)', '2019-08-07 16:21:03', '2019-08-07 16:21:03'),
(3, 6, 3, 'WMC (L)', 'WMC (L)', 'Self Study', 'Activity', 'Activity', 'Activity', '2019-08-07 16:21:38', '2019-08-07 16:21:38'),
(4, 6, 4, 'PM (L)', 'PM (L)', 'NPM (P)', 'WMC (P)', 'WMC (P)', 'WMC (P)', '2019-08-07 16:22:25', '2019-08-07 16:22:25'),
(5, 6, 5, 'Self Study', 'Self Study', 'Self Study', 'Self Study', 'Self Study', 'Self Study', '2019-08-07 16:23:36', '2019-08-07 16:23:36'),
(6, 1, 5, 'Myanmar', 'Myanmar', 'ICS (P)', 'Activity', 'Activity', 'Activity', '2019-08-07 23:43:47', '2019-08-07 23:43:47'),
(7, 1, 1, 'Maths (L)', 'Maths (L)', 'ICS (L)', 'English (T)', 'Physics (L)', 'Physics (L)', '2019-08-07 23:48:58', '2019-08-07 23:48:58'),
(8, 1, 3, 'Drawing', 'Drawing', 'Drawing', 'Maths (T)', 'Chemistry (L)', 'Chemistry (L)', '2019-08-07 23:49:37', '2019-08-07 23:49:37'),
(9, 1, 2, 'Maths (L)', 'Maths (L)', 'Physics (T)', 'Chemistry (T)', 'Physics (Lab)', 'Physics (Lab)', '2019-08-07 23:50:40', '2019-08-07 23:50:40'),
(10, 1, 4, 'Chemistry (Lab)', 'Chemistry (Lab)', 'Chemistry (L)', 'ICS (L)', 'English (L)', 'English (L)', '2019-08-07 23:51:29', '2019-08-07 23:51:29'),
(11, 2, 1, 'Maths (L)', 'Maths (L)', 'BEE (T)', 'English (T)', 'DLD (L)', 'DLD (L)', '2019-08-07 23:53:41', '2019-08-07 23:53:41'),
(12, 2, 2, 'English (L)', 'English (L)', 'DLD (P)', 'DC (P)', 'Maths (L)', 'Maths (L)', '2019-08-07 23:54:32', '2019-08-07 23:54:32'),
(13, 2, 5, 'C++ (L)', 'C++ (L)', 'BEE (T)', 'Activity', 'Activity', 'Activity', '2019-08-07 23:55:02', '2019-08-07 23:55:02'),
(14, 2, 3, 'DC (L)', 'DC (L)', 'Maths (T)', 'DLD (P)', 'Web (L)', 'Web (L)', '2019-08-07 23:55:33', '2019-08-07 23:55:33'),
(15, 2, 4, 'Web (T)', 'Web (T)', 'C++ (P)', 'C++ (P)', 'BEE (L)', 'BEE (L)', '2019-08-07 23:56:42', '2019-08-07 23:56:42'),
(16, 3, 1, 'DBMS (L)', 'DBMS (L)', 'DBMS (T)', 'Maths (T)', 'English (L)', 'English (L)', '2019-08-08 00:00:17', '2019-08-08 00:00:17'),
(17, 3, 2, 'Maths (L)', 'Maths (L)', 'Java (P)', 'CN (P)', 'DS (L)', 'DS (L)', '2019-08-08 00:00:51', '2019-08-08 00:00:51'),
(18, 3, 3, 'Maths (L)', 'Maths (L)', 'CN (P)', 'Java (P)', 'Web (L)', 'Web (L)', '2019-08-08 00:01:19', '2019-08-08 00:01:19'),
(19, 3, 4, 'CN (L)', 'CN (L)', 'Web (P)', 'Web (P)', 'DS (P)', 'DS (T)', '2019-08-08 00:02:18', '2019-08-08 00:02:18'),
(20, 3, 5, 'Java (L)', 'Java (L)', 'English (T)', 'DBMS (P)', 'Activity', 'Activity', '2019-08-08 00:03:09', '2019-08-08 00:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `userphoto` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `year_id` int(11) NOT NULL,
  `userphone` varchar(255) NOT NULL,
  `useraddress` text NOT NULL,
  `status` int(2) NOT NULL,
  `user_status` int(2) NOT NULL,
  `created_dates` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `userphoto`, `username`, `useremail`, `userpass`, `year_id`, `userphone`, `useraddress`, `status`, `user_status`, `created_dates`, `modified_date`) VALUES
(2, '5d3c73dbea4e1_images3.png', 'Phyu Phyu Thin', 'phyuphyuthin@gmail.com', '5d41402abc4b2a76b9719d911017c592', 5, '09975648123', 'Hmawbi', 3, 1, '2019-07-27 22:25:07', '2019-07-27 22:25:07'),
(3, '5d3c7411a9d11_10-512.png', 'Tun Myint Aung', 'tunmyintaung@gmail.com', '5d41402abc4b2a76b9719d911017c592', 4, '09975514789', 'Mingalardon', 2, 1, '2019-07-27 22:26:01', '2019-07-27 22:26:01'),
(5, '5d3d45640d3a3_kisspng-computer-icons-avatar-user-profile-people-icon-5ac7ab59364412.4012676915230349692223.jpg', 'Thazin Phyu', 'thazinphyu@gmail.com', '5d41402abc4b2a76b9719d911017c592', 6, '0997456123', 'Insein', 2, 1, '2019-07-28 13:19:08', '2019-07-28 13:19:08'),
(6, '5d3d4593e61af_ind1ex.png', 'Thuta Yar Moe', 'thutayarmoe@gmail.com', '5d41402abc4b2a76b9719d911017c592', 6, '09972089188', 'North Dagon Township', 2, 1, '2019-07-28 13:19:55', '2019-07-28 13:19:55'),
(7, '5d3eecbeaa8f5_images.png', 'U Sayar', 'usayar@gmail.com', '5d41402abc4b2a76b9719d911017c592', 0, '09123456789', 'Hmawbi', 1, 1, '2019-07-29 19:25:26', '2019-07-29 19:25:26'),
(8, '5d3eed24136c1_download.png', 'Daw Sayar Ma', 'sayarma@gmail.com', '5d41402abc4b2a76b9719d911017c592', 0, '09123456789', 'Hmawbi', 1, 1, '2019-07-29 19:27:08', '2019-07-29 19:27:08'),
(9, '5d4aa9e34dcb2_index.png', 'Ei Phyu Phyu Thant', 'eiphyuphyuthant@gmail.com', '5d41402abc4b2a76b9719d911017c592', 6, '09963437433', 'Yankin, Moe Kaung ', 2, 1, '2019-08-07 17:07:23', '2019-08-07 17:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE `viewers` (
  `viewer_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `viewers`
--

INSERT INTO `viewers` (`viewer_id`, `post_id`, `user_id`, `created_date`, `updated_date`) VALUES
(1, 4, 2, '2019-08-08 02:49:26', '2019-08-08 02:49:26'),
(2, 1, 7, '2019-08-09 01:08:32', '2019-08-09 01:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `years_id` int(11) NOT NULL,
  `years_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`years_id`, `years_name`, `created_date`, `modified_date`) VALUES
(1, 'First Year', '2019-07-06 23:53:46', '2019-07-06 23:53:46'),
(2, 'Second Year', '2019-07-06 23:53:46', '2019-07-06 23:53:46'),
(3, 'Third Year', '2019-07-06 23:54:11', '2019-07-06 23:54:11'),
(4, 'Fourth Year', '2019-07-06 23:54:11', '2019-07-06 23:54:11'),
(5, 'Fifth Year', '2019-07-06 23:54:33', '2019-07-06 23:54:33'),
(6, 'Sixth Year', '2019-07-06 23:54:33', '2019-07-06 23:54:33'),
(7, 'All', '2019-07-18 11:48:15', '2019-07-18 11:48:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `examdates`
--
ALTER TABLE `examdates`
  ADD PRIMARY KEY (`examdates_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`saved_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `viewers`
--
ALTER TABLE `viewers`
  ADD PRIMARY KEY (`viewer_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`years_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `examdates`
--
ALTER TABLE `examdates`
  MODIFY `examdates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `saved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `viewers`
--
ALTER TABLE `viewers`
  MODIFY `viewer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `years_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
