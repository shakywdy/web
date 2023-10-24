-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-10-24 15:29:21
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydatabase`
--

-- --------------------------------------------------------

--
-- 表的结构 `discussion`
--

CREATE TABLE `discussion` (
  `count` int(11) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `name` varchar(110) NOT NULL,
  `id` int(110) NOT NULL,
  `date` datetime DEFAULT NULL,
  `type` int(10) NOT NULL DEFAULT 0,
  `filename` varchar(110) DEFAULT NULL,
  `filetype` varchar(110) DEFAULT NULL,
  `filesize` varchar(110) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `discussion`
--

INSERT INTO `discussion` (`count`, `content`, `name`, `id`, `date`, `type`, `filename`, `filetype`, `filesize`, `link`) VALUES
(66, 'this is my home work', 'wangdongyang', 123456, '2023-10-22 17:33:45', 1, 'AMS1001_Chapter 1', 'pdf', '799 KB', 'AMS1001_Chapter 1.pdf'),
(67, '2112', 'wangdongyang', 123456, '2023-10-22 20:07:29', 1, 'Chapter 2 Basic Python', 'docx', '7 MB', 'Chapter 2 Basic Python.docx'),
(68, '', 'wangdongyang', 123456, '2023-10-22 20:19:13', 0, NULL, NULL, NULL, NULL),
(69, '1211', 'wangdongyang', 123456, '2023-10-22 20:20:22', 0, NULL, NULL, NULL, NULL),
(70, '1212', 'wangdongyang', 123456, '2023-10-22 20:23:47', 0, NULL, NULL, NULL, NULL),
(71, '', 'wangdongyang', 123456, '2023-10-22 20:23:52', 1, 'Chapter 1. Introduction to AI - an Overview STU', 'docx', '9 MB', 'Chapter 1. Introduction to AI - an Overview STU.docx'),
(72, 'hi', '123', 123123, '2023-10-23 09:54:39', 0, NULL, NULL, NULL, NULL),
(73, '', '123', 123123, '2023-10-23 09:55:54', 1, 'Lab 4 Instruction (8-puzzle and Sudoku)', 'docx', '73 KB', 'Lab 4 Instruction (8-puzzle and Sudoku).docx'),
(74, 'this my home work', '123', 123123, '2023-10-23 11:02:56', 1, 'AMS1001_Chapter 1', 'pdf', '799 KB', 'AMS1001_Chapter 1.pdf'),
(75, '11212', '123', 123123, '2023-10-23 16:00:25', 0, NULL, NULL, NULL, NULL),
(76, 'i am good boy', 'wangdongyang', 123456, '2023-10-23 17:30:18', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `friends`
--

CREATE TABLE `friends` (
  `id` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `friends`
--

INSERT INTO `friends` (`id`, `studentid`, `friendid`) VALUES
(45, 123123, 123456),
(46, 123456, 123123),
(47, 234567, 123456),
(48, 123456, 234567);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(20) NOT NULL,
  `studentid` int(20) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` int(1) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `readme` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `studentid`, `content`, `name`, `type`, `userid`, `date`, `readme`) VALUES
(1, 123123, '12121', 'wangdongyang', 1, 123456, '2023-10-23', 0),
(2, 123123, '1212', 'wangdongyang', 1, 123456, '2023-10-23', 0);

-- --------------------------------------------------------

--
-- 表的结构 `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `programe` varchar(8) NOT NULL,
  `password` varchar(15) NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `students`
--

INSERT INTO `students` (`id`, `name`, `year`, `programe`, `password`, `lastlogin`) VALUES
(123123, '123', '2018', '123', '123', '2023-10-23 15:38:41'),
(123456, 'wangdongyang', '2019', '123', '123', '2023-10-23 18:13:21'),
(234567, 'wangdongyang', '2018', '123', '123', '2023-10-23 16:31:46'),
(332132, '123', '2018', '123', '123', '2023-10-21 17:41:21'),
(333333, '213', '2018', '333', '333', NULL),
(938939, '123', '2018', '1', '1', NULL),
(990192, '213', '2020', '100', '100', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `temp`
--

CREATE TABLE `temp` (
  `number` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `type` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `password`, `type`) VALUES
(123123, '123', 'student'),
(123456, '123', 'student'),
(234567, '123', 'student'),
(332132, '123', 'student'),
(333333, '333', 'student'),
(938939, '1', 'student'),
(990192, '100', 'student');

--
-- 转储表的索引
--

--
-- 表的索引 `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`count`);

--
-- 表的索引 `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`number`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `discussion`
--
ALTER TABLE `discussion`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- 使用表AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;

--
-- 使用表AUTO_INCREMENT `temp`
--
ALTER TABLE `temp`
  MODIFY `number` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
