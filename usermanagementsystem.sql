-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2024 at 12:01 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banking`
--

INSERT INTO `banking` (`bankID`, `accountName`, `accountNumber`, `bank`, `branch`, `swiftCode`, `bankCode`, `branchCode`) VALUES
(1, 'KAT De Silva ', '1117016200', 'Commercial Bank ', 'Pitakotte ', 'CCEYLKLX', '7056     Commercial Bank PLC', 117),
(2, 'T S Rahulan', '001-298132-040', 'HSBC', 'Head Office', '', '7092 Hongkong Shanghai Bank', 1),
(3, 'Rukshan De Silva ', '18500558001', 'Standard Chartered Bank ', 'Head Office ', 'n/a', '7038 Standard Chartered Bank', 999),
(4, 'Mendaka Hettithanthri', '086033384916101', 'Seylan Bank', 'Millennium Branch - Colombo 3', 'SEYBLKLX ', '7287 Seylan Bank PLC', 86),
(5, 'Chandana Pathirage ', '0077885009', 'Bank of Ceylon', 'Regent Street ', 'BCEYLKLX', '7010 Bank of Ceylon', 627),
(10, '5455', '', '', '', '', 'Visiting Lecturer', 0);

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
  `Industry` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientID`, `companyCode`, `clientName`, `address`, `Industry`, `Country`, `contactsName`, `contactsDesignation`, `contact1`, `contact2`, `email`, `contactname`, `contactsDesig`, `contactno`, `contactemail`) VALUES
(1, 'SBCL-SYSCO', 'Sysco Lab', '55A Srimath Anagarika Dharmapala Mawatha, Colombo 00300', '', 'Sri Lanka', 'Ruchini Weeawardena', 'Manager - Talent Management and Development', '+94 77 107 0394', ' 0112 024 500', ' ruchini.weerawardena@sysco.com', '', '', 0, ''),
(2, 'SBCL-SINGE', 'Singer Sri Lanka', 'No. 400, Deans Road, Colombo 10.', '', 'Sri Lanka', 'Madushika Sadamali', 'HR Development Assistant ', '716525012', '', 'madushikas@singersl.com', '', '', 0, ''),
(3, 'SBCL-ATLAS', 'Atlas Axillia Co. (Pvt) Ltd.', '96, Parakrama Road, Old Kandy Rd, Peliyagoda 11830', '', 'Sri Lanka', 'Nehha Saraaanan', 'HR', '0741966819', '115320320', 'nehha.s@atlasaxillia.com', '', '', 0, ''),
(45, 'SBCL-FENTO', 'Hayleys Fentons', '180, Deans Road, Colombo 10, Sri Lanka', '', 'Sri Lanka', 'Daham Bandarathilaka', 'Manager - HRD', '0777332061', '011 2 448 518', 'Daham.Bandarathilaka@hayleysfentons.com', '', '', 0, ''),
(46, 'SBCL-SPACE', 'Spa Ceylon', 'Park Street Mews 12th Floor, Parkland Building, Colombo', '', 'Sri Lanka', 'Paramjit Kaur', 'PA to Director - Shalin Balasuriya', '766816230', '115114460', 'paramjit@spaceylon.com', '', '', 0, ''),
(47, 'SBCL-JAT', 'JAT Holding', '351 Pannipitiya Road, Thalawathugoda', '', 'Sri Lanka', 'Bawantha Kothalawala', 'Asst Manager Talent Empowerment', '770599632', '114407700', 'bawantha.kothalawala@jatholdings.com', '', '', 0, ''),
(48, 'SBCL-NEXTM', 'Next Manufacturing Pvt Ltd', 'Phase 1, Ring Road 2, Katunayake', '', 'Sri Lanka', 'Malaka Ihalagedara', 'Senior Manager - HR & Communication', '769884899', '114839900', 'malakai@nml.nextsourcing.com', '', '', 0, ''),
(49, 'SBCL-TJ', 'Teejay Lanka PLC', 'Seethawaka, Western Province', '', 'Sri Lanka', 'Niluka Bandara', 'Senior Manager - Talent Engagement & Development', '762079209', '364279500', 'nilukaba@teejay.com', '', '', 0, ''),
(50, 'SBCL-LAUGH', 'Laugfs Holdings', '101,Maya Avenue, Colombo 06', '', 'Sri Lanka', 'Dinushika Madhubhashini', 'Senior Manager - Group Learning & Development - HR', '769186036', '0115566222-EXT-', 'dinushika.madhibhashini@laugfs.lk', '', '', 0, ''),
(51, 'SBCL-CTC', 'Ceylon Tobacco Company PLC', '175,Paranaganthota Road, Mawilmada, Kandy', '', 'Sri Lanka', 'Thimal Peiris', 'HR Business Partner - Leaf', '770063922', '814484200', 'thimal_peiris@bat.com', '', '', 0, ''),
(52, 'SBCL-PGP', 'PGP Glass Ceylon PLC', 'Wagawaththa Road, Poruwadanda, Horana', '', 'Sri Lanka', 'Sashini Manamperi', 'Senior Executive - Talent Management', '762989218', '', 'sashini.manamperi@pgpfirst.com', '', '', 0, ''),
(53, 'SBCL-NTB', 'Nations Trust Bank', 'No. 242, Union Place, Colombo 2', '', 'Sri Lanka', 'Gihan Suwaris', '', '772368204', '0114 711 411', 'gihan.suwaris@nationstrust.com', '', '', 0, ''),
(54, 'SBCL-INQUB', 'Inqube Global Pvt Ltd', '606B, Siri Sumanathissa Mawatha, Nawagamuwa South, Ranala', '', 'Sri Lanka', 'Dinindu Jayasekara', '', '769912370', '011 755 5444', 'dnjayasekara@gmail.com', '', '', 0, ''),
(55, 'SBCL-PELWA', 'Pelwatte Dairy Industries Pvt Ltd', 'A4, Perahera Mawatha, Colombo - 03', '', 'Sri Lanka', 'Gihan Gunatilaka', '', '706884364', '0112 452 094', 'gihan@pelwattedairy.com', '', '', 0, ''),
(56, 'SBCL-MIL IT', 'Millennium IT ESP', '450D, R A De Mel Mawatha, Colombo 03', '', 'Sri Lanka', 'Sayuri', '', '773210242', '', 'sayurit@mitesp.com', '', '', 0, ''),
(57, 'SBCL-STCH', 'Save the Children', '18 Sinsapa Rd, Colombo 06', '', 'Sri Lanka', 'Shanika Pigera', 'Director Human Resources ', '773187272', '112555336', 'shanika.pigera@savethechildren.org', 'None', 'None', 0, 'None'),
(58, 'SBCL-CBCTS', 'CBC Tech Solutions LTD', '285, 3rd Floor, Galle Road, Colombo 03', '', 'Sri Lanka', 'Sachithra De Alwis', 'Head - HR', '+9476 490 6693', '', 'sachithraa@cbctechsol.com', 'None', 'None', 0, 'None'),
(59, 'SBCL-MORIS', 'Morison Limited', 'Hemas House, 3rd Floor, 75, Braybrooke Place, Colombo 02', 'Pharmeceutical', 'Sri Lanka', 'Ishanka Perera', 'Assistant Manager-HR Business Partnering-Sales', '+9471 870 7035', '+94114 731 731', 'ishanka@morison.lk', 'None', 'None', 0, 'None'),
(60, 'SBCL-EYSL', 'Ernst & Young Sri Lanka', '201,De Saram Place, Colombo 02', '', 'Sri Lanka', 'Jessica Lewis', 'Manager - Talent Team', '94777312802', '94112463500', 'Jessica.Lewis@lk.ey.com', 'None', 'None', 0, 'None'),
(61, 'SBCL-CWMCK', 'C W Mackie PLC', '36, D.R.Wijewardena Mawatha, Colombo 10', 'Food & Beverage', 'Sri Lanka', 'Geeth Wickramatunge', 'Group Human Resources Manager', '94770264057', '94112423563', 'geeth@hr.cwmackie.com', 'None', 'None', 0, 'None'),
(62, 'SBCL- BLMS', 'Balmond Studio', '01, 33rd lane, Bagatalle Road, Colombo 03,', 'Architecture', 'Sri Lanka', 'James Balmond', 'Creative Director', '778377096', '', 'jae@balmondstudio.net', 'None', 'None', 0, 'None'),
(63, 'SBCL-HAYCA', 'Haycarb PLC', '400, Deans Road, Colombo 10', 'Activated Carbon Manufacturing', 'Sri Lanka', 'Saveen Hettiarachchi', 'HR - Executive', '772210717', '', 'sol@haycarb.com', 'None', 'None', 0, 'None'),
(64, 'SBCL-FORTU', 'Fortude (Pvt) Ltd', '146 Kynsey Road Colombo 7', 'IT Consulting', 'SL/UK/USA/NZ/AUS', 'Anjalie Jasenthuliyana', 'Senior Manager- Talent Development & Culture', '742713656', '011 453 1531', 'anjaliej@fortude.co', 'None', 'None', 0, 'None'),
(65, 'SBCL-DPL', 'Dipped Products PLC', '400, Deans Road, Colombo 10', 'global manufacturer of protective hand-wear', 'Sri Lanka', 'Thusitha Perera', '', '773635504', '', 'thusitha.perera@dplgroup.com', 'None', 'None', 0, 'None'),
(66, 'SBCL-GAIA', 'Gaia Greenenergy Holdings', 'No 140A, Vauxhall Street, Colombo 02', 'Energy Development', 'Sri Lanka', 'Uthpala', '', '703858260', ' 0112332858 | 0', 'uthpala@gaiagreenenergy.com', 'None', 'None', 0, 'None'),
(67, 'SBCL-HEMAS', 'Hemas Mobility', '75, Braybrooke Place, Colombo 02', 'Shipping', 'Sri Lanka', 'Niluka', '', '', '', '', 'None', 'None', 0, 'None'),
(68, 'SBCL-FABRI', 'Hayleys Fabric PLC.', ' Narthupana Estate, Neboda', 'Textile', 'Sri Lanka', '', '', '', '034 2297100', '', 'None', 'None', 0, 'None'),
(69, 'SBCL-NILAN', 'Nilangani', 'former brandix', 'textile', 'sri lanka', 'Nilangani', 'former brandix', '77', '11', 'nilangani@brandix', 'None', 'None', 0, 'None'),
(70, 'SBCL-PEOPL', 'Peoples Bank', 'No.75, Sir Chittampalam A. Gardiner Mawatha, Colombo 2', 'Banking', 'Sri Lanka', 'Mahen De Silva', 'HR', '77', '11', 'mahen@pb', 'None', 'None', 0, 'None'),
(71, 'SBCL-COM', 'Commercial Bank', 'No.280, Main Street, Colombo 11', 'Bank', 'Sri Lanka', 'Kanchana Weerasekara', 'Senior Assistant Manager', '', '011 7486 605', 'kanchana_weerasekara@combank.net', 'None', 'None', 0, 'None'),
(72, 'SBCL-SLT', 'SLT', ' Colombo 01, Colombo', '', 'Sri Lanka', 'Chandana Wijayanama', 'Group HR- Director', '770758363', '', 'wijayanama@slt.com.lk', 'None', 'None', 0, 'None'),
(73, 'SBCL-KERRY', 'Kerry Logistics Lanka (Pvt) Ltd', '5th Floor, 77, Park Street, Colombo 02', 'Logistics', 'Sri Lanka', 'Dilhan Mirando', 'General Manager - Commercial', '076 1564124', '114456700', 'dilhan.mirando@kerrylogistics.com', 'None', 'None', 0, 'None'),
(74, 'SBCL-STRET', 'Stretchline (Pvt) Ltd', 'Lot 89,Biyagama Export Processing Zone', 'Apparel', 'Sri Lanka', 'Leishaa', 'HR', '77', '114828100', 'leishaa@stretchline.com', 'None', 'None', 0, 'None'),
(75, 'SBCL-HIRDA', 'Hirdaramani Apparel', 'No 143, Dehiwala Road,  Maharagama', 'Apparel', 'Sri Lanka', 'Dayan Gunasekera', 'Chief Financial Officer', '777683830', '', 'dayan.gunasekera@hirdaramani.com', 'None', 'None', 0, 'None'),
(76, 'SBCL-BRAUN', 'B. Braun Lanka (Pte) Ltd', 'No.14-02, 14th Floor, West Tower, World Trade Center, Echelon Square, 00100 Colombo 1', 'Healthcare', 'Sri Lanka', 'Shanika', '', '', '', '', 'None', 'None', 0, 'None'),
(77, 'SBCL-HAYLE', 'Hayleys PLC', 'No: 400, Deans Road, Colombo 10', '', 'Sri Lanka', 'Dilendra De Silva', 'Head of Group HR', '+94 77 637 9584', '011 2627 000', 'dilendra.desilva@grouphr.hayleys.com', 'None', 'None', 0, 'None'),
(78, 'SBCL-HLAGR', 'Hayleys Agriculture Holdings Limited', 'No. 25, Foster Lane, Colombo 10', 'Agriculture', 'Sri Lanka', 'Pathum Daranagama', 'Assistant Manager – Human Resources', '076 9789 833', '011 2688960', 'pathum.daranagama@agro.hayleys.com', 'None', 'None', 0, 'None'),
(79, 'SBCL-LADIE', 'Ladies College', 'Sir Ernest De Silva Mawatha, Colombo 07', 'Education', 'Sri Lanka', 'Thinushka Gunasekara', '', '077 778 3331', '', 'thinushka@gmail.com', 'None', 'None', 0, 'None'),
(80, 'SBCL-TROPI', 'Tropicoir Lanka (Pvt) Ltd', '104, Pagoda Road, Pitakotte, Nugegoda', 'Healthcare', 'Sri Lanka', '', '', '', '011 552 2772-4', '', 'None', 'None', 0, 'None'),
(81, 'SBCL-ECOSO', 'Eco Solutions', '25 Foster Lane, Colombo 10', 'Manufacturing', 'Sri Lanka', 'Shiran De Silva', '', '', '', 'shiran.desilva@hayleysfibre.com', 'None', 'None', 0, 'None'),
(82, 'SBCL-ASCEN', 'Ascentic Pvt Ltd', 'Onyx Building, 475/4, Sri Jayawardenepura kotte', 'IT Consulting', 'Sri Lanka', 'Wasana Gallage', 'Head of HR', '774037808', '112870183', 'wasana@ascentic.se', '', '', 0, ''),
(83, 'SBCL-AUROR', 'AuroraRCM', 'Elegance Building 31 Queen\'s road, colombo 3', 'Rvenue Cycle ', 'Sri Lanka', 'Tania Warnakula ', 'Assistant HR', '753423557', '', 'taniya.w@aurorarcm.com', '', '', 0, ''),
(84, 'SBCL-SUPER', 'Superloop', 'CBD business center 41 Janadipathi Mawataha colombo 1', 'Telecommunication', 'Sri Lanka', 'Sanduni Nonis', '', '0772017633', '', 'sanduni_nonis@yahoo.com', '', '', 0, ''),
(85, 'SBCL-WESMI', 'Wesminister Foundation', 'Clive House, 70 Petty France, London SW1H 9EX, United Kingdom', '', 'UK', 'Sanje Vignaraja', 'Country Director – Sri Lanka / Senior Advisor - So', '+94777556684', '', 'Sanje.Vignaraja@wfd.org', '', '', 0, ''),
(87, 'SBCL-AITKE', 'Aitken Spence Corporate Finance (Pvt) Ltd.', 'Level 3, Aitken Spence Tower II, 315, Vauxhall Street, Colombo 02', '', 'Sri Lanka', 'Praveen Corea', '', '+94 77 733 7397', '', 'praveenc@aitkenspence.lk', '', '', 0, ''),
(88, 'SBCL-LAUGF', 'LAUGFS Holdings', 'No 101, Maya Avenue, Colombo 06', 'Manufacturing', 'Sri Lanka', 'Akarshana Arunodhi', 'Executive  Group Learning and Development -  Human', '+94 76 662 0996', '+9411 55 68 195', 'akarshana.arunodhi@laugfs.lk', '', '', 0, ''),
(89, 'SBCL-BOC  ', 'BOC  Bank of Ceylon ', 'Bank of Ceylon, No. 1, BOC Square, Bank of Ceylon Mawatha, Colombo 1', 'Banking', 'Sri Lanka', 'Naresh', '', '', '', '', '', '', 0, ''),
(90, 'SBCL-DURDA', 'Durdans Hospital', 'No 03, Alfred Place, Colombo 03', 'Health care', 'Sri Lanka', 'Vibhu Wickramasinghe', 'Consultant - Learning & Development', '0777715987', '0112140000', 'vibhuw@durdans.com', '', '', 0, ''),
(91, 'SBCL-NESTL', 'Nestle Lanka PLC', '440 T. B. Jayah Mawatha, Colombo10', 'Foodservice', 'Sri Lanka', 'Rovina Vandersay', '', '', '', 'rovina.vandersay@lk.nestle.com', '', '', 0, ''),
(92, 'SBCL-TEEJA', 'Teejay India Pvt Ltd', '10 1 38/B, 4th Floor, Hsbc Building, Visakhapatnam, Andhra Pradesh 530003', 'Manufacturing', 'India', 'Vidhooshan Rajalingam', '', '+91 97013 66588', '', 'vidhooshanr@teejay.com', '', '', 0, ''),
(93, 'SBCL-MAS H', 'MAS Holdings - KREEDA', 'Lot 49,49A,58 & 59, Biyagama EPZ, Walgama, 11650', 'Manufacturing', 'Sri Lanka', 'Dinithi Weerwardena', ' Assistant Manager – Social Sustainability', '077 8283467', '011 7514800', 'dinithiwe@masholdings.com', '', '', 0, ''),
(94, 'SBCL-IFS S', 'IFS Sri Lanka', 'Orion Towers 1, Level 18 736, Dr. Danister De Silva Mawatha, Colombo 9', 'IT Consulting', 'Sri Lanka', 'Amesh De Silva', 'Global HR Business Partner', '+94 779133567', '+94 11 236 44 0', 'amesh.de.silva@ifs.com', '', '', 0, ''),
(95, 'SBCL-GAMMA', 'Gamma Pizzakraft Lanka (Pvt) Ltd', '55/25 Vauxhall Lane, Colombo 02', 'Foodservice', 'Sri Lanka', 'Nuwan Jayaweera', 'Director - People & Culture', '0773537676', '0117 500 600', 'nuwan.jayaweera@gamma.lk', '', '', 0, ''),
(96, 'SBCL-FAO I', 'FAO in SL - Food & Agriculture Organization of UN', '202 Bauddhaloka Mawatha, Colombo 07', 'Other', 'Sri Lanka', 'Lingeshwary Sugadevu ', 'Procurement/ Logistics Assistant', '', '+94-11-2580798-', 'Lingeshwary.Sugadevu@fao.org', '', '', 0, ''),
(97, 'SBCL-PAREN', 'ParentPay Lanka (Pvt) Ltd', 'Elegance Building, No. 2 Rajagiriya Road, Rajagiriya.', 'Manufacturing', 'Sri Lanka', 'Mekala Demotte', 'Senior Executive – HR & Admin', '071 130 8779', '', 'mekela.demotte@parentpay.com', '', '', 0, ''),
(98, 'SBCL-SEYLA', 'Seylan Bank PLC', 'No 03, Galle Road, Colombo 03', 'Banking', 'Sri Lanka', 'Sanjaya Walpita', 'Senior Manager – Talent Development', '+94 77 759 6025', '0112880000', 'dhanuraw@seylan.lk', '', '', 0, ''),
(99, 'SBCL-UNITE', 'United Motors Lanka PLC', '100, Hyde Park Corner, Colombo 02', 'Other', 'Sri Lanka', 'Vindya Chandradasa', 'Senior HRD Executive', '076 9283378', '011 469 6018', 'vindyac@unitedmotors.lk', '', '', 0, ''),
(100, 'SBCL-UNISE', 'UNISEF - United Nations Children’s Fund, Sri Lanka Country Office', '3/1 Rajakeeya Mawatha, Colombo 7', 'Other', 'Sri Lanka', 'Sharmila Hirimuthugoda', 'Human Resources Officer, HR Section, Operations', '+9477-723-6926 ', '+94112677550', 'shirimuthugoda@unicef.org', '', '', 0, ''),
(101, 'SBCL-INTER', 'International Distillers Ltd', 'Melfort Estate, Kothalawala, Kaduwela', 'Manufacturing', 'Sri Lanka', 'Hansanie Illangakoon', 'Assistant Manager – Human Resources', '+94 77 780 9194', '+94 11 4653409', 'hansaniei@idl.lk', '', '', 0, ''),
(102, 'SBCL-AVENT', 'Aventura Pvt Ltd', 'No 25, Foster Lane, Colombo 10', 'Energy Development', 'Sri Lanka', 'Dilendra De Silva', 'Head - Group Talent Development', '+94 77 637 9584', ' 011 799 9777', 'dilendra.desilva@grouphr.hayleys.com', '', '', 0, ''),
(103, 'SBCL-ALUME', 'Alumex PLC', 'Pattiwila Road, Sapugaskanda, Makola', 'Manufacturing', 'Sri Lanka', 'Pumudi Munasinghe', 'Assistant Manager - Human Resources', '+94 77 0471758', '+94 112 400 332', 'pumudi.munasinghe@alumexgroup.com', '', '', 0, ''),
(104, 'SBCL-BRAND', 'Brandix Lanka Pvt Ltd', 'No. 25, Rheinland Place, Colombo 03', 'Textile', 'Sri Lanka', '', '', '', '', '', '', '', 0, ''),
(105, 'SBCL-SUNQU', 'Sunquick Lanka', 'Rathnapura Road, Munagama, A8, Horana', 'Foodservice', 'Sri Lanka', 'Anandi', 'HR', '94 74 200 9407', '94 342 263 822', 'anandi.a@sunquicklanka.com', '', '', 0, ''),
(106, 'SBCL-ANSEL', 'Ansell Lanka (Pvt) Ltd', 'Biyagama Export Processing, Zone, Biyagama, Malwana', 'Manufacturing', 'Sri Lanka', 'Surani Amerasinghe', 'Director, Human Resources', '94 76 677 0315', '', 'surani.amerasinghe@ansell.com', '', '', 0, ''),
(107, 'SBCL-AMSAF', 'AmSafe Bridport (Pvt) Ltd', 'Wathupitiwala EPZ, Nittambuwa', 'Manufacturing', 'Sri Lanka', 'Yasas Jayathilaka', 'Head of Customer Service', '077 772 2644', '033 472 9600', 'yasas.j@amsafebp.com', '', '', 0, ''),
(108, 'SBCL-PLANT', 'Plantation Hayleys', 'No. 400, Deans Road, Colombo 10', 'Manufacturing', 'Sri Lanka', 'Dilendra De Silva', 'Head of Group HR', '077 637 9584', '011 2627 000', 'dilendra.desilva@grouphr.hayleys.com', '', '', 0, ''),
(109, 'SBCL-C W M', 'C W Mackie PLC', 'No. 36, D.R.Wijewardena Mawatha,  Colombo 10', 'Manufacturing', 'Sri Lanka', 'Geeth Wickramatunge', 'Group Human Resources Manager', '077 0264057', '0112423554', 'geeth@hr.cwmackie.com', '', '', 0, ''),
(110, 'SBCL-HSBC ', 'HSBC Sri Lanka', 'HSBC 163, Union Place , Colombo 2.', 'Banking', 'Sri Lanka', 'Kalhari Herbert', 'Manager Learning and Talent Development ', '076 824 7178', '011 (4/5)451158', 'kalhariherbert@hsbc.com.lk', '', '', 0, ''),
(111, 'SBCL-HEMHO', 'Hemas Holding PLC', 'Hemas House, 75 Braybrooke Pl, Colombo 02', 'Manufacturing', 'Sri Lanka', 'Nimala Perera', 'Manager - HR', '077 0867629', ' ', 'nirmala@hemas.com', '', '', 0, ''),
(112, 'SBCL-XIGEN', 'XigeniX PTY LTD', '295/2/1 Stanley Thilakarathna Mawatha, Nugegoda', 'Software', 'Sri Lanka', 'Lahiru Perera', 'CEO', '+61 424170307 ', '', 'lahiru@xigenix.com', '', '', 0, ''),
(113, 'SBCL-AUSTR', 'Australian High Commission', '21 R.G. Senanayake Mawatha, Colombo 07', 'Other', 'Sri Lanka', 'Niroshini Wickremasinghe', 'Foreign Affairs and Trade', '077 690 9223', '94 11 246 3305', 'Niroshini.Wickremasinghe@dfat.gov.au', '', '', 0, ''),
(114, 'SBCL-BCD A', 'BCD APAC Service Center', '15th Floor, One Galle face Office Tower, Colombo 02', 'Transport', 'Sri Lanka', 'Gayan Weerasinghe', 'Director , People and Culture', '077 983 2527', '', 'gayan.weerasinghe@bcdtravelasc.com', '', '', 0, ''),
(115, 'SBCL-AVIAT', 'Aviation Hayleys Advantis', '400, Deans Road, Colombo 10', 'Transport', 'Sri Lanka', 'Gerard Victoria', 'Group Management Committee | Director/CEO – Hayley', '94 77 3033767', '11 2168001', 'gerard.victoria@aviation.hayleys.com', '', '', 0, ''),
(116, 'SBCL-DILMA', 'Dilmah Ceylon Tea Company PLC', '111 Negombo Road, Peliyagoda', 'Foodservice', 'Sri Lanka', 'Gayan Thilakarathne', 'Head of Human Resources', '94 77 779 3233', '94 11 482 2344', 'gayan.thilakarathne@dilmahtea.com', '', '', 0, ''),
(117, 'SBCL-ATG G', 'ATG Glove Solutions', 'Spur Road 7, IPZ, NEGOMBO', 'Manufacturing', 'Sri Lanka', 'Nilantha Bandara', '', '077 569 1087', '', 'nilanthad@atg-glovesolutions.com', '', '', 0, ''),
(118, 'SBCL-ASSET', 'Assetline Finance Limited', '120A Pannipitiya Road, Thalangama South', 'Finance', 'Sri Lanka', '', '', '', '', '', '', '', 0, ''),
(119, 'SBCL-SAMPL', 'SAMPLE', '', 'Manufacturing', 'Sri Lanka', '', '', '', '', '', '', '', 0, ''),
(120, 'SBCL-MAS C', 'MAS Capital Pvt Ltd', '199 Kaduwela Road, Battaramulla', 'Apparel', 'Sri Lanka', 'Lahiru Gunarathne', 'Assistant Manager – Talent Attraction', '94 779607119', '', 'lahiruguna@masholdings.com ', '', '', 0, ''),
(121, 'SBCL-SAMPA', 'Sampath Bank', '', 'Banking', 'Sri Lanka', '', '', '', '', '', '', '', 0, '');

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `clientID`, `contactName`, `contactDesignation`, `contactNumber`, `contactEmail`) VALUES
(20, 1, 'Rehan Anthonis', 'Director HR', '94 77 776 9149', 'rehan.anthonis@sysco.com'),
(21, 2, 'Roshan Kulasooriya', 'CEO', '77 739 4926', 'roshank@singersl.com'),
(22, 3, ' Anuruddhika Jayasundera', 'Senior Manager - Talent Management', '94 76 300 8377', 'anuruddhika.j@atlasaxillia.com'),
(33, 81, 'Harshani Subasingha', 'HR', '94 76 863 4164', 'harshani.subasingha@hayleysfibre.com'),
(24, 46, 'Hiruni', 'Senior HR Manager', '94 77 726 2509', 'hiruni.v@janetlanka.com'),
(25, 51, 'Sathinji Senanayake', 'Human Resources Executive - Talent Management', '94 76 3897601', 'sathinji_senanayake_external@bat.com'),
(26, 53, 'Ruwani Wimalasena', 'Manager Talent Development', '94 77 298 5265', 'ruwani.wimalasena@nationstrust.com'),
(27, 59, 'Kaveesha Perera', 'HR', '94 77 196 8212', 'kaveeshap@morison.lk'),
(28, 62, 'Gimha Rajapakse', 'Lead Creation', '94 77 768 3963', 'gr@balmondstudio.net'),
(29, 63, 'Krishantha PAthirana', 'HR', '94 76 662 5652', 'ddmk@haycarb.com'),
(30, 64, 'Jezla Mohamed Latiff', 'Assistant Manager  – Global Talent Development and Culture', '94 77 725 6472', 'jezlam@fortude.co'),
(31, 67, 'Ruwan Perera', 'HR', '94 71 529 7724', 'ruwanp@hemas.com'),
(32, 77, 'Roshintha Weerapperuma', 'Assistant Manager – Talent Development', '94 76 681 3567', 'roshintha.weerapperuma@grouphr.hayleys.com');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `courseID` int NOT NULL AUTO_INCREMENT,
  `companyName` varchar(100) NOT NULL,
  `CompanyLead` varchar(100) NOT NULL,
  `courseCode` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CourseName` varchar(50) NOT NULL,
  `fmoduleNo` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `courseType` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fduration(h)` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fduration(days)` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hModuleNo` int NOT NULL,
  `hDuration(h)` varchar(20) NOT NULL COMMENT 'auto calculation ',
  `hDuration(days)` varchar(20) NOT NULL COMMENT 'auto calculation ',
  `tModuleNo` int NOT NULL,
  `tDuration(h)` varchar(20) NOT NULL COMMENT 'auto calculation ',
  `tDuration(days)` varchar(20) NOT NULL COMMENT 'auto calculation ',
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `companyName`, `CompanyLead`, `courseCode`, `CourseName`, `fmoduleNo`, `courseType`, `fduration(h)`, `fduration(days)`, `hModuleNo`, `hDuration(h)`, `hDuration(days)`, `tModuleNo`, `tDuration(h)`, `tDuration(days)`) VALUES
(3, '', '', 'SBCC-FY24-PLD-501', 'PLDP', 'PLDP', '0', '', '', 0, '', '', 0, '', ''),
(4, '', '', 'SBCC-FY24-PLD-502', 'PLDP', 'PLDP', '0', '', '', 0, '', '', 0, '', ''),
(34, '', '', 'SBCC-FY24-PLD-500', 'fff', 'PLDP', '0', '', '', 0, '', '', 0, '', ''),
(36, '', '', 'SBCC-FY23-PLD-501', 'Apex', 'PLDP', '0', '', '', 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `create_batches`
--

DROP TABLE IF EXISTS `create_batches`;
CREATE TABLE IF NOT EXISTS `create_batches` (
  `RegistrationID` int NOT NULL AUTO_INCREMENT,
  `client` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clientName` varchar(30) NOT NULL,
  `lead` varchar(20) NOT NULL,
  `batchName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `companyCode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `budgetParticipant` int NOT NULL,
  `year` year NOT NULL,
  `course` varchar(50) NOT NULL,
  `moduleFaculty` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `StartDate` varchar(10) NOT NULL,
  `EndDate` varchar(10) NOT NULL,
  PRIMARY KEY (`RegistrationID`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `create_batches`
--

INSERT INTO `create_batches` (`RegistrationID`, `client`, `clientName`, `lead`, `batchName`, `companyCode`, `budgetParticipant`, `year`, `course`, `moduleFaculty`, `StartDate`, `EndDate`) VALUES
(162, 'SBCL-SYSCO', 'SBCL-SYSCO', '', 'SBBI-06-23-PLDP-25-B1', '', 25, 2023, 'PLDP', '1. WS1 -Leadership Transition  & Mastery  - Angelo De Silva<br>    Start Date: 2024-06-28 - End Date: 2024-06-28<br><br>2. WS4 -Coaching &  Developing People - Chandana Pathirage<br>    Start Date:  - End Date: <br><br>3. WS2 -Managing People &  Teams - Additional Guest Resource<br>    Start Date:  - End Date: <br><br>', '2024-06-08', ''),
(163, 'SBCL-SINGE', 'SBCL-SINGE', '', '', '', 25, 2023, 'PLDP', '1. WS1 -Leadership Transition  & Mastery  - Angelo De Silva<br>    Start Date:  - End Date: <br><br>2. WS8 –Decision Making &  Problem Solving - Tilak Rahulan<br>    Start Date: 2024-07-02 - End Date: 2024-07-02<br><br>3. WS9 -Leadership Presence  & Inspiration - Additional Guest Resource<br>    Start Date:  - End Date: <br><br>', '', ''),
(161, 'SBCL-JAT', 'SBCL-JAT', '', 'SBBI-06-23-PLDP-25-B1', '', 25, 2023, 'PLDP', '', '2024-06-27', ''),
(160, 'SBCL-ATLAS', 'SBCL-ATLAS', '', 'SBBI-06-40-fff-44-B17', '', 44, 2040, 'fff', '1. WS1 -Leadership Transition  & Mastery  - Angelo De Silva<br>    Start Date: 2024-07-04 - End Date: 2024-07-04<br><br>2. WS4 -Coaching &  Developing People - Chandana Pathirage<br>    Start Date: 2024-06-13 - End Date: 2024-06-13<br><br>3. WS2 -Managing People &  Teams - Additional Guest Resource<br>    Start Date: 2024-06-13 - End Date: 2024-06-13<br><br>4. WS3 -Emotional  Intelligence for Leaders - Angelo De Silva<br>    Start Date: 2024-06-26 - End Date: 2024-06-26<br><br>5. WS5 -Entrepreneurial  Thinking - Angelo De silva<br>    Start Date: 2024-07-04 - End Date: 2024-07-04<br><br>6. WS6 -Finance for Business - Shazil Ismail<br>    Start Date: 2024-05-28 - End Date: 2024-05-28<br><br>', '2024-06-29', ''),
(159, 'SBCL-SYSCO', 'SBCL-SYSCO', '', 'SBBI-06-23-PLDP-60-B1', '', 60, 2023, 'PLDP', '1. WS1 -Leadership Transition  & Mastery  - Angelo De Silva<br>    Start Date: 2024-07-03 - End Date: 2024-07-03<br><br>2. WS4 -Coaching &  Developing People - Chandana Pathirage<br>    Start Date: 2024-06-21 - End Date: 2024-06-21<br><br>3. WS2 -Managing People &  Teams - Additional Guest Resource<br>    Start Date: 2024-06-22 - End Date: 2024-06-22<br><br>4. WS3 -Emotional  Intelligence for Leaders - Angelo De Silva<br>    Start Date: 2024-07-02 - End Date: 2024-07-02<br><br>5. WS5 -Entrepreneurial  Thinking - Angelo De silva<br>    Start Date: 2024-06-27 - End Date: 2024-06-27<br><br>6. WS6 -Finance for Business - Shazil Ismail<br>    Start Date: 2024-06-27 - End Date: 2024-06-27<br><br>7. WS7 -Productivity &  Project Management - Mendaka Hettithantri<br>    Start Date: 2024-06-28 - End Date: 2024-06-28<br><br>8. WS8 –Decision Making &  Problem Solving - Tilak Rahulan<br>    Start Date: 2024-06-20 - End Date: 2024-06-20<br><br>9. WS9 -Leadership Presence  & Inspiration - Additional Guest Resource<br>    Start Date: 2024-06-20 - End Date: 2024-06-20<br><br>10. WS11 -Management-Level  Communication - Mendaka Hettithantri<br>    Start Date: 2024-06-06 - End Date: 2024-06-06<br><br>11. WS12 –Design Thinking - Angelo De Silva<br>    Start Date: 2024-06-28 - End Date: 2024-06-28<br><br>', '2024-06-22', '2024-07-06'),
(164, 'SBCL-FENTO', 'SBCL-FENTO', '', 'SBBI-07-26-PLDP-26-B8', '', 26, 2026, 'PLDP', '1. WS1 -Leadership Transition  & Mastery  - Angelo De Silva<br>    Start Date: 2024-07-17 - End Date: 2024-07-17<br><br>2. WS4 -Coaching &  Developing People - Chandana Pathirage<br>    Start Date:  - End Date: <br><br>3. WS2 -Managing People &  Teams - Additional Guest Resource<br>    Start Date:  - End Date: <br><br>4. WS3 -Emotional  Intelligence for Leaders - Angelo De Silva<br>    Start Date:  - End Date: <br><br>5. WS5 -Entrepreneurial  Thinking - Angelo De silva<br>    Start Date:  - End Date: <br><br>', '2024-07-16', '2024-07-25');

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
-- Table structure for table `deployment`
--

DROP TABLE IF EXISTS `deployment`;
CREATE TABLE IF NOT EXISTS `deployment` (
  `deployID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `startDate` date NOT NULL COMMENT 'calendar',
  `endDate` date NOT NULL COMMENT 'calendar',
  `duration` varchar(50) NOT NULL COMMENT 'auto-cal',
  `owner` varchar(50) NOT NULL COMMENT 'name',
  `assignedMember` varchar(50) NOT NULL COMMENT 'email',
  `status` varchar(25) NOT NULL COMMENT 'initiated/ongoing/completed',
  PRIMARY KEY (`deployID`)
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyid`, `callingName`, `nic`, `address`, `mobileNo1`, `mobileNo2`, `emergencyContact`, `designation`, `currentEmployee`, `facultyLevel`, `type`, `type2`, `careersStartY`, `yoe`, `expertiseArea1`, `expertiseArea2`, `expertiseArea3`, `expertiseArea4`, `formalQualification`, `weekends`, `daysPerMonth`, `totalAvailability`, `weekends2`, `daysPerMonth2`, `TotalDaysPerYear`, `capacity`) VALUES
(1, 'Angelo De Silva ', '841490673V', '141/1A Elvin Place, High Level Road, Nugegoda ', 773337206, 770757878, 'Menaka - 0777009181', '', '', 'Senior Lecturer', '', '', '0000-00-00', '0000', 'Entrepreneurial Thinking', 'Leadership Development', 'Leadership Development', 'Negotiation', '', '', 0, 0, '', '', '', ''),
(2, 'Thilak Rahulan', '', '', 0, 0, '', '', '', 'Senior Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(3, 'Mendaka Hettithantri', '', '', 0, 0, '', '', '', 'Senior Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(4, 'Shazil Ismail', '', '', 0, 0, '', '', '', 'Senior Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(5, 'Thilani Ariyaratne', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(6, 'Chandana Pathirage', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(7, 'Ravi de Coonghe', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(8, 'Sarah Nasry', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(9, 'Ranjanie Gunasekera ', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(10, 'Rukshan De Silva', '', '', 0, 0, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', ''),
(11, 'Thusitha Perera', '795628142V', 'thalawathugoda', 2147483647, 778546821, '', '', '', 'Visiting Lecturer', '', '', '0000-00-00', '', 'Accounting', 'Accounting', 'Accounting', 'Accounting', '', '', 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_capacity`
--

DROP TABLE IF EXISTS `faculty_capacity`;
CREATE TABLE IF NOT EXISTS `faculty_capacity` (
  `capacityId` int NOT NULL AUTO_INCREMENT,
  `callingName` varchar(30) NOT NULL,
  `weekends` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT 'training/consulting',
  `year` varchar(20) NOT NULL,
  `monday` varchar(20) NOT NULL,
  `tuesday` varchar(20) NOT NULL,
  `wednesday` varchar(20) NOT NULL,
  `thursday` varchar(20) NOT NULL,
  `friday` varchar(20) NOT NULL,
  `saturday` varchar(100) NOT NULL,
  `sunday` varchar(20) NOT NULL,
  `daysPerMonth` int NOT NULL,
  `TotalDaysPerYear` varchar(10) NOT NULL,
  `capacity` varchar(10) NOT NULL,
  PRIMARY KEY (`capacityId`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty_capacity`
--

INSERT INTO `faculty_capacity` (`capacityId`, `callingName`, `weekends`, `type`, `year`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `daysPerMonth`, `TotalDaysPerYear`, `capacity`) VALUES
(1, 'Angelo De Silva ', 'yes', 'Consulting', '', '', '', '', '', '0', '', '', 7, '84', '84'),
(2, 'Angelo De Silva ', 'yes', 'Training', '', '', '', '', '', '0', '', '', 10, '120', '120'),
(3, 'Kumudini', 'yes', 'Training', '', '', '', '', '', '0', '', '', 4, '48', '48'),
(4, 'Tilak Rahulan', 'yes', 'Training', '', '', '', '', '', '0', '', '', 8, '96', '96'),
(5, 'Rukshan De Silva', 'yes', 'Training', '', '', '', '', '', '0', '', '', 4, '48', '48'),
(6, 'Mendaka', 'yes', 'Training', '', '', '', '', '', '0', '', '', 3, '36', '36'),
(7, 'Thilani Ariyaratne', 'yes', 'Training', '', '', '', '', '', '0', '', '', 6, '72', '72'),
(8, 'Chandana Pathirage', 'yes', 'Training', '', '', '', '', '', '0', '', '', 12, '144', '144'),
(9, 'Ravi de Coonghe', 'yes', 'Training', '', '', '', '', '', '0', '', '', 10, '120', '120'),
(10, 'Sarah Nasry', 'yes', 'Training', '', '', '', '', '', '0', '', '', 5, '60', '60'),
(11, 'Ranjo Gunasekera ', 'yes', 'Training', '', '', '', '', '', '0', '', '', 3, '36', '36'),
(21, 'Angelo', '', 'Consulting', '2023', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 15, '180', '0');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `clientID` int NOT NULL AUTO_INCREMENT,
  `company` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `salesStage` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `lead` varchar(4000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) NOT NULL,
  `strategicPriority` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `confidenseLevel` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `confindeceLevelRating` int NOT NULL,
  `marketingStatus` int NOT NULL COMMENT 'percentage',
  `categoryType` varchar(25) NOT NULL,
  `leadType` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `requirement` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estimateSalesValue` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lostLeadDate` text NOT NULL,
  `preliminaryBrochures` varchar(25) NOT NULL,
  `emailClient` varchar(25) NOT NULL,
  `sheduleCM` varchar(25) NOT NULL,
  `chemMeeting` varchar(25) NOT NULL,
  `proposal` varchar(25) NOT NULL,
  `estimate` varchar(25) NOT NULL,
  `confirmation` varchar(25) NOT NULL,
  `cof` varchar(25) NOT NULL,
  `po` varchar(25) NOT NULL,
  `invoice` varchar(25) NOT NULL,
  `invoiceDT` date NOT NULL,
  `payment` varchar(10) NOT NULL,
  `projects` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SurveyData` varchar(25) NOT NULL,
  `courseFacillitation` varchar(25) NOT NULL,
  `projectsAssessments` varchar(25) NOT NULL,
  `program` varchar(25) NOT NULL,
  `dataCertification` varchar(25) NOT NULL,
  `graduation` varchar(25) NOT NULL,
  `programCompleted` varchar(25) NOT NULL,
  `postSalesFollowUp` varchar(25) NOT NULL,
  `protofolioEmail` varchar(25) NOT NULL,
  `newBusinessMeeting` varchar(25) NOT NULL,
  `completionStatus` int NOT NULL,
  `followUp` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PreliminaryBrochuresDate` varchar(26) DEFAULT NULL,
  `EmailClientDate` varchar(26) DEFAULT NULL,
  `SheduleChemistryMeetingDate` varchar(26) DEFAULT NULL,
  `ChemistryMeetingDate` varchar(26) DEFAULT NULL,
  `ProposalDate` varchar(26) DEFAULT NULL,
  `EstimateDate` varchar(26) DEFAULT NULL,
  `ConfirmationDate` varchar(26) DEFAULT NULL,
  `COFDate` varchar(26) DEFAULT NULL,
  `PODate` varchar(26) DEFAULT NULL,
  `PaymentDate` varchar(26) DEFAULT NULL,
  `ProgramDate` varchar(26) DEFAULT NULL,
  `PostSalesFollowUpDate` varchar(26) DEFAULT NULL,
  `ProtofolioE-MailDate` varchar(26) DEFAULT NULL,
  `NewBusinessMeetingDate` varchar(26) DEFAULT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=MyISAM AUTO_INCREMENT=442 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci DELAY_KEY_WRITE=1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`clientID`, `company`, `salesStage`, `date`, `lead`, `name`, `strategicPriority`, `status`, `confidenseLevel`, `confindeceLevelRating`, `marketingStatus`, `categoryType`, `leadType`, `requirement`, `estimateSalesValue`, `lostLeadDate`, `preliminaryBrochures`, `emailClient`, `sheduleCM`, `chemMeeting`, `proposal`, `estimate`, `confirmation`, `cof`, `po`, `invoice`, `invoiceDT`, `payment`, `projects`, `SurveyData`, `courseFacillitation`, `projectsAssessments`, `program`, `dataCertification`, `graduation`, `programCompleted`, `postSalesFollowUp`, `protofolioEmail`, `newBusinessMeeting`, `completionStatus`, `followUp`, `PreliminaryBrochuresDate`, `EmailClientDate`, `SheduleChemistryMeetingDate`, `ChemistryMeetingDate`, `ProposalDate`, `EstimateDate`, `ConfirmationDate`, `COFDate`, `PODate`, `PaymentDate`, `ProgramDate`, `PostSalesFollowUpDate`, `ProtofolioE-MailDate`, `NewBusinessMeetingDate`) VALUES
(420, 'MAS Capital Pvt Ltd', 'Pre Sales', '18/07/2024', 'Out door Team Building Programme', 'mandeera', 4, 'Active Lead', 'New', 4, 0, 'People analytics', 'Team Experiences', 'Out door Team Building Programme for senior Managers at MAS', '', '', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '22.07- will share the details by 26th July                                     *18.07- required details via email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(419, 'Sampath Bank', 'Pre Sales', '17/07/2024', 'CSP driven by board ', 'Menaka', 3, 'Active Lead', 'New', 3, 0, 'Consulting', 'PLDP', 'End to end culture integration as Sampath Bank enters a new growth era ', '20,000,000.00', '', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Angelo- prepare presentation slide deck and email to  Mr.Keith ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'Digital Leadership', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Capacity Building', 'Capacity building in digital leadership for middle management', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiatedv', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(412, 'MAS Capital Pvt Ltd', 'Pre Sales', '15/07/2024', 'OAR Assessment CEntre', '', 2, 'Active Lead', 'New', 2, 0, 'People analytics', 'OAR', 'Assessment Centre to select 06 management Trainees', '900,000.00', '', 'Not Initiated', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Applicable', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '15.07 - Menaka - Email sent to schedule the chem meeting', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(404, 'Ascentic Pvt Ltd', 'Pre Sales', '30/05/2024', 'C Suite', '', 4, 'Inactive Lead', 'New', 4, 0, 'Training', 'PLDP', 'Identifying leadership style, delegation, and empowerment in senior management', '8,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - flag raised -  been unreachable over the phone and email; get in touch with her through linkedin today', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(407, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'Working with Gen Z', '', 2, 'Inactive Lead', 'New', 2, 0, 'Training', 'Capacity Building', 'Capacity building - working with Gen Z', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 'Ascentic Pvt Ltd', 'Pre Sales', '21/05/2024', 'CSP', '', 5, 'Inactive Lead', 'New', 5, 0, 'Consulting', 'CSP', 'Culture consulting to address holistic approach to senior leadership and alignnig culture', '6,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - Priority email sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(400, 'Ansell Lanka (Pvt) Ltd', 'Pre Sales', '27/06/2024', 'Mentoring Program', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Capacity Building', 'Mentoring master class for C Suite, Jul/Aug Compass', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Send proposal, timeline and pricing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(401, 'Ansell Lanka (Pvt) Ltd', 'Pre Sales', '27/07/2024', 'Coaching Programme', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Capacity Building', 'Coaching session for direct supervisors, Jul/Aug, Compass', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'send proposal, dates, and estimate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 'Ansell Lanka (Pvt) Ltd', 'Pre Sales', '26/06/2024', 'managed training Services', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'HR', 'Manage training requirements overall for the company and assist internal HR team to optimise budgets and allocations', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Send proposal , pricing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 'Ceylon Tobacco Company PLC', 'Lost Lead', '09/07/2024', 'Impact and Gravitas training programme', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Custom Program , Senior Management, 20 pax, Leaving an impact and creating gravitas', '500,000.00', '09/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Follow Up Call on the 9th to Sathinji, was informed they went with another vendor. Closed lead. *10.07 - Mandeera - proposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(399, 'Ansell Lanka (Pvt) Ltd', 'Pre Sales', '12/07/2024', 'Consulting - Competency Framework development for Ansell Lanka', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'HR', 'Develop a customized competency framework for Ansell Lanka in line with their production operating system based on the IWS platform. Ansell Lanka will be the first then they plan on rolling out other plants', '2,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '15.07 - Lavindi - Meeting scheduled for 29th July / *12.07 - schedule an in person meeting with Ushan/ Schedule a call within the day with Ushan on requirements / *Discussion with Ushan on 12th July at 11am with Angelo to understand the full requirement', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 'United Motors Lanka PLC', 'Lost Lead', '08/12/2023', 'OBT Training', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Team Experiences', 'OBT Training for sales & Workshop staff', '450,000.00', '03/01/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Email on 18.12.2023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 'Sunquick Lanka', 'Pre Sales', '08/07/2024', 'EDP - Customized training program for executives ', '', 0, 'Active Lead', 'New', 0, 0, 'Training', 'EDP', 'Custom training programme to include Executives and EXCO. 10 Execs 5  EXCO. ', '2,500,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Discuss exact requirement and expectations for this group. on 16th July. *10.07 - Lavindi - Chem meeting scheduled for 16th July', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 'Ansell Lanka (Pvt) Ltd', 'Pre Sales', '27/06/2024', 'CSP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'Discussion had on 26.06.2024\r\n\r\nValue synergy sessions, Ansell International OLT Aug 2024, pax - tbc', '0', '', 'Not Initiated', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - confirm session dates in August, confirm two deep dives consultations (w Ansell team) to prepare; confirm dates by 18th July.\r\n*10.07 - Mandeera - proposal to be sent', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(379, 'Atlas Axillia Co. (Pvt) Ltd.', 'Pre Sales', '21/05/2024', 'PLDP ', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'PLDP Practice heads 06 \r\n', '5,375,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07- Lavindi - Priority email sent', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(377, 'Hayleys PLC', 'Pre Sales', '12/06/2024', 'Senior Talent Capability Development', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Senior management and strategic level employees looking to enhance and update capabilities', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - reminder sent - entire programs number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 'Hayleys PLC', 'Pre Sales', '12/06/2024', 'Strategic Management Development Program', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Developing strategic skills in sales management and driving results', '600,000.00', '', 'Not Initiated', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - reminder sent - entire programs number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 'Hayleys PLC', 'Pre Sales', '12/06/2024', 'Supervisor Development Programme', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'To develop soft skills, enhancing outcomes in the job roles', '1,800,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - reminder sent - entire programs number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 'Hayleys PLC', 'Pre Sales', '12/06/2024', 'Advanced Sales Capability Development wi', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Developing fundamental skills in sales', '3,600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - reminder sent - entire program number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 'Hayleys PLC', 'Pre Sales', '12/06/2024', 'Sales Capability Development', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Developing fundamental skills in sales & Marketing align with Hayleys PLC distinct environment', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - reminder sent - entire program number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Customer & Relationship Orientation', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Customer & Relationship Orientation (Feb 2025)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - send proposal by next week 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send required ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(368, 'BOC  Bank of Ceylon ', 'Pre Sales', '25/06/2024', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', 'CSP', '15,000,000.00', '', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Angelo - will get in touch with Naresh and set up a discussion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(369, 'Peoples Bank', 'Pre Sales', '25/06/2024', 'PLDP BATCH 1', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Management Development Program', '5,375,000.00', '', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - Mahen requested a time to meet after 5pm during month of July', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Personal Productivity Enhancement', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Personal Productivity Enhancement (Aug 2024)', '600000', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent by 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send requireme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Negotiation Skills', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Negotiation Skills (Aug 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent by 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send required ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(364, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Interpersonal Skills / People Management', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Interpersonal Skills / People Management (Dec 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent by 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Analytical & Critical Thinking', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Analytical & Critical Thinking (Aug 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent by 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Managing Gen Z', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Managing Gen Z (Aug 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposals to be sent by 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requirement', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Managing Gen X ', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Managing Gen X (Aug 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - Proposal to be sent 17.07 (Aug 2024)\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Driving Innovation, Creativity and Chang', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Driving Innovation, Creativity and Change (Dec 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - Proposals to be sent 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 'Singer Sri Lanka', 'Pre Sales', '08/05/2024', 'supervisor training ', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'supervisor training - 4 day work shop ', '1,700,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - Prabath will get back in end of August', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Problem Solving & Decision Making', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Problem Solving & Decision Making (September 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Meeting Facilitation', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Meeting Facilitation (Jan 2025)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'Capacity Building - Hotel Industry', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Capacity buiding training for Hotel Industry', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - proposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 'Wesminister Foundation', 'Deployment', '13/05/2024', 'Strategic Formulation Alignment', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'Strategy', 'Strategic Formulation Alignment', '1,160,922.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Not Paid', 'Completed', 'Not Applicable', 'In Progress', 'Not Applicable', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - completed contract to be sent | Mandeera - D2 to be confirmed / 09.07 - D1 complet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'PLDP B2', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '6,450,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - proposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'Capacity Building - Change Management', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Capacity Building', 'Change Management for Middle Management', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposal to be sent by 17.07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 'Aitken Spence Corporate Financ', 'Pre Sales', '07/06/2024', 'Capacity Building ', '', 3, 'Inactive Lead', 'New', 3, 0, 'Training', 'Capacity Building', 'Cap Building on Transformative Leadership', '', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 'Nations Trust Bank', 'Pre Sales', '07/06/2024', 'PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '6,450,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - proposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 'Nations Trust Bank', 'Pre Sales', '07/06/2024', 'PLDP Advance C Suite', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Senior Managerial Development Program', '8,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - poposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 'Nations Trust Bank', 'Pre Sales', '07/06/2024', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', 'CSP', '15,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - proposal to be sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 'Atlas Axillia Co. (Pvt) Ltd.', 'Pre Sales', '20/06/2024', 'CSP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'Cultural alignment', '6,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - discussion 17.07 / 25.06 - Proposal sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'People Management', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'People Management (Dec 2024)\r\n', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 'Superloop', 'Pre Sales', '10/06/2024', 'CSP', '', 0, 'Active Lead', 'New', 0, 0, 'Consulting', 'CSP', 'CSP', '6,000,000.00', '', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '09.07 - Lavindi - will get back by mid August 2024 email sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 'Ceylon Tobacco Company PLC', 'Lost Lead', '05/06/2024', 'women in Leadership', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'women in Leadership', '600,000.00', '09/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Informed that going ahead with another supplier', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 'Laugfs Holdings', 'Pre Sales', '07/05/2024', 'Emotional Intelligence', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Emotional Intelligence (Oct 2024)', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - proposals to be sent 17.07\r\n*11.07 - details received and proposal to be sent / *10.07 - Lavindi - Akarshana will send the requirement', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'AmSafe Bridport (Pvt) Ltd', 'Pre Sales', '27/05/2024', 'Workload Analysis ', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'People Analytics', 'HR', 'workload analysis for sales team ', '1,500,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - Prasanna will update by 11.07 ', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(87, 'Australian High Commission', 'Lost Lead', '29/05/2024', 'speaking session ', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', '', '550,000.00', '18/06/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'lost lead informed through email', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(82, 'Ascentic Pvt Ltd', 'Pre Sales', '21/05/2024', 'PLDP C Suite', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Senior Managerial Development Program', '6,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - Priority email sent', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(83, 'AuroraRCM', 'Lost Lead', '16/05/2024', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', 'Culture Alignment', '6,000,000.00', '25/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'email sent by mandeera on 25/07/2024\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(84, 'Singer Sri Lanka', 'Post Sales', '24/04/2023', 'Strategy Session', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Consulting', 'Strategy', 'Strategic Management Development Programme', '650,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Applicable', 'Completed', 'Not Applicable', 'Completed', 'Not Applicable', 'Not Applicable', 'Completed', 'Completed', 'Completed', 'Completed', 10, 'Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(85, 'Singer Sri Lanka', 'Post Sales', '24/04/2023', 'Strategy Session', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Consulting', 'Strategy', 'Strategic Management Development Programme', '550,800.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Applicable', 'Completed', 'Not Applicable', 'Completed', 'Not Applicable', 'Not Applicable', 'Completed', 'Completed', 'Completed', 'Completed', 10, 'Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(389, 'Brandix Lanka Pvt Ltd', 'Deployment', '01/07/2024', 'EDP', '', 0, 'Active Lead', 'Pending Approval', 0, 0, 'Training', 'EDP', 'Executive Development programme', '600,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Lavindi - COF to be received and invoice to be sent/ *10.07 - Lavindi - email follow up email sent/ COF to be received & dates to be confirmed 28th Aug ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Stretchline (Pvt) Ltd', 'Lost Lead', '05/06/2024', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', 'training', '6,600,000.00', '10/06/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Preliminary email sent', '05/06/2024 06:50', '05/06/2024 06:50', '', '', '', '', '', '', '', '', '', '', '', ''),
(78, 'Hayleys Fabric PLC.', 'Pre Sales', '29/04/2024', 'PLDP BATCH 1', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Management Development Program', '5,375,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - pitching, in the talks', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(76, 'SLT', 'Pre Sales', '24/04/2024', 'CSP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'SLT - mobitel culture', '15,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Mandeera - CSP Board Meeting 23rd and 24th July\r\n*10.07 - Lavindi - Board meeting on 25th July at 2pm', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 'PGP Glass Ceylon PLC', 'Lost Lead', '03/05/2024', 'PGP Glass c-suit', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'Other', 'Senior Managerial Development Program', '8,000,000.00', '20/06/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Needed combine the program with PLDP', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(75, 'CBC Tech Solutions LTD', 'Lost Lead', '24/04/2024', 'CSP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'Culture', '15,000,000.00', '10/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Angelo - will not go ahead with CSP', '4/29/2024 6:57', '4/29/2024 6:57', '4/29/2024 6:57', '', '', '', '', '', '', '', '', '', '', ''),
(74, 'CBC Tech Solutions LTD', 'Pre Sales', '24/04/2024', 'PLDP C Suite', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Senior Managerial Development Program', '8,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Angelo - followed up via whatsapp', '4/29/2024 6:56', '4/29/2024 6:56', '4/29/2024 6:56', '', '', '', '', '', '', '', '', '', '', ''),
(73, 'Commercial Bank', 'Lost Lead', '29/04/2024', 'Assessment Centre', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'People Analytics', 'OAR', 'assessment center for a group of approximately 20 to 30 candidates for the Management Trainee-Treasury program.', '1,350,000.00', '02/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 0, 'marketing follow up email sent on 03.07.2024', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(69, 'Millennium IT ESP', 'Pre Sales', '22/04/2024', 'CSP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'Managerial Development Program', '6,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - in person meeting to discuss on 17th July', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03', '4/24/2024 9:03'),
(72, 'Teejay India Pvt Ltd', 'Pre Sales', '04/03/2024', 'PLDP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'PLDP', '2,250,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - Vibhu will get back by 19th July', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(70, 'Nilangani', 'Lost Lead', '24/02/2024', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', 'Culture transformation/ 35 policies/ within 4 months', '6,000,000.00', '30/05/2024', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Contacted Angelo', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(71, 'Millennium IT ESP', 'Pre Sales', '27/02/2024', 'PLDP Advance C suite', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Senior Managerial Development Program', '8,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - in person meeting to discuss on 17th July', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, 'Gaia Greenenergy Holdings', 'Lost Lead', '08/04/2024', 'PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Management Development programme', '5,375,000.00', '30/03/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Email - 09.04.2024', '04/09/2024 05:28', '04/09/2024 05:28', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `leads` (`clientID`, `company`, `salesStage`, `date`, `lead`, `name`, `strategicPriority`, `status`, `confidenseLevel`, `confindeceLevelRating`, `marketingStatus`, `categoryType`, `leadType`, `requirement`, `estimateSalesValue`, `lostLeadDate`, `preliminaryBrochures`, `emailClient`, `sheduleCM`, `chemMeeting`, `proposal`, `estimate`, `confirmation`, `cof`, `po`, `invoice`, `invoiceDT`, `payment`, `projects`, `SurveyData`, `courseFacillitation`, `projectsAssessments`, `program`, `dataCertification`, `graduation`, `programCompleted`, `postSalesFollowUp`, `protofolioEmail`, `newBusinessMeeting`, `completionStatus`, `followUp`, `PreliminaryBrochuresDate`, `EmailClientDate`, `SheduleChemistryMeetingDate`, `ChemistryMeetingDate`, `ProposalDate`, `EstimateDate`, `ConfirmationDate`, `COFDate`, `PODate`, `PaymentDate`, `ProgramDate`, `PostSalesFollowUpDate`, `ProtofolioE-MailDate`, `NewBusinessMeetingDate`) VALUES
(68, 'CBC Tech Solutions LTD', 'Lost Lead', '18/04/2024', 'Assessment Centre', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'People Analytics', 'OAR', 'Details of Assessment centre', '585,000.00', '02/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Marketing email sent on 03.07.2024', '4/18/2024 6:54', '4/18/2024 6:54', '4/18/2024 6:54', '', '', '', '', '', '', '', '', '', '', ''),
(66, 'Balmond Studio', 'Deployment', '05/04/2024', 'CSP', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'CSP', 'CSP consulting', '0', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Applicable', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'In Progress', 'In Progress', 'Not Applicable', 'Completed', 'Not Applicable', 'Not Applicable', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'D2 - 06th Aug', '04/05/2024 09:26', '04/05/2024 09:26', '', '', '', '', '', '', '', '', '', '', '', ''),
(65, 'CBC Tech Solutions LTD', 'Pre Sales', '25/03/2024', 'PLDP BATCH 1', '', 0, 'Active Lead', 'New', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '4,300,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Angelo - followed up via whatsaap', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(64, 'Save the Children', 'Lost Lead', '04/03/2024', 'Team Building', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Team Experiences', 'Team Building engagement for senior management on 29th April 2024', '600,000.00', '18/04/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 0, 'email from Rosalind - 18 Apr 2024', '3/27/2024 4:41', '3/27/2024 4:41', '', '', '3/27/2024 4:41', '', '', '', '', '', '', '', '', ''),
(63, 'Teejay Lanka PLC', 'Deployment', '11/04/2024', 'CAP Building', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'Capacity Building', 'Managers Capacity Building', '1,500,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Applicable', 'In Progress', 'Not Applicable', 'Completed', 'Not Initiated', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Initiated', 0, '10.07 - Lavindi - D4 - rescheduled for Aug 7th', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08'),
(58, 'Singer Sri Lanka', 'Lost Lead', '22/01/2024', 'Strategy Session', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', 'Training for Call Centre Agents', '650,000.00', '17/06/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 10, 'Due to over budget ', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(59, 'PGP Glass Ceylon PLC', 'Deployment', '20/02/2024', 'PLDP', '', 0, 'Active Lead', 'Almost Certain', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,505,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 10, '10.07 - Launch & Date plan to be rescheduled / Launch on 16 July. waiting for the date approval (Ema', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(60, 'Millennium IT ESP', 'Pre Sales', '27/02/2024', 'PLDP BATCH 1', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Management Development Program', '5,375,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 10, '10.07 - Lavindi - in person meeting to discuss on 17th July', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(61, 'Inqube Global Pvt Ltd', 'Pre Sales', '19/01/2024', 'PLDP', '', 0, 'Active Lead', 'New', 0, 0, 'Training', 'PLDP', 'Management Development Program', '2,250,000.00', '', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 10, '10.07 - Lavindi - Priority email sent / 09.05.2024 - called landline no answer', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(62, 'Sysco Lab', 'Lost Lead', '24/03/2024', 'PLDP C Suite', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'PLDP', 'Off Site 2 days', '15,000,000.00', '05/03/2024', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08', '3/22/2024 9:08'),
(57, 'Singer Sri Lanka', 'Post Sales', '19/02/2024', 'Strategy Session', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Consulting', 'Strategy', 'Strategic Management Development Programme', '450,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Applicable', 'Completed', 'Not Applicable', 'Completed', 'Not Applicable', 'Not Applicable', 'Completed', 'Completed', 'Completed', 'Completed', 10, '19.02 - Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(56, 'Pelwatte Dairy Industries Pvt ', 'Lost Lead', '12/02/2024', 'CSP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', 'Culture Audit', '6,000,000.00', '20/05/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 10, 'April 08 - Gihan - will give feedback by 10th April.', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 'International Distillers Ltd', 'Lost Lead', '02/01/2024', 'PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', '', '2,250,000.00', '12/03/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, 'Nations Trust Bank', 'Deployment', '06/04/2024', 'Assessments', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'People Analytics', 'Other', '360 Degree Feedback Survey', '1,755,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 10, '10.07 - Mandeera - 360 survey to be tested', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 'Spa Ceylon', 'Deployment', '22/04/2024', 'CSP', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'CSP', 'Cultural change', '6,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Part Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Lavindi - D2 Aug 06th', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 'Fortude (Pvt) Ltd', 'Program Completed', '06/08/2023', 'Culture alligment workshop', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'consulting', 'CSP', 'Culture alligment  7 half day sessions into 4 teams (ANZ+ASIA/RCOO/)', '400,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Programme completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 'Hayleys Fentons', 'Deployment', '18/03/2024', 'PLDP BATCH 1', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Management Development Program', '2,255,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - D4 on 27th July', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 'Aventura Pvt Ltd', 'Lost Lead', '07/11/2023', 'Hayleys Aventura PLDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', '', '2,250,000.00', '15/12/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 'Hemas Holding PLC', 'Post Sales', '06/06/2023', 'HEMAS Summer Internship', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Training', 'Other', 'Angelo Speaking session ', '150,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Completed', 'Completed', 'Completed', 0, 'Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 'C W Mackie PLC', 'Lost Lead', '24/05/2023', 'Mackie Transformation Consultation', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'Other', '', '0', '15/02/2024', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 'Hayleys PLC', 'Program Completed', '06/12/2023', 'Culture alligment workshop/LEGA', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'Capacity Building', 'Legal & HR teams to align culture ', '256,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 'Sysco Lab', 'Lost Lead', '19/05/2023', 'Culture Assessment', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'People analytics', 'Capacity Building', '', '0', '28/12/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 'Sysco Lab', 'Pre Sales', '29/04/2024', 'MEN PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', 'Leadership program for Men', '9,000,000.00', '', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - to be discussed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(44, 'Hayleys PLC', 'Program Completed', '06/12/2023', 'Culture alligment workshop/HR', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'Capacity Building', 'Legal & HR teams to align culture ', '256,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Program Completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 'Next Manufacturing Pvt Ltd', 'Lost Lead', '22/11/2023', 'One day Program', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'ONE DAY TRAINING', '', '0', '31/10/2023', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(42, 'Plantation Hayleys', 'Lost Lead', '24/11/2023', 'PLDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Management Development Program', '5,375,000.00', '12/07/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - Reminder sent to Roshintha', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 'Nestle Lanka PLC', 'Lost Lead', '22/11/2023', 'PLDP BATCH 1', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', '', '0', '03/01/2024', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 'Ansell Lanka (Pvt) Ltd', 'Deployment', '29/11/2023', 'PLDP BATCH 1', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Management Development Program', '2,250,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Part Paid', 'In Progress', 'Completed', 'In Progress', 'In Progress', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - D7 July 13 - Shazil / Balance payment - 15th July', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 'Nestle Lanka PLC', 'Lost Lead', '22/11/2023', 'One day Program', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Capacity Building', '', '0', '03/01/2024', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, 'Hemas Mobility', 'Program Completed', '12/06/2023', 'Customer excellance ', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'Capacity Building', 'training sessions for our Customer Service Team and Middle Managers within the HEMAS Mobility Sector.', '2,050,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Program completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 'JAT Holding', 'Lost Lead', '12/06/2023', 'PLDP BATCH 1', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Leadership Development Program for some of the executive level staff', '2,050,000.00', '03/02/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 'Laugfs Holdings', 'Lost Lead', '11/06/2023', 'Behavioral Coaching', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Capacity Building', '4 senior team members who in in General manager position to Manager grades which we need to conduct an assessment-based Coaching for 4-6 months', '600,000.00', '27/12/2023', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, 'IFS Sri Lanka', 'Lost Lead', '18/10/2023', 'Communications Programme', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Team Experiences', 'Communicate for front end staff', '0', '25/04/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '25.04 - over the phone - will not proceed. will contact later if any requirements', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, 'BCD APAC Service Center', 'Lost Lead', '23/10/2023', 'Senior Leadership PLDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', '', '0', '04/01/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 'Gamma Pizzakraft Lanka (Pvt) L', 'Lost Lead', '09/10/2023', '2 DAY OFFSITE', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Other', '', '0', '19/02/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 'HSBC Sri Lanka', 'Program in Progress', '01/04/2024', 'Culture alligment workshop', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Training', 'Capacity Building', 'Help senior retail sales team to formulate how to cascade their goals down to the broader teams and ensure action plans that work. ', '850,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Initiated', 'Completed', 'Not Applicable', 'Completed', 'Not Applicable', 'Not Applicable', 'In Progress', 'Completed', 'Not Initiated', 'Not Initiated', 0, '11.07 - Mandeera - Check point 3 to be scheduled / 02.07 - Check point 2 with James', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'Sysco Lab', 'Deployment', '18/8/2023', 'Sysco Apex', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'WIL', '12000000', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - Discussion to be scheduled', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 'Ladies College', 'Lost Lead', '29/07/2023', 'One day Program', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Other', 'Team buiding and strategy programme', '0', '08/01/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 'UNISEF - United Nations Childr', 'Lost Lead', '23/07/2023', 'PLDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '2,250,000.00', '13/05/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 'Hemas Mobility', 'Pre Sales', '06/10/2023', 'PLDP', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Leadership Development Program', '1,875,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '12.07 - Keep in touch with Niluka\r\n*10.07 - Lavindi - followed up via whatsaap', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 'Aviation Hayleys Advantis', 'Lost Lead', '19/07/2023', 'Strategy Session', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'Capacity Building', '', '1,650,000.00', '06/03/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 'Dilmah Ceylon Tea Company PLC', 'Lost Lead', '03/10/2023', 'PLDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', '', '0', '04/07/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, 'Dilmah Ceylon Tea Company PLC', 'Lost Lead', '10/03/2023', 'EDP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'EDP', '', '0', '30/06/2024', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 'Assetline Finance Limited', 'Lost Lead', '21/11/2023', 'One day Program', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'ONE DAY TRAINING', 'a special leadership training program for our Assistant Manager and above team. ', '0', '23/11/2023', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 'FAO in SL - Food & Agriculture', 'Lost Lead', '13/11/2023', 'One day Program', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'ONE DAY TRAINING', 'Team building/ fun activities as well as to facilitate to reflect on FAOâ€™s achievements and draw bac', '0', '14/11/2023', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 'ParentPay Lanka (Pvt) Ltd', 'Lost Lead', '14/08/2023', 'PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', '', '0', '04/12/2023', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 'Ceylon Tobacco Company PLC', 'Lost Lead', '09/11/2023', 'AWARENESS PROGRAM - 1 DAY TRAINING', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Team Experiences', '', '350,000.00', '06/11/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 'Nations Trust Bank', 'Lost Lead', '17/10/2023', 'Engagement Survey ', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Training', 'Other', '2500 people, Happiness/satisfaction/engagement survey. Pls send proposal the sooner the better', '0', '19/10/2023', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 'Hirdaramani Apparel', 'Lost Lead', '11/08/2023', 'CSP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Consulting', 'CSP', '', '0', '23/01/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 'ATG Glove Solutions', 'Lost Lead', '12/08/2023', 'PLDP', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'PLDP', '', '0', '03/01/2024', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 'Singer Sri Lanka', 'Deployment', '03/08/2023', 'PLDP Batch 01', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Middle Management training', '1,650,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'In Progress', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'PVC Project stage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 'Durdans Hospital', 'Lost Lead', '11/06/2023', 'CSP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', '', '0', '06/11/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 'XigeniX PTY LTD', 'Program Completed', '20/07/2023', 'CSP', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Consulting', 'CSP', 'Culture Audit', '3,350,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '2023-03-14', 'Fully Paid', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Program Completed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 'Kerry Logistics Lanka (Pvt) Lt', 'Lost Lead', '28/07/2023', 'LEADERSHIP COUCHING', '', 0, 'Inactive Lead', 'New', 0, 0, 'Training', 'Team Experiences', 'We connected on LinkedIn some time back. I wondered if you could customize a program for my operatio', '0', '15/08/2023', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'Seylan Bank PLC', 'Lost Lead', '20/09/2023', 'OAR', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'People analytics', 'OAR', '', '462,000.00', '23/09/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'Ernst & Young Sri Lanka', 'Deployment', '27/05/2024', 'Capacity Building programme', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'Capacity building ', 'Leadership coaching and mentoring , presentaion skills one or one , Communication skills one or one , C suit mentor master class .', '2,430,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'Not Applicable', 'Not Applicable', 'In Progress', 'Not Applicable', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - D4 on 17th July - Coaching & Mentoring Senior Leaders ', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'Dipped Products PLC', 'Pre Sales', '13/07/2023', 'PLDP', '', 0, 'Active Lead', 'Pending Approval', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,650,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Mandeera - Reminder sent to Roshintha', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'Dipped Products PLC', 'Pre Sales', '13/07/2023', 'PLDP Advance C suite', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'Senior Managerial Development Program', '8,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - References to be sent', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'Haycarb PLC', 'Deployment', '20/06/2023', 'PLDP BATCH 2', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,732,500.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '2023-05-07', 'Fully Paid', 'In Progress', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'PVC Project stage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'Sysco Lab', 'Deployment', '19/05/2023', 'sysco Apex B2', '', 0, 'Active Lead', 'In Discussion', 0, 0, 'Training', 'PLDP', 'WIL', '9,000,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'In Progress', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - will be confirmed after completion of batch 01', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'Atlas Axillia Co. (Pvt) Ltd.', 'Deployment', '29/05/2023', 'BATCH 1', '', 0, 'Active Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,852,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '2024-01-16', 'Fully Paid', 'In Progress', 'Completed', 'In Progress', 'In Progress', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - D8 to be rescheduled', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'C W Mackie PLC', 'Program in Progress', '18/05/2023', 'BATCH1', '', 0, 'Close Lead', 'Confirmed', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,375,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '2023-03-05', 'Fully Paid', 'In Progress', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Completed', 'Completed', 'Completed', 0, 'PVC Projects stage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'C W Mackie PLC', 'Deployment', '03/06/2024', 'PLDP Batch 02', '', 0, 'Active Lead', 'Almost Certain', 0, 0, 'Training', 'PLDP', 'PLDP B2', '1,875,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', '2024-07-30', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '10.07 - Launch date - 14th Aug', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'Ernst & Young Sri Lanka', 'Lost Lead', '21/03/2023', 'CSP', '', 0, 'Inactive Lead', 'In Discussion', 0, 0, 'Consulting', 'CSP', '', '5,000,000.00', '14/04/2023', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', '0000-00-00', 'Not Paid', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, 'Priority Email - Jan 03rd / Call - March 12th no response', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1, 'Morison Limited', 'Deployment', '16/05/2023', 'PLDP BATCH 2', '', 0, 'Active Lead', 'New', 0, 0, 'Training', 'PLDP', 'Managerial Development Program', '1,950,000.00', '', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', 'Completed', '0000-00-00', 'Fully Paid', 'In Progress', 'Completed', 'Completed', 'Completed', 'Completed', 'In Progress', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 'Not Initiated', 0, '15.07 - Graduation date confirmed as 13th September /*PVC Project Stage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(441, 'AuroraRCM', 'Pre Sales', '2024-08-07', 'aaaa', 'maheshani rathanyake', 5, '', '', 0, 0, 'People analytics', 'OAR', 'aaaa', '100,000.000', '', 'Completed', 'Completed', 'Completed', 'Completed', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'aaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(433, 'SAMPLE', 'Pre Sales', '2024-08-06', 'xx', '', 4, '', '', 4, 0, 'Training', 'PLDP', 'xx', '200,000,000.00', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'xx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_actionpoint`
--

DROP TABLE IF EXISTS `lead_actionpoint`;
CREATE TABLE IF NOT EXISTS `lead_actionpoint` (
  `clientID` int NOT NULL AUTO_INCREMENT,
  `clientName` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(25) NOT NULL,
  `actionPoint` text NOT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`ModuleID`, `ModuleName`, `moduleType`, `duration`, `description`, `primaryFaculty`, `secondaryFaculty`, `tertiaryFaculty`, `Assessment`, `file`) VALUES
(1, 'WS1 -Leadership Transition  & Mastery ', 'Training', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', 'uploads/SB_SYSCO_ANALYTICS.xlsx'),
(4, 'WS4 -Coaching &  Developing People', 'Training', '8 h', 'Woman in Leadership Program', 'Chandana Pathirage', '', '', 'yes', ''),
(2, 'WS2 -Managing People &  Teams', 'Training', '8 h', 'Woman in Leadership Program', 'Additional Guest Resource', '', '', 'yes', 'uploads/Challenges of International Human Resource Management.pdf'),
(3, 'WS3 -Emotional  Intelligence for Leaders', 'Training', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', ''),
(5, 'WS5 -Entrepreneurial  Thinking', 'Training', '8 h', 'Woman in Leadership Program', 'Angelo De silva', '', '', 'yes', ''),
(6, 'WS6 -Finance for Business', 'Training', '8 h', 'Woman in Leadership Program', 'Shazil Ismail', '', '', 'yes', 'uploads/Product.xlsx'),
(7, 'WS7 -Productivity &  Project Management', 'Training', '8 h', 'Woman in Leadership Program', 'Mendaka Hettithantri', '', '', 'yes', ''),
(8, 'WS8 –Decision Making &  Problem Solving', 'Training', '8 h', 'Woman in Leadership Program', 'Tilak Rahulan', '', '', 'yes', ''),
(9, 'WS9 -Leadership Presence  & Inspiration', 'Training', '8 h', 'Woman in Leadership Program', 'Additional Guest Resource', '', '', 'yes', ''),
(11, 'WS11 -Management-Level  Communication', 'Training', '8 h', 'Woman in Leadership Program', 'Mendaka Hettithantri', '', '', 'yes', ''),
(12, 'WS12 –Design Thinking', 'Training', '8 h', 'Woman in Leadership Program', 'Angelo De Silva', '', '', 'yes', ''),
(13, 'Managing  people P1', 'Training', '8 h', '', 'Angelo De Silva', '', '', 'yes', ''),
(14, 'Managing  People P2', 'Training', '8 h', '', 'Angelo De Silva', '', '', 'yes', ''),
(64, 'Coaching & Developing People', 'Training', '8h', '', 'Rukshan De Silva', '', '', 'No', ''),
(65, '1:1 Assessment ', '1:1', '1 Week', '', 'support Team', '', '', 'No', ''),
(73, '', 'Consulting', '1h', '', 'Angelo', '', '', 'No', ''),
(74, '', 'Consulting', '1h', '', 'Angelo', '', '', 'No', ''),
(75, 'rrrrr', 'Consulting', '1h', '', 'Angelo', '', '', 'No', ''),
(76, 'rrrrr', 'Consulting', '1h', '', 'Angelo', '', '', 'No', '');

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
(1, 'Maheshani', 'Rathnayake', 'Female', '2002-01-05', 'IT Support', '0711720004', '0711720004', 'Colombo', 'support@sandbox.lk', 'maheshani', '25d55ad283aa400af464c76d713c07ad', '', 1, 'active'),
(2, 'Angelo', 'De silva', 'Male', '0000-00-00', 'managing director', '1234567890', '9876543210', '123 Main St', 'angelo@sandbox.lk', 'angelo', '52543ad1ecaf31fa6755426210c97774', '', 1, 'active'),
(3, 'Menaka', 'Mayadunne', 'Female', '0000-00-00', 'head of operations', '9876543210', '1234567890', '456 Elm St', 'menaka@sandbox.lk', 'menaka', '13f5df87e629f46ebf27aa86175cfeb0', '', 1, 'active'),
(4, 'lavindi', 'de silva', 'Female', '0000-00-00', 'admin', '5555555555', '9999999999', '789 Oak St', 'admin@sandbox.lk', 'lavindi', '80ac2bbaa959444a0aaae3ca1e4c38ea', '', 1, 'active'),
(5, 'mandeera', 'karawita', 'Female', '0000-00-00', 'training', '3333333333', '8888888888', '321 Pine St', 'training@sandbox.lk', 'mandeera', 'c577d443023e6558ce42ccad9fbec670', '', 1, 'active');

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
