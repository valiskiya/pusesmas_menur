-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 12:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staf') DEFAULT 'staf',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin@puskesmas.com', '$2y$12$ObGJ8PNKioG4C7H/EizlS.g9Pu.Dr.3Clm1eVpcQhvSOl7VhFLC.O', 'admin', '2025-12-18 02:30:26'),
(2, 'coba', 'coba@gmail.com', '$2y$12$4LbVAVKp2KiD1m0PJwPHJeVet.j.UQlK1XenguVJ84panj36j.XfO', 'staf', '2025-12-22 16:37:38'),
(3, 'Hasbi Ash Shiddiqi', 'hasbiashiddiqi735@gmail.com', '$2y$12$RbJ9gUkNaYqmPqvsNa01BOXxpOVPIoSwAWdA/Zh5IViRvPK7bJp.u', 'staf', '2025-12-22 16:43:28'),
(4, 'Zilva Liskiyah', 'zilva@gmail.com', '$2y$12$GqKDmiQoXij0cH5P2PumQetRNEUo.8E8HUgRUlJlpq0CCLFSusyy2', 'staf', '2025-12-24 04:05:11'),
(5, 'Hasbi Ash Shiddiqi', 'hasbiashiddiqi375@gmail.com', '$2y$12$CN5SDKfueZX7rJ7AL5rOj.4NnosXtOZ2kI9DUetPt0vRoVXnh4ajO', 'staf', '2026-01-05 08:58:53'),
(6, 'admin', 'admin@gmail.com', '$2y$12$ovb9UI0niLllHxV1m.G3nu2aKftSqnz.X4fOisU5AJN2v3XoOW2VK', 'staf', '2026-03-31 10:07:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
