-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 04:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diabetes`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `scale_category` enum('usia','gender','pendapatan','pendidikan','general','kesehatan','kesehatan_mental') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `scale_category`) VALUES
(1, 'Apakah Anda seorang perokok?', 'general'),
(2, 'Apakah Anda pengonsumsi alkohol?', 'general'),
(3, 'Apakah Anda memiliki tekanan darah tinggi?', 'general'),
(4, 'Apakah Anda memiliki kolestrol tinggi?', 'general'),
(5, 'Apakah Anda pernah mengalami stroke?', 'general'),
(6, 'Apakah Anda pernah memeriksa kadar kolesterol Anda dalam lima tahun terakhir?', 'general'),
(7, 'Apakah Anda pernah mengalami penyakit jantung atau memiliki penyakit jantung?', 'general'),
(8, 'Dalam 12 bulan terakhir, apakah ada saat di mana Anda membutuhkan layanan dokter tetapi tidak dapat memenuhinya karena alasan biaya?', 'general'),
(9, 'Apakah Anda memiliki asuransi layanan kesehatan?  (BPJS, dan sebagainya)', 'general'),
(10, 'Apakah Anda rutin melakukan aktivitas fisik dalam sebulan terakhir?', 'general'),
(11, 'Apakah Anda mengalami kesulitan berjalan atau mobilitas?', 'general'),
(12, 'Apakah Anda mengonsumsi buah setiap hari?', 'general'),
(13, 'Apakah Anda mengonsumsi sayuran setiap hari?', 'general'),
(14, 'Secara umum, bagaimana Anda menilai kondisi kesehatan Anda?', 'kesehatan'),
(15, 'Berapakah rentang pendapatan anda?', 'pendapatan'),
(16, 'Dalam sebulan terakhir, berapa hari Anda merasa kesehatan mental Anda terganggu?', 'kesehatan_mental'),
(17, 'Dalam sebulan terakhir, berapa hari Anda mengalami sakit fisik atau cedera?', 'kesehatan_mental');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `probability` float(10,2) DEFAULT NULL,
  `risk_level` varchar(50) DEFAULT NULL,
  `prediction` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scales`
--

CREATE TABLE `scales` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `value` int(11) NOT NULL,
  `category` enum('usia','gender','pendapatan','pendidikan','general','kesehatan','kesehatan_mental') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scales`
--

INSERT INTO `scales` (`id`, `description`, `value`, `category`) VALUES
(1, '18-24', 1, 'usia'),
(2, '25-29', 2, 'usia'),
(3, '30-34', 3, 'usia'),
(4, '35-39', 4, 'usia'),
(5, '40-44', 5, 'usia'),
(6, '45-49', 6, 'usia'),
(7, '50-54', 7, 'usia'),
(8, '55-59', 8, 'usia'),
(9, '60-64', 9, 'usia'),
(10, '65-69', 10, 'usia'),
(11, '70-75', 11, 'usia'),
(12, '76-79', 12, 'usia'),
(13, '80-200', 13, 'usia'),
(14, 'Perempuan', 0, 'gender'),
(15, 'Laki-Laki', 1, 'gender'),
(16, 'Tidak', 0, 'general'),
(17, 'Ya', 1, 'general'),
(18, 'Tidak Sekolah', 1, 'pendidikan'),
(19, 'SD', 2, 'pendidikan'),
(20, 'SMP', 3, 'pendidikan'),
(21, 'SMA', 4, 'pendidikan'),
(22, 'Diploma', 5, 'pendidikan'),
(23, 'Sarjana', 6, 'pendidikan'),
(24, 'Sangat Baik', 1, 'kesehatan'),
(25, 'Baik', 2, 'kesehatan'),
(26, 'Cukup', 3, 'kesehatan'),
(27, 'Buruk', 4, 'kesehatan'),
(28, 'Sangat Buruk', 5, 'kesehatan'),
(29, '< Rp 1.000.000', 1, 'pendapatan'),
(30, 'Rp 1.000.000 - < Rp 2.000.000', 2, 'pendapatan'),
(31, 'Rp 2.000.000 - < Rp 3.000.000', 3, 'pendapatan'),
(32, 'Rp 3.000.000 - < Rp 4.000.000', 4, 'pendapatan'),
(33, 'Rp 4.000.000 - < Rp 5.000.000', 5, 'pendapatan'),
(34, 'Rp 5.000.000 - < Rp 6.000.000', 6, 'pendapatan'),
(35, 'Rp 6.000.000 - < Rp 7.000.000', 7, 'pendapatan'),
(36, '> Rp 7.000.000', 8, 'pendapatan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `usia` int(11) NOT NULL,
  `usia_scale_id` int(11) DEFAULT NULL,
  `tinggi` decimal(5,2) NOT NULL,
  `berat` decimal(5,2) NOT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `gender_scale_id` int(11) DEFAULT NULL,
  `asal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `pendidikan_scale_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `scales`
--
ALTER TABLE `scales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usia_scale_id` (`usia_scale_id`),
  ADD KEY `gender_scale_id` (`gender_scale_id`),
  ADD KEY `pendidikan_scale_id` (`pendidikan_scale_id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `scales`
--
ALTER TABLE `scales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=917;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`usia_scale_id`) REFERENCES `scales` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`gender_scale_id`) REFERENCES `scales` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
