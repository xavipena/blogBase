-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2023 at 05:23 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qagg302`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `IDblog` int NOT NULL DEFAULT '1',
  `IDarticle` int NOT NULL DEFAULT '0',
  `type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `published` date NOT NULL,
  `updated` date NOT NULL DEFAULT '2001-01-01',
  `title` varchar(150) NOT NULL DEFAULT '',
  `excerpt` tinytext NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `IDauthor` int NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT 'ca',
  `next` int NOT NULL,
  `prev` int NOT NULL,
  `readTime` decimal(8,2) NOT NULL,
  `wordCount` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `article_code`
--

CREATE TABLE `article_code` (
  `IDarticle` int NOT NULL,
  `section` int NOT NULL,
  `sequence` int NOT NULL,
  `os` varchar(5) NOT NULL,
  `code` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `article_code_types`
--

CREATE TABLE `article_code_types` (
  `IDos` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `article_details`
--

CREATE TABLE `article_details` (
  `IDarticle` int NOT NULL DEFAULT '0',
  `section` tinytext NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'T',
  `text` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `lang` varchar(2) NOT NULL DEFAULT 'ca'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `article_images`
--

CREATE TABLE `article_images` (
  `IDarticle` int NOT NULL DEFAULT '0',
  `section` int NOT NULL DEFAULT '0',
  `sequence` int NOT NULL DEFAULT '0',
  `image` varchar(150) NOT NULL DEFAULT '',
  `caption` text NOT NULL,
  `alternate` varchar(150) NOT NULL,
  `credit` varchar(250) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `lang` varchar(2) NOT NULL DEFAULT 'ca'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `article_links`
--

CREATE TABLE `article_links` (
  `IDarticle` int NOT NULL DEFAULT '0',
  `section` int NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `lang` varchar(2) NOT NULL DEFAULT 'ca'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `article_metadata`
--

CREATE TABLE `article_metadata` (
  `IDarticle` int NOT NULL,
  `IDmeta` int NOT NULL,
  `value` text NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'es'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `article_quotes`
--

CREATE TABLE `article_quotes` (
  `IDarticle` int NOT NULL,
  `section` int NOT NULL,
  `embed` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `lang` varchar(2) NOT NULL DEFAULT 'es'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Table structure for table `article_related`
--

CREATE TABLE `article_related` (
  `IDarticle` int NOT NULL DEFAULT '0',
  `section` int NOT NULL DEFAULT '0',
  `sequence` int NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `article_social`
--

CREATE TABLE `article_social` (
  `IDarticle` int NOT NULL,
  `twitter` varchar(1) NOT NULL DEFAULT 'N',
  `tdate` date NOT NULL,
  `Instagram` varchar(1) NOT NULL DEFAULT 'N',
  `idate` date NOT NULL,
  `facebook` varchar(1) NOT NULL DEFAULT 'N',
  `fdate` date NOT NULL,
  `medium` varchar(1) NOT NULL DEFAULT 'N',
  `mdate` date NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `lang` varchar(2) NOT NULL DEFAULT 'ca',
  `name` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `vero` varchar(50) NOT NULL,
  `linkedin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `intro`
--

CREATE TABLE `intro` (
  `IDblog` int NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `counts` int NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `lang` varchar(2) NOT NULL DEFAULT 'ca'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `intro_blogs`
--

CREATE TABLE `intro_blogs` (
  `IDblog` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `intro_metadata`
--

CREATE TABLE `intro_metadata` (
  `IDmeta` int NOT NULL,
  `IDblog` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `type` enum('name','http-equiv','rel') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'es'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


--
-- Table structure for table `intro_types`
--

CREATE TABLE `intro_types` (
  `IDtype` int NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `IDblog` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Table structure for table `intro_utils`
--

CREATE TABLE `intro_utils` (
  `IDutil` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`IDblog`,`IDarticle`,`lang`);

--
-- Indexes for table `article_code`
--
ALTER TABLE `article_code`
  ADD PRIMARY KEY (`IDarticle`,`section`,`sequence`,`os`);

--
-- Indexes for table `article_code_types`
--
ALTER TABLE `article_code_types`
  ADD PRIMARY KEY (`IDos`);

--
-- Indexes for table `article_details`
--
ALTER TABLE `article_details`
  ADD PRIMARY KEY (`IDarticle`,`position`,`lang`,`status`) USING BTREE;

--
-- Indexes for table `article_images`
--
ALTER TABLE `article_images`
  ADD PRIMARY KEY (`IDarticle`,`section`,`sequence`,`lang`);

--
-- Indexes for table `article_links`
--
ALTER TABLE `article_links`
  ADD PRIMARY KEY (`IDarticle`,`section`,`name`,`lang`);

--
-- Indexes for table `article_metadata`
--
ALTER TABLE `article_metadata`
  ADD PRIMARY KEY (`IDarticle`,`IDmeta`,`lang`) USING BTREE;

--
-- Indexes for table `article_quotes`
--
ALTER TABLE `article_quotes`
  ADD PRIMARY KEY (`IDarticle`,`section`,`lang`) USING BTREE;

--
-- Indexes for table `article_related`
--
ALTER TABLE `article_related`
  ADD PRIMARY KEY (`IDarticle`,`section`,`sequence`);

--
-- Indexes for table `article_social`
--
ALTER TABLE `article_social`
  ADD PRIMARY KEY (`IDarticle`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`lang`);

--
-- Indexes for table `intro`
--
ALTER TABLE `intro`
  ADD PRIMARY KEY (`IDblog`,`type`,`lang`);

--
-- Indexes for table `intro_blogs`
--
ALTER TABLE `intro_blogs`
  ADD PRIMARY KEY (`IDblog`);

--
-- Indexes for table `intro_metadata`
--
ALTER TABLE `intro_metadata`
  ADD PRIMARY KEY (`IDmeta`,`IDblog`,`lang`) USING BTREE;

--
-- Indexes for table `intro_types`
--
ALTER TABLE `intro_types`
  ADD PRIMARY KEY (`IDtype`);

--
-- Indexes for table `intro_utils`
--
ALTER TABLE `intro_utils`
  ADD PRIMARY KEY (`IDutil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
