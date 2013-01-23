-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2013 at 06:33 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `harrisdi_cerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` bigint(64) unsigned NOT NULL AUTO_INCREMENT,
  `accountname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `accountname`) VALUES
(1, 'Bank'),
(2, 'Cash'),
(3, 'Landpreparation'),
(4, 'Shikuku Wanyama'),
(5, 'hjnbdf'),
(6, 'ghinvejnfsjk'),
(7, 'hfgfcds'),
(8, 'Charles Dindi'),
(9, 'ooindohbnoiv'),
(10, 'jkhger'),
(11, 'khjgfd'),
(12, 'erew'),
(13, 'rgnefrwpidfmlk'),
(14, 'tyfihpkolmnjhvcytu'),
(15, '0'),
(16, 'Harris Dindi Samuel'),
(17, '0'),
(18, 'wer'),
(19, 'yrtrerwrthfgdd'),
(20, 'yrtrerwrthfgddYTREFWQT'),
(21, 'BKJNDIUGNIUVER'),
(22, 'goiveu'),
(23, 'nngiovenioresriofvoidmiogiov'),
(24, 'nngiovenioriofvoidmiogiov'),
(25, 'nngiovenioriofvdmiogiov'),
(26, 'nngioriofvdmiogiov'),
(27, 'nngiordmiogiov'),
(28, 'nngdmiogiov'),
(29, 'nngdmiiov'),
(30, 'trwewq'),
(31, 'trwegrterwq'),
(32, 'hrtdtfwertyujrte'),
(33, 'hrtdtfwrtdtygreertyujrte'),
(34, 'hrtdtfwrtdtyeertyujrte'),
(35, 'hrtdtfwreertyujrte'),
(36, 'hrtdtfeertyujrte'),
(37, 'jhgfds'),
(38, 'jhgfds'),
(39, 'jhuhuigfds'),
(40, 'jhuhuihiugfds'),
(41, 'jhuhhiugfds'),
(42, 'Landpreparations'),
(43, 'Weeding'),
(44, 'Dindi Harris'),
(45, 'Dindi Harris'),
(46, 'Weeding'),
(47, 'Harris Dindi Samuel'),
(48, 'Harris Dindi Samuel'),
(49, 'Harris Dindi Samuel'),
(50, 'Dindi Harris'),
(51, 'Dindi Harris'),
(52, 'Dindi Harris');

-- --------------------------------------------------------

--
-- Table structure for table `accountingperiod`
--

CREATE TABLE IF NOT EXISTS `accountingperiod` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  `assetype` varchar(255) NOT NULL,
  `accountperiod` varchar(255) NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accountingperiod`
--


-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) DEFAULT NULL,
  `activityname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--


-- --------------------------------------------------------

--
-- Table structure for table `aggregatetransaction`
--

CREATE TABLE IF NOT EXISTS `aggregatetransaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  `assetype` varchar(255) NOT NULL,
  `accountperiod` varchar(255) NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `aggregatetransaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `cashflows`
--

CREATE TABLE IF NOT EXISTS `cashflows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cashflows`
--

INSERT INTO `cashflows` (`id`, `name`) VALUES
(1, 'Revenue'),
(2, 'Costs');

-- --------------------------------------------------------

--
-- Table structure for table `chemical`
--

CREATE TABLE IF NOT EXISTS `chemical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `farmid` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `cycleid` int(11) DEFAULT NULL,
  `totalprice` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `chemical`
--

INSERT INTO `chemical` (`id`, `name`, `farmid`, `amount`, `cycleid`, `totalprice`, `quantity`) VALUES
(1, 'Round Up', 1, 1300, 1, 15600, 12),
(2, 'Krismat', 1, 1500, 1, 15000, 10),
(3, 'DAP', 1, 2500, 1, 75000, 30),
(4, 'Urea', 1, 2000, 1, 50000, 25),
(5, 'Dual Gold', 1, 2500, 1, 75000, 30),
(6, '', 1, 0, 1, 0, 0),
(7, '', 1, 0, 1, 0, 0),
(8, 'FARM REVENUE ', 1, 0, 1, 0, 0),
(9, 'Round Up', 1, 1300, 1, 15600, 12),
(10, 'Krismat', 1, 1500, 1, 15000, 10),
(11, 'DAP', 1, 2500, 1, 75000, 30),
(12, 'Urea', 1, 2000, 1, 50000, 25),
(13, 'Dual Gold', 1, 2500, 1, 75000, 30),
(14, '', 1, 0, 1, 0, 0),
(15, '', 1, 0, 1, 0, 0),
(16, 'FARM REVENUE ', 1, 0, 1, 0, 0),
(17, 'Round Up', 1, 1300, 1, 15600, 12),
(18, 'Krismat', 1, 1500, 1, 15000, 10),
(19, 'DAP', 1, 2500, 1, 75000, 30),
(20, 'Urea', 1, 2000, 1, 50000, 25),
(21, 'Dual Gold', 1, 2500, 1, 75000, 30),
(22, '', 1, 0, 1, 0, 0),
(23, '', 1, 0, 1, 0, 0),
(24, 'FARM REVENUE ', 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(255) NOT NULL,
  `stateindex` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `cityname`, `stateindex`) VALUES
(1, 'Karen', 1),
(2, 'Langata', 1),
(3, 'Madaraka', 1),
(4, 'Milimani', 4),
(5, 'Manegerial Estate', 2),
(6, 'Kilimani', 2),
(7, 'Nyeri', 3),
(8, 'Kondele', 4),
(9, 'Kilimani', 4),
(10, 'Manyatta', 4),
(11, 'Aga Khan', 5),
(12, 'Artisan', 2),
(13, 'zrehtcjyvkubionmpgfchvjbk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `constants`
--

CREATE TABLE IF NOT EXISTS `constants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `constant` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `constants`
--

INSERT INTO `constants` (`id`, `constant`) VALUES
(1, 'precost'),
(2, 'postcost'),
(3, 'chemical'),
(4, 'revenue');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `farmid` int(11) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `cycleid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costs`
--


-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE IF NOT EXISTS `credit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  `assetype` varchar(255) NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id`, `accountid`, `journalid`, `assetype`, `amount`) VALUES
(1, 1, 0, '', 12000),
(2, 1, 0, '', 12000),
(3, 1, 0, '', 12000),
(4, 1, 0, '', 10000),
(5, 2, 0, '', 10000000),
(6, 2, 0, '', 10000000),
(7, 2, 0, '', 10000000),
(8, 2, 0, '', 10000000),
(9, 2, 0, '', 10000000),
(10, 2, 0, '', 10000000),
(11, 2, 0, '', 10000000),
(12, 2, 0, '', 10000000),
(13, 2, 0, '', 10000000),
(14, 2, 0, '', 10000000),
(15, 2, 0, '', 10000000),
(16, 2, 0, '', 10000000),
(17, 2, 0, '', 10000000),
(18, 2, 0, '', 10000000),
(19, 2, 0, '', 10000000),
(20, 1, 0, '', 10000000),
(21, 1, 0, '', 10000000),
(22, 1, 0, '', 3600),
(23, 1, 2, '', 300000),
(24, 1, 2, '', 3600),
(25, 1, 2, '', 0),
(26, 1, 2, '', 0),
(27, 1, 2, '', 0),
(28, 1, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE IF NOT EXISTS `crop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cropname` varchar(255) NOT NULL,
  `croptype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `crop`
--


-- --------------------------------------------------------

--
-- Table structure for table `cycle`
--

CREATE TABLE IF NOT EXISTS `cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cyclename` varchar(255) DEFAULT NULL,
  `farmid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `cycle`
--

INSERT INTO `cycle` (`id`, `cyclename`, `farmid`) VALUES
(1, 'plantcrop', 1),
(2, 'plantcrop', 2),
(3, 'plantcrop', 3),
(4, 'plantcrop', 3),
(5, 'plantcrop', 4),
(6, 'plantcrop', 5),
(7, 'plantcrop', 6),
(8, 'ratoon1', 1),
(9, 'ratoon1', 2),
(10, 'ratoon1', 3),
(11, 'ratoon1', 4),
(12, 'ratoon1', 5),
(13, 'ratoon2', 6),
(14, 'ratoon2', 6);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL,
  `weight` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_parent`
--

CREATE TABLE IF NOT EXISTS `data_parent` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_parent`
--


-- --------------------------------------------------------

--
-- Table structure for table `debit`
--

CREATE TABLE IF NOT EXISTS `debit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) NOT NULL,
  `journalid` bigint(20) NOT NULL DEFAULT '1',
  `assetype` varchar(255) NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `debit`
--

INSERT INTO `debit` (`id`, `accountid`, `journalid`, `assetype`, `amount`) VALUES
(1, 1, 1, '', 0),
(2, 1, 1, '', 0),
(3, 1, 1, '', 0),
(4, 0, 1, '', 0),
(5, 2, 1, '', 10000000),
(6, 2, 1, '', 10000000),
(7, 2, 1, '', 10000000),
(8, 1, 1, '', 0),
(9, 2, 1, '', 144000),
(10, 1, 1, '', 0),
(11, 41, 1, '', 10000000),
(12, 44, 1, '', 10000000),
(13, 45, 1, '', 10000000),
(14, 3, 1, '', 3600),
(15, 0, 1, '', 12012),
(16, 49, 2, '', 300000),
(17, 3, 2, '', 3600),
(18, 50, 2, '', 0),
(19, 3, 2, '', 0),
(20, 51, 2, '', 0),
(21, 52, 2, '', 0),
(22, 3, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plotnumber` varchar(255) NOT NULL,
  `canecycle` varchar(255) NOT NULL,
  `canestate` varchar(255) NOT NULL,
  `totalstack` bigint(20) unsigned NOT NULL,
  `deliverynote` varchar(255) NOT NULL,
  `baseprice` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `delivery`
--


-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `payroll` bigint(20) unsigned NOT NULL,
  `appointment` date NOT NULL,
  `grade` varchar(255) NOT NULL,
  `nationalid` bigint(20) unsigned NOT NULL,
  `address` varchar(255) NOT NULL,
  `nextofkin` bigint(20) unsigned NOT NULL,
  `nhifno` varchar(255) NOT NULL,
  `nssfno` varchar(255) NOT NULL,
  `krapin` bigint(20) unsigned NOT NULL,
  `homedistrict` varchar(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `employeetype` varchar(10) NOT NULL,
  `paymenttype` varchar(10) NOT NULL,
  `annulaleavedays` bigint(20) unsigned NOT NULL,
  `outstandingleavedays` bigint(20) unsigned NOT NULL,
  `promotiondate` varchar(10) NOT NULL,
  `currentgrade` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employee`
--


-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `officeCode` varchar(10) NOT NULL,
  `file_url` varchar(250) CHARACTER SET utf8 NOT NULL,
  `jobTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`employeeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employees`
--


-- --------------------------------------------------------

--
-- Table structure for table `exe;`
--

CREATE TABLE IF NOT EXISTS `exe;` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(244) NOT NULL,
  `lname` varchar(244) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `exe;`
--


-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE IF NOT EXISTS `farm` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `acre` int(11) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `dateofcontract` varchar(255) NOT NULL,
  `leasorname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`id`, `name`, `acre`, `zone`, `dateofcontract`, `leasorname`) VALUES
(1, 'AMUKURA_84', 12, 'TESO', '11-24-2012', 'wer'),
(2, 'AMUKURA_154', 12, 'Teso', '12-12-2012', 'khjgfd'),
(3, 'AMUKURA_140', 55, 'Teso', '12-12-2012', 'XYZ'),
(4, 'KWANGMOR_229', 25, 'Teso', '11-24-2012', 'XYZ'),
(5, 'NASIRA_111', 12, 'Busia', '11-24-2012', 'XYZ'),
(6, 'BUSIBWABO_112', 6, 'Buyofu', '11-24-2012', 'XYZ');

-- --------------------------------------------------------

--
-- Table structure for table `farmactivity`
--

CREATE TABLE IF NOT EXISTS `farmactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `landid` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `units` varchar(255) DEFAULT NULL,
  `promoterid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `farmactivity`
--


-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `username`, `password`, `owner`, `name`) VALUES
(1, NULL, NULL, '10', 'AMUKURA_84.xlsx'),
(2, NULL, NULL, '10', 'AMUKURA_84.xlsx'),
(3, NULL, NULL, '10', 'KWANGMOR_229.xlsx'),
(4, NULL, NULL, '10', 'NASIRA_111.xlsx'),
(5, NULL, NULL, '10', 'AMUKURA_140.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `journalname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `journalname`) VALUES
(1, 'Cash Receipts Journal'),
(2, 'Cash Payments Journal'),
(3, 'Sales Journal'),
(4, 'Sales Returns Journal'),
(5, 'Purchases Journal'),
(6, 'Purchase Returns Journal'),
(7, 'General Journal');

-- --------------------------------------------------------

--
-- Table structure for table `landactivity`
--

CREATE TABLE IF NOT EXISTS `landactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityid` int(11) DEFAULT NULL,
  `landid` int(11) DEFAULT NULL,
  `promoterid` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `units` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `landactivity`
--


-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  `membername` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `members`
--


-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) NOT NULL,
  `paymentdate` date NOT NULL,
  `basicsalary` bigint(20) unsigned NOT NULL,
  `medicalallowance` bigint(20) unsigned NOT NULL,
  `houseallowance` bigint(20) unsigned NOT NULL,
  `grosssalary` bigint(20) unsigned NOT NULL,
  `paye` bigint(20) unsigned NOT NULL,
  `nhifdeductions` varchar(255) NOT NULL,
  `nssfdeductions` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  `accountid` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `payroll`
--


-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

CREATE TABLE IF NOT EXISTS `posting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  `assetype` varchar(255) NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posting`
--


-- --------------------------------------------------------

--
-- Table structure for table `promoters`
--

CREATE TABLE IF NOT EXISTS `promoters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promoters`
--

INSERT INTO `promoters` (`id`, `name`) VALUES
(1, 'Dindi'),
(2, 'Ouma');

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE IF NOT EXISTS `revenue` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `cycleid` int(11) NOT NULL,
  `farm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenue`
--


-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE IF NOT EXISTS `season` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `growthmonth` varchar(255) NOT NULL,
  `expectedharvestmonth` varchar(255) NOT NULL,
  `actualharvestmonth` varchar(255) NOT NULL,
  `plotnumber` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `season`
--


-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicleid` bigint(20) unsigned NOT NULL,
  `lastservicedate` bigint(20) unsigned NOT NULL,
  `nextservicedate` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `service`
--


-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE IF NOT EXISTS `sparepart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sparepartname` bigint(20) unsigned NOT NULL,
  `sarepartquantity` bigint(20) unsigned NOT NULL,
  `sparepartprice` bigint(20) unsigned NOT NULL,
  `spareparttotalprice` varchar(255) NOT NULL,
  `accountid` bigint(20) unsigned NOT NULL,
  `journalid` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sparepart`
--


-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `statename`) VALUES
(1, 'Nairobi'),
(2, 'Kakamega'),
(3, 'Nyeri'),
(4, 'Kisumu'),
(5, 'fxcykvulbinopcgvbunimlknjh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_book`
--

CREATE TABLE IF NOT EXISTS `tb_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_book`
--

INSERT INTO `tb_book` (`id`, `title`, `author`) VALUES
(1, 'LIVE MY LIFE', 'ADAM SMITH'),
(2, 'NQCL', 'ALPHONCE OCHIENG'),
(3, 'CRESCENT FARM', 'DINDI HARRIS'),
(4, 'SMC', 'OSCAR OKWERO');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `cycleid` int(11) NOT NULL,
  `farmid` int(11) NOT NULL,
  `transactiontypeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `transactiontype`
--

CREATE TABLE IF NOT EXISTS `transactiontype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transactionname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transactiontype`
--

INSERT INTO `transactiontype` (`id`, `transactionname`) VALUES
(1, 'Revenue'),
(2, 'Cost');

-- --------------------------------------------------------

--
-- Table structure for table `transportrevenue`
--

CREATE TABLE IF NOT EXISTS `transportrevenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `dailytotal` double NOT NULL,
  `cummulativeamount` double NOT NULL,
  `periodexpected` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `transportrevenue`
--

INSERT INTO `transportrevenue` (`id`, `date`, `dailytotal`, `cummulativeamount`, `periodexpected`) VALUES
(1, '', 0, 107600, 0),
(2, '', 0, 554500, 0),
(3, '', 0, 107600, 0),
(4, '', 0, 107600, 0),
(5, '', 0, 71200, 0),
(6, '', 0, 971250, 0),
(7, '', 0, 107600, 0),
(8, '', 0, 107600, 0),
(9, '', 0, 107600, 0),
(10, '', 0, 107600, 0),
(11, '', 0, 107600, 0),
(12, '', 0, 107600, 0),
(13, '', 0, 107600, 0),
(14, '', 0, 107600, 0),
(15, '', 0, 107600, 0),
(16, '', 0, 107600, 0),
(17, '', 0, 107600, 0),
(18, '', 0, 107600, 0),
(19, '', 0, 107600, 0),
(20, '', 0, 107600, 0),
(21, '', 0, 10760090, 0),
(22, '', 0, 107600, 0),
(23, '', 0, 107600, 0),
(24, '', 0, 107600, 0),
(25, '', 0, 107600, 0),
(26, '', 0, 107600, 0),
(27, '', 0, 107600, 0),
(28, '', 0, 107, 0),
(29, '', 0, 107600, 0),
(30, '', 0, 107600, 0),
(31, '', 0, 107600, 0),
(32, '', 0, 107600, 0),
(33, '', 0, 2134665, 0),
(34, '', 0, 107600, 0),
(35, '', 0, 107600, 0),
(36, '', 0, 107600, 0),
(37, '', 0, 107600, 0),
(38, '', 0, 107600, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'CarenDindi', '5c77c760a6e4080ff205adc07edbff90', 'harrisdindisamuel@gmail.com', '2012-12-17 18:55:48', '2012-12-17 18:55:48'),
(3, 'dindiharris', 'b56578e2f9d28c7497f42b32cbaf7d68', 'samueldindiharris4@gmail.com', '2012-12-20 20:17:00', '2012-12-20 20:17:00'),
(4, 'bob', '9a618248b64db62d15b300a07b00580b', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `date`, `owner`, `username`, `password`) VALUES
(1, 'Caren Dindi', 'carendindi@gmail.com', '12-04-2012', NULL, NULL, NULL),
(3, '', '', '', NULL, '', ''),
(4, '', '', '', NULL, 'bob', '9a618248b64db62d15b300a07b00580b'),
(5, '', '', '', NULL, 'bob', '9a618248b64db62d15b300a07b00580b'),
(6, '', '', '', NULL, 'bob', '9a618248b64db62d15b300a07b00580b'),
(7, '', '', '', NULL, 'bob', '9a618248b64db62d15b300a07b00580b'),
(8, 'Caren Dindi', 'haris.samuel@strathmore.edu', '01-10-2013', NULL, NULL, NULL),
(9, '', '', '', NULL, 'hsdo', '123456'),
(10, '', '', '', NULL, 'user', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicletype` varchar(255) NOT NULL,
  `registrationnumber` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vehicle`
--


-- --------------------------------------------------------

--
-- Table structure for table `weighbirdge`
--

CREATE TABLE IF NOT EXISTS `weighbirdge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicleid` bigint(20) unsigned NOT NULL,
  `netweight` bigint(20) unsigned NOT NULL,
  `plotnumber` varchar(255) NOT NULL,
  `ticketnumber` varchar(255) NOT NULL,
  `canereceipt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `weighbirdge`
--


-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zonename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `zonename`) VALUES
(1, 'Busia'),
(2, 'Kosera'),
(3, 'Amagoro'),
(4, 'Kisoko');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_parent`
--
ALTER TABLE `data_parent`
  ADD CONSTRAINT `data_parent_ibfk_1` FOREIGN KEY (`did`) REFERENCES `data` (`id`);
