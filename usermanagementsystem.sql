-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2024 at 11:31 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_levels`
--

DROP TABLE IF EXISTS `account_levels`;
CREATE TABLE IF NOT EXISTS `account_levels` (
  `AccountLevelID` int NOT NULL AUTO_INCREMENT,
  `AccountLevelName` varchar(50) NOT NULL,
  `VisibilityStatus` int NOT NULL DEFAULT '1' COMMENT '1- Visible true / - - Visible False',
  PRIMARY KEY (`AccountLevelID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_levels`
--

INSERT INTO `account_levels` (`AccountLevelID`, `AccountLevelName`, `VisibilityStatus`) VALUES
(1, 'Administrator', 1),
(2, 'Staff 1', 1),
(3, 'Staff 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

DROP TABLE IF EXISTS `assessment`;
CREATE TABLE IF NOT EXISTS `assessment` (
  `AssessmentID` int NOT NULL AUTO_INCREMENT,
  `AssessmentName` varchar(50) NOT NULL,
  `AssessmentType` varchar(50) NOT NULL,
  PRIMARY KEY (`AssessmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_results`
--

DROP TABLE IF EXISTS `assessment_results`;
CREATE TABLE IF NOT EXISTS `assessment_results` (
  `CompanyName` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `PersonalityType` varchar(50) NOT NULL,
  `180` varchar(50) NOT NULL,
  `360` varchar(50) NOT NULL,
  `KnowledgeAssessment` varchar(50) NOT NULL,
  `CulturePulse` varchar(50) NOT NULL,
  `CompitencyGap` varchar(50) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `percent` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `RegistrationID` int NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `MarkAttendance` decimal(3,0) NOT NULL COMMENT '%',
  PRIMARY KEY (`RegistrationID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`RegistrationID`, `company`, `batch`, `Course`, `date`, `MarkAttendance`) VALUES
(1, '', '', '', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `banking`
--

DROP TABLE IF EXISTS `banking`;
CREATE TABLE IF NOT EXISTS `banking` (
  `bankID` int NOT NULL AUTO_INCREMENT,
  `accountName` varchar(50) NOT NULL,
  `accountNumber` varchar(25) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `swiftCode` varchar(50) NOT NULL,
  `bankCode` varchar(50) NOT NULL,
  `branchCode` int NOT NULL,
  PRIMARY KEY (`bankID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banking`
--

INSERT INTO `banking` (`bankID`, `accountName`, `accountNumber`, `bank`, `branch`, `swiftCode`, `bankCode`, `branchCode`) VALUES
(1, 'KAT De Silva ', '1117016200', 'Commercial Bank ', 'Pitakotte ', 'CCEYLKLX', '7056     Commercial Bank PLC', 117),
(2, 'T S Rahulan', '001-298132-040', 'HSBC', 'Head Office', '', '7092 Hongkong Shanghai Bank', 1),
(3, 'Rukshan De Silva ', '18500558001', 'Standard Chartered Bank ', 'Head Office ', 'n/a', '7038 Standard Chartered Bank', 999),
(4, 'Mendaka Hettithanthri', '086033384916101', 'Seylan Bank', 'Millennium Branch - Colombo 3', 'SEYBLKLX ', '7287 Seylan Bank PLC', 86),
(5, 'Chandana Pathirage ', '0077885009', 'Bank of Ceylon', 'Regent Street ', 'BCEYLKLX', '7010 Bank of Ceylon', 627);

-- --------------------------------------------------------

--
-- Table structure for table `batch_upload`
--

DROP TABLE IF EXISTS `batch_upload`;
CREATE TABLE IF NOT EXISTS `batch_upload` (
  `CompanyName` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

DROP TABLE IF EXISTS `calculations`;
CREATE TABLE IF NOT EXISTS `calculations` (
  `CalculationID` int NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `attendance` decimal(3,2) NOT NULL COMMENT '%',
  `ModuleViseScores` varchar(50) NOT NULL,
  `CourseScores` varchar(50) NOT NULL,
  `CourseRanking` varchar(50) NOT NULL,
  `BatchRanking` varchar(50) NOT NULL,
  PRIMARY KEY (`CalculationID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clientID` int NOT NULL AUTO_INCREMENT,
  `companyCode` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `clientName` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contactsName` varchar(50) NOT NULL,
  `contactsDesignation` varchar(50) NOT NULL,
  `contact1` varchar(15) NOT NULL,
  `contact2` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contactname` varchar(25) NOT NULL,
  `contactsDesig` varchar(50) NOT NULL,
  `contactno` int NOT NULL,
  `contactemail` varchar(50) NOT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientID`, `companyCode`, `clientName`, `address`, `contactsName`, `contactsDesignation`, `contact1`, `contact2`, `email`, `contactname`, `contactsDesig`, `contactno`, `contactemail`) VALUES
(1, 'SB-SYSCO', 'Sysco Lab', '55A Srimath Anagarika Dharmapala Mawatha, Colombo 00300', 'Ruchini Weeawardena', 'Manager - Talent Management and Development', '+94 77 107 0394', ' 0112 024 500', ' ruchini.weerawardena@sysco.com', '', '', 0, ''),
(2, 'SB-SING', 'Singer Sri Lanka', 'No. 400, Deans Road, Colombo 10.', 'Diani Hansika', 'Manager - Talent Management and Development', '+94 71 044 6115', '', 'dianih@singersl.com', '', '', 0, ''),
(3, 'SB-ATLAS', 'Atlas Axillia Co. (Pvt) Ltd.', '96, Parakrama Road, Old Kandy Rd, Peliyagoda 11830', 'Vimarshana Gamanpilla', 'Manager - Human Resource ', '+94 77 025 3926', '0115320320', ' vimarshana.g@atlasaxillia.com', '', '', 0, ''),
(45, 'SB-HAYLEYS FNTNS', 'Hayleys Fentons', '180, Deans Road, Colombo 10, Sri Lanka', 'Dulanga Gamage', 'Manager - HRD', '0775292429', '011 2 448 518', 'dulanga.gamage@hayleysfentons.com', '', '', 0, ''),
(46, 'SB-SPA CEYLON', 'Spa Ceylon', 'Park Street Mews 12th Floor, Parkland Building, Colombo', 'Paramjit Kaur', 'PA to Director - Shalin Balasuriya', '0766816230', '0115114460', 'paramjit@spaceylon.com', '', '', 0, ''),
(47, 'SB-JAT', 'JAT Holding', '351 Pannipitiya Road, Thalawathugoda', 'Bawantha Kothalawala', 'Asst Manager Talent Empowerment', '0770599632', '0114407700', 'bawantha.kothalawala@jatholdings.com', '', '', 0, ''),
(48, 'SB-NEXTM', 'Next Manufacturing Pvt Ltd', 'Phase 1, Ring Road 2, Katunayake', 'Malaka Ihalagedara', 'Senior Manager - HR & Communication', '0769884899', '0114839900', 'malakai@nml.nextsourcing.com', '', '', 0, ''),
(49, 'SB-TJ', 'Teejay Lanka PLC', 'Seethawaka, Western Province', 'Niluka Bandara', 'Senior Manager - Talent Engagement & Development', '0762079209', '0364279500', 'nilukaba@teejay.com', '', '', 0, ''),
(50, 'SB-LAUGHS', 'Laugfs Holdings', '101,Maya Avenue, Colombo 06', 'Dinushika Madhubhashini', 'Senior Manager - Group Learning & Development - HR', '0769186036', '0115566222-EXT-', 'dinushika.madhibhashini@laugfs.lk', '', '', 0, ''),
(51, 'SB-CTC', 'Ceylon Tobacco Company PLC', '175,Paranaganthota Road, Mawilmada, Kandy', 'Thimal Peiris', 'HR Business Partner - Leaf', '0770063922', '0814484200', 'thimal_peiris@bat.com', '', '', 0, ''),
(52, 'SB-PGP', 'PGP Glass Ceylon PLC', 'Wagawaththa Road, Poruwadanda, Horana', 'Sashini Manamperi', 'Senior Executive - Talent Management', '0762989218', '', 'sashini.manamperi@pgpfirst.com', '', '', 0, ''),
(53, 'SB-NTB', 'Nations Trust Bank', 'No. 242, Union Place, Colombo 2', 'Gihan Suwaris', '', '0772368204', '0114 711 411', 'gihan.suwaris@nationstrust.com', '', '', 0, ''),
(54, 'SB-INQB', 'Inqube Global Pvt Ltd', '606B, Siri Sumanathissa Mawatha, Nawagamuwa South, Ranala', 'Dinindu Jayasekara', '', '0769912370', '011 755 5444', 'dnjayasekara@gmail.com', '', '', 0, ''),
(55, 'SB-PLWT', 'Pelwatte Dairy Industries Pvt Ltd', 'A4, Perahera Mawatha, Colombo - 03', 'Gihan Gunatilaka', '', '0706884364', '0112 452 094', 'gihan@pelwattedairy.com', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_review`
--

DROP TABLE IF EXISTS `consultant_review`;
CREATE TABLE IF NOT EXISTS `consultant_review` (
  `StudentName` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `AssessmentType` varchar(50) NOT NULL,
  `ConsultantReview` varchar(50) NOT NULL,
  `SupervisorReview` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contactID` int NOT NULL AUTO_INCREMENT,
  `clientID` int DEFAULT NULL,
  `contactName` varchar(255) DEFAULT NULL,
  `contactDesignation` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `contactEmail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contactID`),
  KEY `clientID` (`clientID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `clientID`, `contactName`, `contactDesignation`, `contactNumber`, `contactEmail`) VALUES
(4, 2, 'dd', 'eryeye', '0711720004', '2002maheshani@gmail.com'),
(5, 3, 'maheshani', 'eryeye', '0711720004', 'dd@gmail.com'),
(8, 1, 'h', 'gg', 'gg', 'dd@gmail.com'),
(16, 1, 'v', 'v', 'v', 'dd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `courseID` int NOT NULL AUTO_INCREMENT,
  `courseCode` varchar(6) NOT NULL,
  `CourseName` varchar(50) NOT NULL,
  `moduleNo` varchar(6) NOT NULL,
  `moduleName` varchar(50) NOT NULL,
  `duration(h)` varchar(6) NOT NULL,
  `duration(days)` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseCode`, `CourseName`, `moduleNo`, `moduleName`, `duration(h)`, `duration(days)`) VALUES
(1, 'WIL', 'Women in Leadership Program', '12', 'Leadership Transition  & Mastery', '96h', '192 days'),
(2, 'SIN', 'PLDP', '5', 'Leadership Transition  & Mastery', '48h', '88 days');

-- --------------------------------------------------------

--
-- Table structure for table `create_batches`
--

DROP TABLE IF EXISTS `create_batches`;
CREATE TABLE IF NOT EXISTS `create_batches` (
  `RegistrationID` int NOT NULL AUTO_INCREMENT,
  `client` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `batchName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `budgetParticipant` int NOT NULL,
  `year` year NOT NULL,
  `course` varchar(50) NOT NULL,
  `StartDate` varchar(10) NOT NULL,
  `EndDate` varchar(10) NOT NULL,
  PRIMARY KEY (`RegistrationID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `create_batches`
--

INSERT INTO `create_batches` (`RegistrationID`, `client`, `batchName`, `budgetParticipant`, `year`, `course`, `StartDate`, `EndDate`) VALUES
(1, 'Sysco Lab', 'SYSCO-APEX', 61, 2023, 'Women in Leadership Program', '30/11/2023', '09/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `deceleration_and_commitment`
--

DROP TABLE IF EXISTS `deceleration_and_commitment`;
CREATE TABLE IF NOT EXISTS `deceleration_and_commitment` (
  `decId` int NOT NULL AUTO_INCREMENT,
  `onceMonth` date NOT NULL,
  `twiceMonth` date NOT NULL,
  `thriceMonth` date NOT NULL,
  `weekly` date NOT NULL,
  PRIMARY KEY (`decId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `facultyid` int NOT NULL AUTO_INCREMENT,
  `callingName` varchar(25) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobileNo1` int NOT NULL,
  `mobileNo2` int NOT NULL,
  `emergencyContact` varchar(50) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `currentEmployee` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facultyLevel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(10) NOT NULL,
  `type2` varchar(10) NOT NULL,
  `careersStartY` date NOT NULL,
  `yoe` varchar(10) NOT NULL,
  `expertiseArea1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expertiseArea2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expertiseArea3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expertiseArea4` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `formalQualification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `weekends` varchar(20) NOT NULL,
  `daysPerMonth` int NOT NULL,
  `totalAvailability` int NOT NULL,
  `weekends2` varchar(20) NOT NULL,
  `daysPerMonth2` varchar(20) NOT NULL,
  `TotalDaysPerYear` varchar(20) NOT NULL,
  `capacity` varchar(10) NOT NULL,
  PRIMARY KEY (`facultyid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyid`, `callingName`, `nic`, `address`, `mobileNo1`, `mobileNo2`, `emergencyContact`, `designation`, `currentEmployee`, `facultyLevel`, `type`, `type2`, `careersStartY`, `yoe`, `expertiseArea1`, `expertiseArea2`, `expertiseArea3`, `expertiseArea4`, `formalQualification`, `weekends`, `daysPerMonth`, `totalAvailability`, `weekends2`, `daysPerMonth2`, `TotalDaysPerYear`, `capacity`) VALUES
(1, 'Angelo De Silva ', '841490673V', '141/1A Elvin Place, High Level Road, Nugegoda ', 773337206, 770757878, 'Menaka - 0777009181', '', '', '', '', '', '0000-00-00', '0000', 'Entrepreneurial Thinking', 'Leadership Development', 'Leadership Development', 'Negotiation', '', '', 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `clientID` int NOT NULL AUTO_INCREMENT,
  `company` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `salesStage` varchar(20) NOT NULL,
  `date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lead` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `leadType` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `requirement` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estimateSalesValue` text NOT NULL,
  `lostLeadDate` varchar(20) NOT NULL,
  `preliminaryBrochures` int NOT NULL,
  `emailClient` int NOT NULL,
  `sheduleCM` int NOT NULL,
  `chemMeeting` int NOT NULL,
  `proposal` int NOT NULL,
  `estimate` int NOT NULL,
  `confirmation` int NOT NULL,
  `cof` int NOT NULL,
  `po` int NOT NULL,
  `invoice` int NOT NULL,
  `payment` varchar(10) NOT NULL,
  `paymentStatus` varchar(25) NOT NULL,
  `program` int NOT NULL,
  `postSalesFollowUp` int NOT NULL,
  `protofolioEmail` int NOT NULL,
  `newBusinessMeeting` int NOT NULL,
  `completionStatus` int NOT NULL,
  `notes` varchar(100) NOT NULL,
  `followUp` varchar(100) NOT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci DELAY_KEY_WRITE=1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`clientID`, `company`, `salesStage`, `date`, `lead`, `leadType`, `requirement`, `estimateSalesValue`, `lostLeadDate`, `preliminaryBrochures`, `emailClient`, `sheduleCM`, `chemMeeting`, `proposal`, `estimate`, `confirmation`, `cof`, `po`, `invoice`, `payment`, `paymentStatus`, `program`, `postSalesFollowUp`, `protofolioEmail`, `newBusinessMeeting`, `completionStatus`, `notes`, `followUp`) VALUES
(1, 'Morisons Limited', '0', '', 'Morrisons PLDP B2', 'PLDP', '', '0', '', 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, '0.5', '0', 0, 0, 0, 0, 0, '', ''),
(2, 'EY SRI LANKA', '0', '', 'CSP™', 'CSP', '', '5000000', '', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, '1', '0', 0, 0, 0, 0, 0, '', ''),
(3, 'C W Mackie ', '0', '18 May 2023', 'PLDP Batch 01', 'PLDP', '', '0', '', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, '1', '0', 0, 0, 0, 0, 0, '', ''),
(4, 'C W Mackie ', '0', '', 'Mackie PLC Batch 02', 'PLDP', '', '0', '', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '0.5', '0', 0, 0, 0, 0, 0, '', ''),
(5, 'Sysco Labs', '0', '19 May 2023', 'Sysco Labs PLDP™', 'PLDP', '', '0', '', 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(6, 'Atlas Axillia ', '0', '29 May 2023', 'Atlas PLDP', 'PLDP', '', '0', '', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(7, 'HAYCARB', '0', '', 'Haycarb PLDP B2', 'PLDP', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '0.5', '0', 0, 0, 0, 0, 0, '', ''),
(8, 'Fortude', '0', '13 June 2023', ' BDO Team culture alignment', 'CULTURE ALIGNMENT', '', '0', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 1, 1, 1, 0, '', ''),
(9, 'DPL', '0', '', 'EDP©', 'EDP', '', '1350000', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(10, 'DPL', '0', '13 June 2023', 'PLDP', 'EDP', '', '0', '', 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(11, 'EY GDS', '0', '18 July 2023', 'Communications Programme', 'ONE DAY TRAINING', '30 pax per batch x 3 -A 4-module program targeting: Written  communication for  service & consulting', '0', '', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(12, 'EY GDS', '0', '18 July 2023', 'Leadership Offsite', 'ONE DAY TRAINING', '3 day 2 nights (2  workshop days)  residential program targeting the ethos  of being a  counsellor, ', '0', '', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(13, 'EY GDS', '0', '18 July 2023', 'Team Building Long Term', '', 'An activity engaging approximately 200  staff members,  conduced offsite  simulating team  collabora', '1', '', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(14, 'SEYLAN', '0', '2023-09-20', 'OAR™', 'OAR', '', '462', '2024-09-21', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 1, '', ''),
(15, 'Xigenix', '0', '20 July 2023', '', 'CSP™', '', '0', '', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, '0', '0', 0, 0, 0, 0, 0, '', ''),
(16, 'KERRY LOGISTICS', '0', '28 July 2023', 'Leadership coaching ', 'PLDP', 'We connected on LinkedIn some time back. I wondered if you could customize a program for my operatio', '1', '15 August 2023', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(17, 'SINGER', '0', '', 'PLDP', 'PLDP', '', '0', '', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, '1', '0', 0, 0, 0, 0, 0, '', ''),
(18, 'DURDANS', '0', '', 'CSP™', '', '', '0', '2023-11-06', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(19, 'ATG GLOVE SOLUTION', '0', '2023-08-11', 'PLDP', 'PLDP', '', '0', '2024-01-23', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(20, 'HIRDARAMANI', '0', '2023-08-11', 'CSP™', '', '', '0', '2024-01-23', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(21, 'PARENTPAY', '0', '17 August 2023', 'CSP™', 'CSP™', '', '0', '04 December 2023', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(22, 'CTC', '0', '09 October 2023', 'Awareness Programme', 'ONE DAY TRAINING', '', '350', '06 November 2023', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(23, 'NTB', '0', '17 October 2023', 'Engagement Survey ', 'CUSTOM', '2500 people, Happiness/satisfaction/engagement survey. Pls send proposal the sooner the better', '0', '19 October 2023', 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(24, 'FAO', '0', '13 November 2023', 'One day Program', 'ONE DAY TRAINING', 'Team building/ fun activities as well as to facilitate to reflect on FAO’s achievements and draw bac', '0', '14 November 2023', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(25, 'Assetline Leasing', '0', '21 November 2023', 'One day Program', 'ONE DAY TRAINING', 'a special leadership training program for our Assistant Manager and above team. ', '0', '23 November 2023', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(26, 'DILMAH TEA', '0', '2023-10-03', 'EDP©', 'EDP', '', '0', '2024-01-18', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(27, 'DILMAH TEA', '0', '2023-10-03', 'PLDP', 'PLDP', '', '0', '2024-01-18', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(28, 'HAYLEYS AVIATION', '0', '15 September 2023', 'STRATEGY SESSION', 'STRATEGY', '', '0', '', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(29, 'HEMAS PLC', '0', '2024-10-06', 'PLDP', 'PLDP', '', '0', '2023-11-21', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(30, 'UNICEF', '0', '26 September 2023', 'PLDP', '', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(31, 'Sysco Labs', '0', '04 October 2023', 'Sysco LABS Womens PLDP', 'PLDP', '', '0', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 0, 0, 0, 0, 0, '', ''),
(32, 'Ladies College', '0', '', 'One day Program', '', 'Team buiding and strategy programme', '0', '2024-01-08', 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(33, 'HSBC', '0', '06 October 2023', 'STRATEGY SESSION', 'STRATEGY', 'Help senior retail sales team to formulate how to cascade their goals down to the broader teams and ensure action plans that work. ', '900', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(34, 'GAMMA PIZZA KRAFT', '0', '2023-10-09', '2 DAY OFFSITE', '', '', '0', '2024-02-19', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(35, 'BCD Travel', '0', '2023-10-23', 'Senior Leadership PLDP', 'PLDP', '', '0', '2024-01-04', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(36, 'IFS', '0', '18 October 2023', '', '', 'Communicate for front end staff', '0', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(37, 'Laugfs Rubber Horana', '0', '2023-11-06', 'Behavioral Coaching', '', '4 senior team members who in in General manager position to Manager grades which we need to conduct an assessment-based Coaching for 4-6 months', '0', '2024-01-24', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(38, 'HEMAS - Mobility Sec', '0', '2023-12-06', 'Strategy Session', 'Capacity Building', 'training sessions for our Customer Service Team and Middle Managers within the HEMAS Mobility Sector.', '2050000', '', 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(39, 'JAT Holdings', '0', '12 November 2023', 'PLDP', 'PLDP', 'Leadership Development Program for some of the executive level staff', '0', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(40, 'ANSELL', '0', '2024-11-14', 'PLDP', 'PLDP', '', '2', '', 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, '0', '0', 0, 0, 0, 0, 0, '14.11.2023 - COF email sent', ''),
(41, 'Nestle', '0', '22 November 2023', 'One day Program', 'ONE DAY TRAINING', '', '0', '', 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(42, 'Nestle', '0', '22 November 2023', 'PLDP', 'PLDP', '', '0', '', 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(43, 'Next Manufacturing', '0', '22 November 2023', 'One day Program', 'ONE DAY TRAINING', '', '0', '', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(44, 'Hayleys Plantation', '0', '24 November 2023', 'PLDP', 'PLDP', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(45, 'Sysco Labs MIL PLDP', '0', '', '', '', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(46, 'Hayleys HR Team', '0', '', '', '', '', '0', '', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(47, 'Sysco Culture Pulse', '0', '', '', '', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(48, 'Mackie PLC', '0', '', 'Mackie Transformation Consultation', '', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(49, 'Sysco Labs', '0', '', 'Sysco LABS OKR Cascade', '', '', '0', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(50, 'Hemas Holdings ', '0', '', 'HEMAS Summer Internship', 'CUSTOM', 'Angelo Speaking session ', '0', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(51, 'Hayleys Aventura ', '0', '', 'Hayleys Aventura PLDP', 'PLDP', '', '0', '', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(52, 'Hayleys Fentons', '0', '', 'PLDP', 'PLDP', '', '2255000', '', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(53, 'SPA CEYLON ', '0', '2024-01-22', 'CSP™', 'CSP', '', '0', '', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, 'Feedback by 28th Feb 2024', ''),
(54, 'FORTUDE', '0', '11 August 2023', 'CULTURE CANVAS ANZ+ASIA', 'CULTURE ALIGNMENT', '', '400', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(55, 'FORTUDE', '0', '11 August 2023', 'CULTURE CANVAS USA+UK', 'CULTURE ALIGNMENT', '', '400', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(56, 'FORTUDE', '0', '11 August 2023', 'CULTURE CANVAS ARJUNA + REPORTEES', 'CULTURE ALIGNMENT', '', '400', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 0, 0, 0, 0, 0, '', ''),
(57, 'FORTUDE', '0', '11 August 2023', 'CULTURE CANVAS RCOO', 'CULTURE ALIGNMENT', '', '200', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '0', 1, 0, 0, 0, 0, '', ''),
(58, 'EY GDS', '0', '18 July 2023', 'Team Leaders ', '', '25 pax per batch x 3 -Program targeting  mind level and team  level leadership  behaviour and  competency. Key  focus will be on  Emotional  Intelligence,  Managing People,  managing  productivity &  Projects, Managing  financial insights,  Bottom line driven  thinking and  presentation and  change management and implementation', '0', '', 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(59, 'International Distil', '0', '02 January 2024', 'PLDP', 'PLDP', '', '0', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, 0, 0, 0, 0, '', ''),
(177, 'Nations', '', '2024-02-05', 'Feedback Survey', 'Other', '360 Degree Feedback Survey', '0', '', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(176, 'Ceylon', '', '2024-01-29', 'Internship Programme', 'OAR', 'Final Assessment centre & training sessions', '', '2024-02-21', 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(180, 'Pelwatte', '', '2024-02-12', 'Culture Audit', 'Other', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(173, 'Singer', '', '2024-02-19', 'Strategy Session', 'Capacity Building', '', '756000', '', 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(174, 'Singer', '', '2024-02-22', '', 'CSP', 'Training for Call Centre Agents', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(175, 'PGP', '', '2024-02-20', 'PLDP', 'PLDP', 'Managerial Development Program', '0', '', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '10', 0, 0, 0, 0, 10, '', ''),
(179, 'Inqube', '', '2024-01-19', 'MDP', 'PLDP', 'Management Development Program', '0', '', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, '0', '10', 0, 0, 0, 1, 10, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mannual registration`
--

DROP TABLE IF EXISTS `mannual registration`;
CREATE TABLE IF NOT EXISTS `mannual registration` (
  `RegistrationID` int NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `PrimaryField` varchar(50) NOT NULL,
  `calculatedField` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`RegistrationID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `ModuleID` int NOT NULL AUTO_INCREMENT,
  `ModuleName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `moduleType` varchar(15) NOT NULL,
  `duration` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `primaryFaculty` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `secondaryFaculty` varchar(50) NOT NULL,
  `tertiaryFaculty` varchar(50) NOT NULL,
  `Assessment` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'yes/no',
  `file` varchar(1000) NOT NULL,
  PRIMARY KEY (`ModuleID`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`ModuleID`, `ModuleName`, `moduleType`, `duration`, `description`, `primaryFaculty`, `secondaryFaculty`, `tertiaryFaculty`, `Assessment`, `file`) VALUES
(1, 'WS1 -Leadership Transition  & Mastery ', '', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', 'uploads/Mori- Attendance.xlsx'),
(4, 'WS4 -Coaching &  Developing People', '', '8 h', 'Woman in Leadership Program', 'Chandana Pathirage', '', '', 'yes', ''),
(2, 'WS2 -Managing People &  Teams', '', '8 h', 'Woman in Leadership Program', 'Additional Guest Resource', '', '', 'yes', 'uploads/Challenges of International Human Resource Management.pdf'),
(3, 'WS3 -Emotional  Intelligence for Leaders', '', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', ''),
(5, 'WS5 -Entrepreneurial  Thinking', '', '8 h', 'Woman in Leadership Program', 'Angelo De silva', '', '', 'yes', ''),
(6, 'WS6 -Finance for Business', '', '8 h', 'Woman in Leadership Program', 'Shazil Ismail', '', '', 'yes', 'uploads/Product.xlsx'),
(7, 'WS7 -Productivity &  Project Management', '', '8 h', 'Woman in Leadership Program', 'Mendaka Hettithantri', '', '', 'yes', ''),
(8, 'WS8 –Decision Making &  Problem Solving', '', '8 h', 'Woman in Leadership Program', 'Tilak Rahulan', '', '', 'yes', ''),
(9, 'WS9 -Leadership Presence  & Inspiration', '', '8 h', 'Woman in Leadership Program', 'Additional Guest Resource', '', '', 'yes', ''),
(11, 'WS11 -Management-Level  Communication', '', '8 h', 'Woman in Leadership Program', 'Mendaka Hettithantri', '', '', 'yes', ''),
(12, 'WS12 –Design Thinking', '', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', ''),
(13, 'Managing  people P1', '', '8 h', '', 'Angelo De Silva', '', '', 'yes', ''),
(14, 'Managing  People P2', '', '8 h', '', 'Angelo De Silva', '', '', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `one_to_one_assessment`
--

DROP TABLE IF EXISTS `one_to_one_assessment`;
CREATE TABLE IF NOT EXISTS `one_to_one_assessment` (
  `StudentID` int NOT NULL AUTO_INCREMENT,
  `company` varchar(20) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `StudentName` varchar(50) NOT NULL,
  `comments` varchar(50) NOT NULL,
  `yes/no` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

DROP TABLE IF EXISTS `student_registration`;
CREATE TABLE IF NOT EXISTS `student_registration` (
  `reg_id` int NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(100) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `clientID` int NOT NULL,
  `courseID` int NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`reg_id`, `StudentName`, `Email`, `clientID`, `courseID`) VALUES
(4, 'maheshani rathnayake', '2002maheshan@gmail.com', 1, 3),
(5, 'maheshani', 'fty@gmailcom', 2, 3),
(6, 'dfwe', 'fefe', 3, 2),
(7, 'ss', 'ss', 3, 5),
(8, 'gggg', 'gggg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE IF NOT EXISTS `sys_users` (
  `UserID` int NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Gender` varchar(6) NOT NULL DEFAULT 'Male' COMMENT 'Male/Female',
  `DOB` date DEFAULT NULL,
  `Designation` varchar(25) DEFAULT 'N/A' COMMENT 'Max Char 25',
  `Phone1` varchar(10) DEFAULT 'N/A',
  `Phone2` varchar(10) DEFAULT 'N/A',
  `Address` varchar(50) DEFAULT 'N/A',
  `Email` varchar(50) NOT NULL DEFAULT 'N/A',
  `Username` varchar(10) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `profileImg` longblob,
  `AccountLevel` int NOT NULL COMMENT '1-Admin  2-FC  3-TC',
  `Status` varchar(9) NOT NULL DEFAULT 'active' COMMENT 'active / Inactive',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`UserID`, `FirstName`, `LastName`, `Gender`, `DOB`, `Designation`, `Phone1`, `Phone2`, `Address`, `Email`, `Username`, `Password`, `profileImg`, `AccountLevel`, `Status`) VALUES
(1, 'Maheshani', 'Rathnayake', 'Female', '2002-01-05', 'IT Support', '0711720004', '', 'Colombo', '2002maheshanirathnayake@gmail.com', 'maheshani', '25d55ad283aa400af464c76d713c07ad', '', 1, 'active'),
(2, 'Lavindi', 'De Silva', 'Female', '2002-01-05', 'Lead Admin', '0711720004', '', 'Colombo', '2002maheshanirathnayake@gmail.com', 'Lavindi', 'sandbox@234234', NULL, 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `update_attendance`
--

DROP TABLE IF EXISTS `update_attendance`;
CREATE TABLE IF NOT EXISTS `update_attendance` (
  `CompanyName` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `PersonalityTest` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `180` varchar(50) NOT NULL,
  `360` varchar(50) NOT NULL,
  `KnowledgeAssessment` varchar(50) NOT NULL,
  `CulturePulse` varchar(50) NOT NULL,
  `CompitencyGap` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients` ADD FULLTEXT KEY `companyCode` (`companyCode`);
ALTER TABLE `clients` ADD FULLTEXT KEY `companyCode_2` (`companyCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
