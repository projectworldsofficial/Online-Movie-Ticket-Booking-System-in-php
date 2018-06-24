-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2017 at 09:42 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

CREATE TABLE IF NOT EXISTS `tbl_bookings` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(30) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT 'theater id',
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `no_seats` int(3) NOT NULL COMMENT 'number of seats',
  `amount` int(5) NOT NULL,
  `ticket_date` date NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`book_id`, `ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status`) VALUES
(3, '', 4, 4, 3, 3, 200, 75, '2017-05-21', '2017-05-21', 1),
(4, '', 4, 4, 1, 3, 2, 150, '2017-05-22', '2017-05-22', 1),
(5, '', 3, 3, 6, 1, 200, 70, '2017-05-25', '2017-05-22', 1),
(6, '', 3, 3, 6, 1, 100, 70, '2017-05-22', '2017-05-22', 1),
(7, '', 3, 3, 5, 1, 1, 70, '2017-05-22', '2017-05-22', 1),
(11, 'BKID5258816', 4, 2, 3, 3, 1, 75, '2017-05-22', '2017-05-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT 'email',
  `password` varchar(50) NOT NULL,
  `user_type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `user_id`, `username`, `password`, `user_type`) VALUES
(1, 0, 'admin', 'password', 0),
(2, 3, 'theatre', 'password', 1),
(3, 4, 'theatre2', 'password', 1),
(4, 5, 'USR858911', 'PWD608105', 1),
(5, 6, 'USR389436', 'PWD214748', 1),
(6, 7, 'USR389436', 'PWD214748', 1),
(7, 8, 'USR389436', 'PWD214748', 1),
(8, 9, 'USR503036', 'PWD713319', 1),
(9, 10, 'USR447274', 'PWD420652', 1),
(10, 11, 'USR486163', 'PWD790452', 1),
(12, 2, 'rahulreghunath11@gmail.com', 'rahul', 2),
(13, 12, 'USR568113', 'PWD334935', 1),
(14, 13, 'USR280780', 'PWD906419', 1),
(15, 14, 'USR295127', 'PWD195747', 1),
(16, 3, 'vishnut300@gmail.com', 'vishnut300', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

CREATE TABLE IF NOT EXISTS `tbl_movie` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL COMMENT 'theatre id',
  `movie_name` varchar(100) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `release_date` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 means active ',
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status`) VALUES
(1, 3, 'Sakhav', 'Nivin', 'This story revolves around a student political leader who fights for his left-wing ideals. When some people try to use him in order to fulfill their intentions, he is forced to fight for his ideals.', '2018-01-01', 'images/maxresdefault.jpg', 'https://www.youtube.com/watch?v=x_AK7HWpJ-0', 0),
(2, 3, 'Comarade In America', 'Dulquer Salmaan', 'Aji Mathew is a lovable, courageous, and modest youngster who hails from Pala. He meets a girl named Sara at college, and they fall in love regardless of their upbringing.', '2017-05-05', 'images/cia-new-poster-759.jpeg', 'https://www.youtube.com/watch?v=f5nvCp0QFdA', 0),
(3, 3, 'Angamaly Diaries', ' Reshma Rajan, Tito Wilson, Sarath Kumar', 'Angamaly Diaries is a 2017 Indian Malayalam-language crime drama film directed by Lijo Jose Pellissery and written by Chemban Vinod Jose.', '2017-05-01', 'images/angamaly-diaries-2.jpg', 'https://www.youtube.com/watch?v=4yRBJCrjabU', 0),
(8, 3, 'Godha', 'Tovino Thomas, Wamiqa Gabbi ', 'Godha is an Malayalam Sports-Comedy movie directed by Basil Joseph, starring Tovino Thomas, Wamiqa Gabbi and Renji Panicker in the lead roles', '2017-05-19', 'images/godha.jpg', 'https://www.youtube.com/watch?v=hnICGugY6fI', 0),
(10, 3, 'Ramante Edanthottam', 'Kunchacko Boban, Anu Sithara', 'Ramante Edanthottam is an upcoming Malayalam language film written produced and directed by Ranjith Shankar.', '2017-05-12', 'images/raman.jpg', 'https://www.youtube.com/watch?v=H6HK51qVdmc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cast` varchar(100) NOT NULL,
  `news_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `name`, `cast`, `news_date`, `description`, `attachment`) VALUES
(3, 'The Mummy', 'Tom Cruiz', '2017-06-15', 'Thought safely entombed in a crypt deep beneath the desert, an ancient princess whose destiny was unjustly taken from her is awakened in the modern era', 'news_images/mummy.jpg'),
(5, 'Transformers: The Last Knight', ' Mark Wahlberg , Isabela Moner ', '2017-07-21', 'Humans are at war with the Transformers, and Optimus Prime is gone. The key to saving the future lies buried in the secrets of the past and the hidden history of Transformers on Earth', 'news_images/tra.jpg'),
(6, 'Tiyan', 'Privthi Raj,Indrajith', '2017-10-18', 'Tiyaan is an upcoming Indian Malayalam film written by Murali Gopy and directed by Jiyen Krishnakumar.', 'news_images/tiyan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `name`, `email`, `phone`, `age`, `gender`) VALUES
(1, 'rahul', '', '9037500119', 23, 'gender'),
(2, 'rahul', 'rahulreghunath11@gmail.com', '9037500119', 23, 'gender'),
(3, 'vishnu', 'vishnut300@gmail.com', '8156820497', 22, 'gender');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_screens`
--

CREATE TABLE IF NOT EXISTS `tbl_screens` (
  `screen_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL COMMENT 'theatre id',
  `screen_name` varchar(110) NOT NULL,
  `seats` int(11) NOT NULL COMMENT 'number of seats',
  `charge` int(11) NOT NULL,
  PRIMARY KEY (`screen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_screens`
--

INSERT INTO `tbl_screens` (`screen_id`, `t_id`, `screen_name`, `seats`, `charge`) VALUES
(1, 3, 'Screen 1', 100, 70),
(2, 3, 'Screen 2', 150, 60),
(3, 4, 'Screen 1', 200, 75),
(4, 14, 'Screen1', 34, 120);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shows`
--

CREATE TABLE IF NOT EXISTS `tbl_shows` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_id` int(11) NOT NULL COMMENT 'show time id',
  `theatre_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 means show available',
  `r_status` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_shows`
--

INSERT INTO `tbl_shows` (`s_id`, `st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status`) VALUES
(1, 9, 4, 1, '2017-05-01', 1, 1),
(2, 10, 4, 1, '2017-05-01', 1, 1),
(3, 11, 4, 2, '2017-05-01', 1, 1),
(4, 12, 4, 2, '2017-05-01', 1, 1),
(5, 1, 3, 1, '2017-05-01', 1, 1),
(6, 2, 3, 1, '2017-05-01', 1, 1),
(7, 3, 3, 1, '2017-05-01', 1, 1),
(8, 4, 3, 1, '2017-05-01', 1, 1),
(9, 5, 3, 2, '2017-05-01', 1, 1),
(10, 6, 3, 2, '2017-05-01', 1, 1),
(11, 7, 3, 2, '2017-05-01', 1, 1),
(12, 8, 3, 2, '2017-05-01', 1, 1),
(13, 1, 3, 10, '2017-02-25', 1, 0),
(14, 2, 3, 10, '2017-02-25', 1, 0),
(15, 9, 4, 8, '2017-05-28', 1, 0),
(16, 10, 4, 8, '2017-05-28', 1, 0),
(17, 11, 4, 8, '2017-05-28', 1, 0),
(18, 12, 4, 8, '2017-05-28', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_show_time`
--

CREATE TABLE IF NOT EXISTS `tbl_show_time` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT 'noon,second,etc',
  `start_time` time NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_show_time`
--

INSERT INTO `tbl_show_time` (`st_id`, `screen_id`, `name`, `start_time`) VALUES
(1, 1, 'Noon', '10:00:00'),
(2, 1, 'Matinee', '14:00:00'),
(3, 1, 'First', '18:00:00'),
(4, 1, 'Second', '21:00:00'),
(5, 2, 'Noon', '10:00:00'),
(6, 2, 'Matinee', '14:00:00'),
(7, 2, 'First', '18:00:00'),
(8, 2, 'Second', '21:00:00'),
(9, 3, 'Noon', '10:00:00'),
(10, 3, 'Matinee', '14:00:00'),
(11, 3, 'First', '18:00:00'),
(12, 3, 'Second', '21:00:00'),
(14, 4, 'Noon', '12:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theatre`
--

CREATE TABLE IF NOT EXISTS `tbl_theatre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_theatre`
--

INSERT INTO `tbl_theatre` (`id`, `name`, `address`, `place`, `state`, `pin`) VALUES
(2, 'Nayanam', 'Adoor', 'Adoor', 'Kerala', 691523),
(3, 'Nadam', 'Adoor', 'Adoor, Kerala, India', 'Kerala', 691523),
(4, 'Smitha', 'Adoor', 'adoor', 'Kerala', 691523),
(5, 'Smitha', 'Adoor', 'adoor', 'Kerala', 691523),
(6, 'rty', 'ryty', 'rty', 'tryt', 545),
(7, 'rty', 'ryty', 'rty', 'tryt', 545),
(8, 'rty', 'ryty', 'rty', 'tryt', 545),
(9, 'dgd', 'dgf', 'Mannady, Chennai, Tamil Nadu, India', 'Tamil Nadu', 600001),
(10, 'vxcv', 'sdfs', 'Mannady, Prakasam Road, George Town, Chennai, Tamil Nadu, India', 'Tamil Nadu', 600001),
(11, '', '', '', '', 0),
(12, '', '', '', '', 0),
(13, 'rye', 'yetyy', 'Yeyeye Hotel, Changchun, Jilin, China', 'Jilin Sheng', 130012),
(14, 'Trinity Movies', 'Pathanamthtta', 'Pathanamthitta, Kerala, India', 'Kerala', 691554);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
