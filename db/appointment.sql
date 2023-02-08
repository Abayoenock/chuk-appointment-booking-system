-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2023 at 01:12 PM
-- Server version: 5.7.40-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonNumber` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  `adminStatus` int(11) NOT NULL,
  `AdminDateAdded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `firstname`, `lastname`, `email`, `phonNumber`, `password`, `adminStatus`, `AdminDateAdded`) VALUES
(1, 'abayo', '  enock', 'abayo.h.enock@gmail.com', '0786135953', 'fe008700f25cb28940ca8ed91b23b354', 1, 1672391450),
(2, 'faina', 'yankurije', 'yankurije.faina@gmail.com', '0787450379', 'fe008700f25cb28940ca8ed91b23b354', 1, 1672391450);

-- --------------------------------------------------------

--
-- Table structure for table `appointmentapproval`
--

CREATE TABLE `appointmentapproval` (
  `approvalID` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `appointmentApprove` int(11) NOT NULL,
  `receptionistID` int(11) NOT NULL,
  `smsSent` int(11) NOT NULL,
  `reminder` int(11) NOT NULL,
  `dateOfAction` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmentapproval`
--

INSERT INTO `appointmentapproval` (`approvalID`, `appointmentID`, `message`, `appointmentApprove`, `receptionistID`, `smsSent`, `reminder`, `dateOfAction`) VALUES
(21, 36, 'hello Keza Gaella, Your appointment that you requested with  PF.. CYUBAHIRO   Ian on 24-01 -2023 has been successfuly confirmed', 1, 7, 1, 0, 1673878582),
(23, 39, 'hello MUKAMANA Christine, Your appointment that you requested with  Dr. Nsabimana  Elie on 15-02 -2023 has been successfuly confirmed', 1, 4, 1, 0, 1673957610),
(25, 40, 'hello MUKAMANA Christine, Your appointment that you requested with Dr.. NDAYAMBAJE Augustin on 15-02 -2023 has been successfuly confirmed', 1, 5, 1, 0, 1673957765),
(27, 28, 'hello Duhimbaze Elie, Your appointment that you requested with  Dr. Nsabimana  Elie on 19-01 -2023 has been successfuly confirmed', 1, 10, 1, 0, 1673957987),
(30, 50, 'hello MUKAMANA Christine, Your appointment that you requested with DR. MUGABO Jean on 22-02 -2023 has been successfuly confirmed', 1, 4, 1, 0, 1674912829),
(31, 52, 'hello abayo enock, Your appointment that you requested with   Dr. Nsabimana   Elie on 01-03 -2023 has been successfuly confirmed', 0, 11, 1, 0, 1675073489),
(32, 54, 'hello MUKAMANA Christine, Your appointment that you requested with   Dr. Nsabimana   Elie on 02-03 -2023 has been successfuly confirmed', 1, 4, 1, 0, 1675175985),
(33, 57, 'hello UWIMBABAZI  Fanny, Your appointment that you requested with Dr. MUJAWAYEZU Agnes on 27-02 -2023 has been successfuly confirmed', 1, 8, 1, 0, 1675336180),
(34, 59, 'hello MUKAMANA Christine, Your appointment that you requested with Dr. MUJAWAYEZU Agnes on 27-02 -2023 has been Declined We are sorry for the inconvenience try on another day ', 0, 8, 1, 0, 1675336227),
(35, 53, 'hello nyiransanzimfura Bella, Your appointment that you requested with Dr. MUJAWAYEZU Agnes on 15-02 -2023 has been successfuly confirmed', 1, 8, 1, 0, 1675336424),
(36, 64, 'hello Yankurije Faina, Your appointment that you requested with Dr. SEKAMANA Claude on 27-02 -2023 has been successfuly confirmed', 1, 9, 1, 0, 1675337113);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `patientFile` varchar(255) DEFAULT NULL,
  `appointmentDate` varchar(20) NOT NULL,
  `appointmentStatus` int(11) NOT NULL,
  `dateCreated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentID`, `patientID`, `departmentID`, `doctorID`, `patientFile`, `appointmentDate`, `appointmentStatus`, `dateCreated`) VALUES
(28, 21, 6, 3, '158207205063c2b6dec413e.png', '1674079200', 1, '1673705182'),
(29, 21, 6, 3, NULL, '1675202400', 1, '1673705276'),
(36, 23, 11, 5, NULL, '1674511200', 1, '1673878250'),
(37, 24, 8, 6, NULL, '1674079200', 0, '1673879786'),
(38, 25, 6, 4, NULL, '1676412000', 1, '1673947762'),
(39, 25, 7, 3, NULL, '1676412000', 1, '1673947795'),
(40, 25, 8, 6, NULL, '1676412000', 1, '1673947821'),
(44, 24, 11, 10, NULL, '1675029600', 0, '1673957437'),
(45, 24, 11, 10, '81609573163c69064e6e67.PNG', '1676412000', 0, '1673957476'),
(46, 26, 12, 11, NULL, '1675029600', 0, '1673963979'),
(47, 26, 6, 4, NULL, '1676412000', 0, '1674057358'),
(50, 25, 7, 13, '17244376763d523bb62ab8.PNG', '1677016800', 1, '1674912699'),
(51, 23, 7, 3, NULL, '1677016800', 0, '1674913127'),
(52, 26, 7, 3, NULL, '1677621600', 1, '1675073451'),
(53, 29, 9, 12, NULL, '1676412000', 1, '1675085674'),
(54, 25, 7, 3, '50195814163d81d184a24f.PNG', '1677708000', 1, '1675107608'),
(55, 26, 12, 11, NULL, '1675116000', 0, '1675150902'),
(56, 32, 11, 10, NULL, '1676412000', 0, '1675174441'),
(57, 31, 9, 12, '59647171563db959da3837.PNG', '1677448800', 1, '1675335069'),
(58, 32, 9, 12, NULL, '1677448800', 0, '1675335312'),
(59, 25, 9, 12, '57038780463db974fec163.PNG', '1677448800', 1, '1675335503'),
(60, 25, 6, 4, NULL, '1676412000', 1, '1675335634'),
(61, 25, 7, 13, NULL, '1677794400', 0, '1675335727'),
(62, 25, 7, 3, '17032883063db9856ea415.PNG', '1677621600', 1, '1675335767'),
(63, 25, 12, 11, '182734944863db99198a370.PNG', '1676412000', 0, '1675335961'),
(64, 32, 12, 11, '21642171863db9c9fecfc0.PNG', '1677448800', 1, '1675336863'),
(65, 26, 8, 6, '161983374463dbbb874451e.png', '1675980000', 0, '1675344775'),
(66, 26, 7, 3, NULL, '1676239200', 0, '1675344998');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_ID` int(11) NOT NULL,
  `departmentName` varchar(50) NOT NULL,
  `departmentImage` varchar(255) NOT NULL,
  `departmentDescription` longtext NOT NULL,
  `adminID` int(11) NOT NULL,
  `DdateCreated` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_ID`, `departmentName`, `departmentImage`, `departmentDescription`, `adminID`, `DdateCreated`) VALUES
(6, 'Anesthesiology and Critical Care', '164018122263c2b4778eb52.jpg', 'The department of Anesthesiology and Critical Care at CHUK provides expert anesthesia care for the full spectrum of medical and surgical indication seen at tertiary care teaching institution.', 1, 1673704567),
(7, 'Surgery', '137938788263c2f8054f2da.PNG', 'The Unit of General Surgery at Kigali University Teaching Hospital provides excellent care to patient with both emergent and non emergent general surgical conditions.', 2, 1673721861),
(8, 'Accident/Emergency', '50755911863c2fade06015.PNG', ' Our emergency room is responsible to deliver high level of care on the national referral pathway.', 2, 1673722590),
(9, 'Internal Medicine', '59852816963c38c805fd6b.PNG', 'The Department of Internal Medicine consists of 4 Inpatient units with a 68 bed capacity. For years, we have excelled in clinical care, research, and education. That rich history teaches us to respect tradition and to strive for greater innovation and discovery.', 2, 1673759872),
(10, 'pediatrics', '93528164463c38df827786.PNG', 'Commitment to improve the health of children through excellent service delivery, education, and relevant research', 2, 1673760248),
(11, 'Gynecology& Obstetrics', '76211098063c38f209ed44.PNG', 'We provide a comprehensive range of services for the medical and surgical treatment for women throughout the spectrum of their life', 2, 1673760544),
(12, 'EAR,Nose &Throat(ENT)', '17016010463c390e40991a.PNG', 'The specialty of Otolaryngology is one of unit of the department of surgery at CHUK. It is a diverse clinical discipline that deals with disorders involving the Head & Neck region, primarily diseases afflicting the Ear, Nose and Throat (ENT).', 2, 1673760996),
(13, 'Neurosurgery', '202528704363d521ce1527e.PNG', 'Neurosurgery or neurological surgery, known in common parlance as brain surgery, is the medical specialty concerned with the prevention, diagnosis, surgical treatment, and rehabilitation of disorders which affect any portion of the nervous system including the brain, spinal cord, central and peripheral nervous system.', 2, 1674912206),
(14, 'Mental Health', '169354075663db85363b6c9.PNG', 'The CHUK Mental Health department delivers a range of care and treatment for the treatment of people experiencing common mental health disorders such as mild to moderate depression, panic disorder, generalized anxiety disorder, obsessive-compulsive disorder, social phobia and uncomplicated post traumatic stress disorder.', 2, 1675330870),
(15, 'Maternal and Neonatology', '149670629663db86fe49b14.PNG', 'Neonatology is a department of Maternal and Neonatology directorate that consists of the medical care of newborn infants, especially the ill or premature newborn.', 2, 1675331326),
(16, 'Ophthalmology', '186221518363db88486f5fa.PNG', 'The ophthalmology Service of the University Teaching Hospital of Kigali (CHUK) provides care for all types of conditions of the eye and surrounding structures. ', 2, 1675331656),
(17, 'Pediatrics Surgery', '117300714863db89239aef4.PNG', 'Pediatric surgery is a subspecialty of surgery involving the surgery of fetuses, infants, children, adolescents, and young adults.\r\nSubspecialties of pediatric surgery itself include: neonatal surgery and fetal surgery.', 2, 1675331875),
(18, 'Urology', '62513345763db89f97b1e0.PNG', 'Urology is a part of health care that deals with diseases of the male and female urinary tract (kidneys, ureters, bladder and urethra).', 2, 1675332089),
(19, 'Nephrology', '138907061063db8b093f360.PNG', 'Nephrology concerns the diagnosis and treatment of kidney diseases.', 2, 1675332361),
(20, 'Dialysis', '189575077363db8c24b20e3.PNG', 'Dialysis is a procedure to remove waste products and excess fluid from the blood when the kidneys stop working properly. It often involves diverting blood to a machine to be cleaned.', 2, 1675332644),
(21, 'Oncology', '153468958663db8d9292d6a.PNG', 'Oncology is a branch of medicine that deals with the study, treatment, diagnosis and prevention of cancer.', 2, 1675333011),
(22, 'Delmatology', '177355212763db8e84db51a.PNG', 'The Unit of Dermatology delivers services to patients from District Hospitals, Provincial Hospitals of the whole country and also those coming from other departments of CHUK to whom a Dermatologist review is requested for inpatients or outpatients', 2, 1675333252);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctorID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `profileImg` varchar(255) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `title` varchar(30) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `recordedBy` int(11) NOT NULL,
  `dateAddded` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctorID`, `firstname`, `lastname`, `profileImg`, `specialization`, `title`, `departmentID`, `email`, `phoneNumber`, `password`, `status`, `recordedBy`, `dateAddded`) VALUES
(3, 'Nsabimana', '  Elie', '16120532963c2b4e45e0e9.png', '  Surgery', '  Dr', 7, 'turabayo201@gmail.com', '0789506566', '0ef9cec230a3c1c8c225ebe4d9e5e313', 1, 1, 1673704676),
(4, 'abayo', 'enock', '87113870163c2b53859aff.png', 'ophthalmology', 'Dr', 6, 'abayo.h.enock@gmail.com', '0786135953', 'eaa4795c5e420281c35ff8395651afce', 1, 1, 1673704760),
(5, 'CYUBAHIRO', '  Ian', '103066665463c2fc5c09c3a.PNG', 'Surgery ', ' PF.', 8, 'cyubahiro@gmail.com', '0787450379', 'e1fabe796315acd00c0fc2d358c1bcb4', 1, 2, 1673722972),
(6, 'NDAYAMBAJE', 'Augustin', '27883669963c3a4f1aa015.PNG', 'Emmegency', 'Dr.', 8, 'ndayambaje@gmail.com', '0788799183', '525e852634e9c6e03213103f9319572d', 1, 2, 1673766129),
(8, 'NYIRANDAHIRIWE', 'Adeline', '188476203263c54da7447c1.PNG', 'Pediatric', 'Dr.', 10, 'nyira.adeline@gmail.com', '0783726614', 'bf9f67e2b6c47445e5f8f5772b9c8d26', 1, 2, 1673874855),
(9, 'SHUMBUSHO', 'Yves', '176207274463c54f7900399.PNG', 'Pediatric', 'Pr.', 10, 'shumbusho.yves@yahoo.com', '0788554101', '82443f8151d39855911774bd727a1cd9', 1, 2, 1673875321),
(10, 'TUMUKUNDE', 'Jean', '107691870963c551954d8c2.PNG', 'Gynecology', 'Dr.', 11, 'tumukunde.jean@gmail.com', '0788601129', '356d04381c2b3d75a30c8b59fc86505b', 1, 2, 1673875861),
(11, 'SEKAMANA', 'Claude', '118033134163c65bb86fa8a.PNG', 'EAR,Nose & Throat', 'Dr', 12, 'sekamana@gmail.com', '0782524094', '90a308964a41d9e821a05459ea1d923f', 1, 2, 1673943992),
(12, 'MUJAWAYEZU', 'Agnes', '185249902363c65cd1951f9.PNG', 'medecine', 'Dr', 9, 'agnes.muja@gmail.com', '0783877301', '6d4ad3aa0ce1d71fac03fcb73b6728fa', 1, 2, 1673944273),
(13, 'MUGABO', 'Jean', '202460833763cfe9de94bc9.PNG', 'Pediatric', 'DR', 7, 'mugabo@gmail.com', '0789453014', 'd998e229f4f2cbc0e1071a56f18fcaee', 1, 2, 1674570206),
(14, 'NDAYAMBAJE ', 'Augustin', '71652070163db80bb5401e.PNG', 'Neurosurgery', 'Dr', 13, 'augustin@gmail.com', '0722525601', 'e9e071b913fa7c28503a2a4075c5095f', 1, 2, 1675329723);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `nid` varchar(17) NOT NULL,
  `insurance` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` varchar(30) NOT NULL,
  `OTP` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dateOfRegistration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `firstname`, `lastname`, `gender`, `DOB`, `phoneNumber`, `nationality`, `nid`, `insurance`, `password`, `code`, `OTP`, `status`, `dateOfRegistration`) VALUES
(21, 'Duhimbaze', 'Elie', 'Male', '2023-02-13', '0789506566', 'rwandan', '123456789', 'RSSB [Mituel]', 'fe008700f25cb28940ca8ed91b23b354', 'CHUK519', 3652, 2, 1673704994),
(23, 'Keza', 'Gaella', 'Female', '1994-02-07', '0783945036', 'rwandan', '1199070194144138', 'RSSB [Mituel]', '4edb8976d58f62fcb44c1a0b030a8be0', 'CHUK978', 8357, 2, 1673877993),
(24, 'Nyiramirimo', 'Claudine', 'Female', '1996-01-01', '0726531007', 'ugandan', '1199070194144138', 'Radiant', 'a6765c4ebae7b84ae1adda85210732cc', 'CHUK197', 5714, 2, 1673879580),
(25, 'MUKAMANA', 'Christine', 'Female', '1976-02-08', '0783199105', 'rwandan', '1197654213478902', 'RSSB [Mituel]', 'ee2228645eb67eabbb13cbd22e949f10', 'CHUK281', 7264, 2, 1673946649),
(26, 'abayo', 'enock', 'Male', '1999-01-05', '0786135953', '', '123456789', 'Rama', 'fe008700f25cb28940ca8ed91b23b354', '', 4921, 2, 1673963789),
(28, 'Richard', 'Musabe', 'Male', '1987-11-2', '0789453014', '', '1981100981236786', 'Rama', 'eafcf80b6a1698c022a862317617f060', '', 0, 2, 1674570577),
(29, 'nyiransanzimfura', 'Bella', 'Female', '1987-04-08', '0728380482', '', '1198770126292105', 'Mutuelle', 'f3766bb48ec95f22f96f5cee5e39b6eb', '', 0, 2, 1675085585),
(30, 'ineza', 'chanatl', 'Female', '2023-01-04', '0732110508', 'belgian', '123456789', 'RSSB [RAMA]', 'fe008700f25cb28940ca8ed91b23b354', 'CHUK643', 5817, 1, 1675150325),
(31, 'UWIMBABAZI ', 'Fanny', 'Male', '1989-02-07', '0783877289', 'rwandan', '1198970194414156', 'None', '09fea56e9539c7e012a5257fe1bba54c', 'CHUK357', 2146, 2, 1675168220),
(32, 'Yankurije', 'Faina', 'Female', '1990-12-02', '0787450379', '', '1199070194144138', 'None', '101486957d4920221de9ad277117b03d', '', 6479, 2, 1675174344),
(33, 'NDAYAMBAJE', 'AUGUSTIN', 'Male', '1990-12-09', '0722525601', 'rwandan', '1199070194144138', 'RSSB [RAMA]', '4f43653ead25b16fcba0bbf682f00be0', 'CHUK852', 1852, 1, 1675333958);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `recpID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `profileImg` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `recpDateAdded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`recpID`, `firstname`, `lastname`, `profileImg`, `email`, `phoneNumber`, `departmentID`, `password`, `status`, `recpDateAdded`) VALUES
(4, 'ISHIMWE', 'Albertine', '43241174763c2ff62b5740.PNG', 'ishimwe@gmail.com', '0787450379', 7, 'c76c7a290f0eb72fb5c3966dd3e5a84e', 1, 1673723746),
(5, 'uwimbabazi', 'Francois', '3852574163c300788b9f0.PNG', 'uwimbabazi@gmail.com', '0783199105', 8, '2e1ad66fa8ea2679c15a71d00a757575', 1, 1673724024),
(7, 'UWERA ', 'Claudine', '170090939163c39d014599e.PNG', 'uwera@gmail.com', '0722451295', 11, 'e3fd476addbf57c44ffbfc1f85589c91', 1, 1673764097),
(8, 'MUKANSANGA', 'Marie', '118347583163c64cc26e383.PNG', 'marie.mukansanga@yahoo.com', '0783877301', 9, '983ff27d1e0844f3ef3bf54434b4f5a2', 1, 1673940162),
(9, 'NSANZUMUHIRE', 'John', '143836927963c64d4a36e3f.PNG', 'nsanzu.john@gmail.com', '0782524094', 12, '88d05be5413673f426a57964fe5a02cb', 1, 1673940298),
(10, 'GAHUNGU ', 'Jean', '83244789863c64e3a19482.PNG', 'gahungu@gmail.com', '0737551870', 6, '8062f75931e3b000bcf1b5105088e756', 1, 1673940538),
(11, 'ineza', 'chanatl', '101697736363d796767038e.png', 'abayo.h.enock@gmail.com', '0786135953', 7, 'd6f2249d14d81a5a8f131e009b83910b', 1, 1675073142),
(12, 'UWINGENEYE', 'Delphine', '210138923363db821af181a.PNG', 'delphine@gmail.com', '0722525601', 10, 'f35d07e193e235562ceacd3d51d6e92b', 1, 1675330074);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timeTableID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `dateAvailable` varchar(20) NOT NULL,
  `numberOfPatients` int(11) NOT NULL,
  `timeTableStatus` varchar(20) NOT NULL,
  `setBy` int(11) NOT NULL,
  `TimeSet` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timeTableID`, `departmentID`, `doctorID`, `dateAvailable`, `numberOfPatients`, `timeTableStatus`, `setBy`, `TimeSet`) VALUES
(39, 7, 5, '1673733600', 50, '1', 4, '1673724745'),
(40, 7, 3, '1673906400', 50, '1', 4, '1673867653'),
(41, 7, 3, '1673992800', 50, '1', 4, '1673867672'),
(42, 7, 3, '1674165600', 20, '1', 4, '1673867694'),
(43, 7, 3, '1674424800', 50, '1', 4, '1673867714'),
(44, 8, 6, '1674079200', 60, '1', 5, '1673868025'),
(45, 8, 6, '1674424800', 40, '1', 5, '1673868052'),
(46, 8, 6, '1674511200', 10, '1', 5, '1673868073'),
(47, 8, 6, '1674770400', 30, '1', 5, '1673868095'),
(48, 8, 6, '1675029600', 60, '1', 5, '1673868120'),
(49, 11, 5, '1674079200', 10, '1', 7, '1673868356'),
(50, 11, 5, '1674511200', 40, '1', 7, '1673868387'),
(51, 11, 5, '1674770400', 60, '1', 7, '1673868406'),
(52, 11, 5, '1675029600', 50, '1', 7, '1673868443'),
(53, 7, 3, '1675029600', 40, '1', 4, '1673945295'),
(54, 7, 3, '1676412000', 60, '1', 4, '1673945332'),
(55, 7, 3, '1676239200', 30, '1', 4, '1673945369'),
(56, 8, 5, '1676412000', 50, '1', 5, '1673945534'),
(57, 8, 6, '1676412000', 20, '1', 5, '1673945557'),
(58, 8, 6, '1676412000', 20, '1', 5, '1673945557'),
(59, 8, 6, '1675980000', 50, '1', 5, '1673945582'),
(60, 8, 6, '1675980000', 50, '1', 5, '1673945583'),
(61, 11, 10, '1675029600', 50, '1', 7, '1673945719'),
(62, 11, 10, '1676412000', 40, '1', 7, '1673945738'),
(63, 9, 12, '1675029600', 35, '1', 8, '1673945845'),
(64, 9, 12, '1676412000', 40, '1', 8, '1673945861'),
(65, 9, 12, '1676671200', 30, '1', 8, '1673945898'),
(66, 12, 11, '1675029600', 55, '1', 9, '1673945968'),
(67, 12, 11, '1676412000', 20, '1', 9, '1673945983'),
(68, 6, 4, '1675029600', 0, '1', 10, '1673946080'),
(69, 6, 4, '1675029600', 40, '1', 10, '1673946080'),
(70, 6, 4, '1675029600', 40, '1', 10, '1673946081'),
(71, 6, 4, '1675029600', 40, '1', 10, '1673946081'),
(72, 6, 4, '1676412000', 5, '1', 10, '1673946169'),
(73, 12, 11, '1675116000', 40, '1', 9, '1674571033'),
(74, 7, 3, '1676671200', 40, '1', 4, '1674887522'),
(75, 7, 13, '1676757600', 40, '1', 4, '1674887540'),
(76, 7, 13, '1676671200', 60, '1', 4, '1674887612'),
(77, 7, 3, '1676757600', 45, '1', 4, '1674887646'),
(78, 7, 13, '1676844000', 20, '1', 4, '1674887932'),
(79, 7, 3, '1677016800', 50, '1', 4, '1674887946'),
(80, 7, 13, '1677016800', 60, '1', 4, '1674887960'),
(81, 7, 3, '1677621600', 40, '1', 4, '1674888211'),
(82, 7, 13, '1677708000', 20, '1', 4, '1674888323'),
(83, 7, 3, '1677708000', 50, '1', 4, '1674888345'),
(85, 11, 10, '1677621600', 30, '1', 7, '1675175889'),
(86, 11, 10, '1677708000', 50, '1', 7, '1675175906'),
(87, 11, 10, '1677794400', 12, '1', 7, '1675175918'),
(88, 7, 13, '1677794400', 54, '1', 4, '1675176102'),
(89, 9, 12, '1675375200', 50, '1', 8, '1675334525'),
(90, 9, 12, '1675634400', 30, '1', 8, '1675334545'),
(91, 9, 12, '1675720800', 50, '1', 8, '1675334558'),
(92, 9, 12, '1676498400', 50, '1', 8, '1675334573'),
(93, 9, 12, '1676239200', 0, '1', 8, '1675334600'),
(94, 9, 12, '1677621600', 20, '1', 8, '1675334617'),
(95, 9, 12, '1677708000', 60, '1', 8, '1675334637'),
(96, 9, 12, '1677794400', 70, '1', 8, '1675334651'),
(97, 9, 12, '1677448800', 40, '1', 8, '1675334705'),
(98, 12, 11, '1677448800', 70, '1', 9, '1675336721'),
(99, 12, 11, '1677016800', 54, '1', 9, '1675336751'),
(100, 12, 11, '1676930400', 40, '1', 9, '1675336781');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `appointmentapproval`
--
ALTER TABLE `appointmentapproval`
  ADD PRIMARY KEY (`approvalID`),
  ADD KEY `receptionistID` (`receptionistID`),
  ADD KEY `appointmentID` (`appointmentID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_ID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctorID`),
  ADD KEY `departmentID` (`departmentID`),
  ADD KEY `recordedBy` (`recordedBy`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientID`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`recpID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timeTableID`),
  ADD KEY `deparmentID` (`departmentID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `setBy` (`setBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointmentapproval`
--
ALTER TABLE `appointmentapproval`
  MODIFY `approvalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `recpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timeTableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointmentapproval`
--
ALTER TABLE `appointmentapproval`
  ADD CONSTRAINT `appointmentapproval_ibfk_1` FOREIGN KEY (`receptionistID`) REFERENCES `receptionist` (`recpID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointmentapproval_ibfk_2` FOREIGN KEY (`appointmentID`) REFERENCES `appointments` (`appointmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`departmentID`) REFERENCES `department` (`dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`recordedBy`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD CONSTRAINT `receptionist_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`setBy`) REFERENCES `receptionist` (`recpID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
