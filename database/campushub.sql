-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2026 at 03:13 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campushub`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'Workshop'),
(2, 'Seminar'),
(3, 'Lomba'),
(4, 'Teknologi'),
(5, 'Seni & Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventId` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text,
  `organizer` varchar(100) DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `eventDate` date NOT NULL,
  `startTime` time NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `capacity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventId`, `title`, `description`, `organizer`, `categoryId`, `eventDate`, `startTime`, `location`, `capacity`) VALUES
(1, 'UI/UX DESIGN WORKSHOP', 'Workshop UI/UX Design untuk mahasiswa yang ingin belajar mengenai desain antarmuka dan pengalaman pengguna.', 'Himpunan Mahasiswa', 1, '2026-12-24', '08:00:00', 'Auditorium Lantai 3 PNJ', 100),
(2, 'Seminar Future Leaders Forum', 'Seminar yang menghubungkan wawasan akademik dengan kebutuhan dunia industri serta membahas leadership.', 'BEM Kampus', 2, '2027-01-22', '13:14:00', 'Auditorium Lt.4', 150),
(3, 'AnKa Football Competition', 'Kompetisi sepak bola antar mahasiswa untuk mempererat tali silaturahmi.', 'UKM Olahraga', 3, '2027-01-15', '17:00:00', 'Lapangan SPIRIT', 200),
(4, 'Web Development Bootcamp: React & PHP', 'Intensive workshop membangun aplikasi web modern menggunakan React JS dan PHP backend untuk pemula hingga menengah.', 'Himpunan Mahasiswa Informatika', 4, '2026-11-10', '09:00:00', 'Lab Komputer Gedung B Lt. 2', 80),
(5, 'National Cyber Security Competition 2026', 'Kompetisi Capture The Flag (CTF) tingkat nasional untuk menguji kemampuan bidang ethical hacking dan keamanan jaringan.', 'Cyber Security Club', 3, '2026-11-20', '08:00:00', 'Auditorium Utama Kampus', 150),
(6, 'AI & Machine Learning Seminar Series', 'Seminar eksklusif membahas perkembangan Artificial Intelligence, LLM, dan penerapannya di dunia industri terkini.', 'UKM Riset & Teknologi', 2, '2026-12-05', '10:00:00', 'Ruang Seminar Gedung C Lt. 3', 120),
(7, 'Campus Art & Music Festival 2026', 'Festival seni dan musik tahunan yang menampilkan pameran karya mahasiswa, bazar kreatif, dan penampilan band kampus.', 'UKM Kesenian & Kebudayaan', 5, '2026-12-15', '15:30:00', 'Lapangan Lapangan PNJ', 500),
(8, 'Public Speaking & Leadership Training', 'Pelatihan khusus untuk melatih kepercayaan diri, teknik presentasi memukau, dan kepemimpinan bagi mahasiswa baru.', 'BEM Fakultas', 1, '2027-01-08', '08:30:00', 'Hall Student Center Lt. 2', 100),
(9, 'UI/UX Design Challenge 2027', 'Lomba merancang antarmuka aplikasi mobile dan web dengan studi kasus solusi permasalahan lingkungan kampus.', 'Himpunan Mahasiswa D3/D4', 3, '2027-01-18', '09:00:00', 'Gedung Direktorat Lt. 3', 60),
(10, 'Workshop Database Optimization with MySQL', 'Sesi praktik mengoptimalkan query SQL, pembuatan index, dan penanganan database berskala besar.', 'Komunitas Database Indonesia', 1, '2027-02-02', '13:00:00', 'Lab Basis Data Lt. 3', 50),
(11, 'Career Expo & Company Gathering 2027', 'Bursa kerja kampus yang menghadirkan 20+ perusahaan IT ternama untuk walk-in interview dan pendaftaran magang.', 'CDC / Career Center Kampus', 2, '2027-02-15', '08:00:00', 'Gedung Serba Guna (GSG)', 300);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registrationId` int NOT NULL,
  `userId` int NOT NULL,
  `eventId` int NOT NULL,
  `registrationDate` date NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `attendanceStatus` varchar(30) DEFAULT NULL,
  `ticketId` int DEFAULT NULL,
  `ticketCode` varchar(50) DEFAULT NULL,
  `issuedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registrationId`, `userId`, `eventId`, `registrationDate`, `status`, `attendanceStatus`, `ticketId`, `ticketCode`, `issuedAt`) VALUES
(1, 1, 1, '2026-10-16', 'Registered', 'Pending', NULL, 'CH-0001-8392', '2026-10-16 22:00:03'),
(3, 1, 2, '2026-10-16', 'Registered', 'Pending', NULL, 'CH-0002-4985', '2026-10-16 15:07:37'),
(4, 1, 5, '2026-10-19', 'Registered', 'Pending', NULL, 'CH-0005-3784', '2026-10-19 06:25:57'),
(5, 1, 4, '2026-10-19', 'Registered', 'Pending', NULL, 'CH-0004-3882', '2026-10-19 06:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `studentId` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fullName`, `email`, `studentId`, `password`) VALUES
(1, 'Ujang pratama', 'ujangganteng@gmail.com', '2507412020', 'ujangaja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registrationId`),
  ADD UNIQUE KEY `ticketCode` (`ticketCode`),
  ADD KEY `userId` (`userId`),
  ADD KEY `eventId` (`eventId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registrationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `event` (`eventId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
