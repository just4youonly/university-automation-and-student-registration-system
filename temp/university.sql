-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 12:41 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratorTable`
--

CREATE TABLE `administratorTable` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `adminSurname` varchar(50) NOT NULL,
  `adminPassword` varchar(50) NOT NULL,
  `adminEmail` varchar(100) NOT NULL,
  `adminTC` varchar(11) NOT NULL,
  `adminTel` varchar(10) NOT NULL,
  `adminBirthdate` date NOT NULL,
  `adminAddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departmentTable`
--

CREATE TABLE `departmentTable` (
  `departmentId` int(11) NOT NULL,
  `departmentName` varchar(50) NOT NULL,
  `facultyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departmentTable`
--

INSERT INTO `departmentTable` (`departmentId`, `departmentName`, `facultyId`) VALUES
(2, 'fasfsafa', 2);

-- --------------------------------------------------------

--
-- Table structure for table `facultyTable`
--

CREATE TABLE `facultyTable` (
  `facultyId` int(11) NOT NULL,
  `facultyName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facultyTable`
--

INSERT INTO `facultyTable` (`facultyId`, `facultyName`) VALUES
(1, 'Muhendislik'),
(2, 'Edebiyat');

-- --------------------------------------------------------

--
-- Table structure for table `studentTable`
--

CREATE TABLE `studentTable` (
  `studentId` int(11) NOT NULL,
  `studentName` varchar(30) NOT NULL,
  `studentSurname` varchar(30) NOT NULL,
  `studentPassword` varchar(50) NOT NULL,
  `studentEmail` varchar(100) NOT NULL,
  `studentTC` varchar(11) NOT NULL,
  `studentTel` varchar(10) NOT NULL,
  `studentBirthdate` date NOT NULL,
  `studentAddress` varchar(200) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjectStudentGrade`
--

CREATE TABLE `subjectStudentGrade` (
  `subjectId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `midTerm` int(11) NOT NULL,
  `finalTerm` int(11) NOT NULL,
  `subjectStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjectTable`
--

CREATE TABLE `subjectTable` (
  `subjectId` int(11) NOT NULL,
  `subjectName` varchar(50) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjectTable`
--

INSERT INTO `subjectTable` (`subjectId`, `subjectName`, `facultyId`, `departmentId`) VALUES
(2, 'dfsfs', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjectTeacher`
--

CREATE TABLE `subjectTeacher` (
  `subjectId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teacherTable`
--

CREATE TABLE `teacherTable` (
  `teacherId` int(11) NOT NULL,
  `teacherName` varchar(30) NOT NULL,
  `teacherSurname` varchar(30) NOT NULL,
  `teacherPassword` varchar(50) NOT NULL,
  `teacherEmail` varchar(100) NOT NULL,
  `teacherTC` varchar(11) NOT NULL,
  `teacherTel` varchar(10) NOT NULL,
  `teacherBirthdate` date NOT NULL,
  `teacherAddress` varchar(200) NOT NULL,
  `teacherStatus` enum('teacher','supervisor','common','supervisor_common') NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratorTable`
--
ALTER TABLE `administratorTable`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `adminTC` (`adminTC`),
  ADD UNIQUE KEY `adminTel` (`adminTel`),
  ADD UNIQUE KEY `adminEmail` (`adminEmail`);

--
-- Indexes for table `departmentTable`
--
ALTER TABLE `departmentTable`
  ADD PRIMARY KEY (`departmentId`),
  ADD KEY `fk_department_faculty` (`facultyId`);

--
-- Indexes for table `facultyTable`
--
ALTER TABLE `facultyTable`
  ADD PRIMARY KEY (`facultyId`);

--
-- Indexes for table `studentTable`
--
ALTER TABLE `studentTable`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `studentTel` (`studentTel`),
  ADD UNIQUE KEY `studentTC` (`studentTC`),
  ADD UNIQUE KEY `studentEmail` (`studentEmail`),
  ADD KEY `fk_student_faculty` (`facultyId`),
  ADD KEY `fk_student_department` (`departmentId`);

--
-- Indexes for table `subjectStudentGrade`
--
ALTER TABLE `subjectStudentGrade`
  ADD PRIMARY KEY (`subjectId`,`studentId`),
  ADD KEY `fk_studentId` (`studentId`);

--
-- Indexes for table `subjectTable`
--
ALTER TABLE `subjectTable`
  ADD PRIMARY KEY (`subjectId`),
  ADD KEY `fk_subject_faculty` (`facultyId`),
  ADD KEY `fk_subject_department` (`departmentId`);

--
-- Indexes for table `subjectTeacher`
--
ALTER TABLE `subjectTeacher`
  ADD PRIMARY KEY (`subjectId`,`teacherId`),
  ADD KEY `fk_teacher_connect` (`teacherId`);

--
-- Indexes for table `teacherTable`
--
ALTER TABLE `teacherTable`
  ADD PRIMARY KEY (`teacherId`),
  ADD UNIQUE KEY `teacherTel` (`teacherTel`),
  ADD UNIQUE KEY `teacherTC` (`teacherTC`),
  ADD UNIQUE KEY `teacherEmail` (`teacherEmail`),
  ADD KEY `fk_teacher_faculty` (`facultyId`),
  ADD KEY `fk_teacher_department` (`departmentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratorTable`
--
ALTER TABLE `administratorTable`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departmentTable`
--
ALTER TABLE `departmentTable`
  MODIFY `departmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `facultyTable`
--
ALTER TABLE `facultyTable`
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studentTable`
--
ALTER TABLE `studentTable`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjectTable`
--
ALTER TABLE `subjectTable`
  MODIFY `subjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacherTable`
--
ALTER TABLE `teacherTable`
  MODIFY `teacherId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `departmentTable`
--
ALTER TABLE `departmentTable`
  ADD CONSTRAINT `fk_department_faculty` FOREIGN KEY (`facultyId`) REFERENCES `facultyTable` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentTable`
--
ALTER TABLE `studentTable`
  ADD CONSTRAINT `fk_student_department` FOREIGN KEY (`departmentId`) REFERENCES `departmentTable` (`departmentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_faculty` FOREIGN KEY (`facultyId`) REFERENCES `facultyTable` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectStudentGrade`
--
ALTER TABLE `subjectStudentGrade`
  ADD CONSTRAINT `fk_studentId` FOREIGN KEY (`studentId`) REFERENCES `studentTable` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subjectId` FOREIGN KEY (`subjectId`) REFERENCES `subjectTable` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectTable`
--
ALTER TABLE `subjectTable`
  ADD CONSTRAINT `fk_subject_department` FOREIGN KEY (`departmentId`) REFERENCES `departmentTable` (`departmentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_faculty` FOREIGN KEY (`facultyId`) REFERENCES `facultyTable` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectTeacher`
--
ALTER TABLE `subjectTeacher`
  ADD CONSTRAINT `fk_subject_connect` FOREIGN KEY (`subjectId`) REFERENCES `subjectTable` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_connect` FOREIGN KEY (`teacherId`) REFERENCES `teacherTable` (`teacherId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacherTable`
--
ALTER TABLE `teacherTable`
  ADD CONSTRAINT `fk_teacher_department` FOREIGN KEY (`departmentId`) REFERENCES `departmentTable` (`departmentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_faculty` FOREIGN KEY (`facultyId`) REFERENCES `facultyTable` (`facultyId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
