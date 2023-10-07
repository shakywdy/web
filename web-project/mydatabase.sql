-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-10-07 10:15:22
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
-- 表的结构 `friends`
--

CREATE TABLE `friends` (
  `studentid` int(11) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `friends`
--

INSERT INTO `friends` (`studentid`, `friendid`) VALUES
(123456, 123123);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(20) NOT NULL,
  `studentid` int(20) NOT NULL,
  `content` varchar(100) NOT NULL,
  `name` varchar(10) NOT NULL,
  `type` int(1) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `lastlogin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `students`
--

INSERT INTO `students` (`id`, `name`, `year`, `programe`, `password`, `lastlogin`) VALUES
(123123, '123', '2018', '123', '123', '2023-10-07'),
(123456, 'wangdongyang', '2019', '123', '123', '2023-10-07'),
(234567, '帅哥', '2018', '123', '123', '2023-09-28'),
(332132, '123', '2018', '123', '123', NULL),
(333333, '213', '2018', '333', '333', NULL),
(938939, '123', '2018', '1', '1', NULL),
(990192, '213', '2020', '100', '100', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `temp`
--

CREATE TABLE `temp` (
  `number` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `temp`
--

INSERT INTO `temp` (`number`, `studentid`, `friendid`) VALUES
(1, 123123, 123456);

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
-- 表的索引 `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`studentid`);

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
-- 使用表AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;

--
-- 使用表AUTO_INCREMENT `temp`
--
ALTER TABLE `temp`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
