-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 04:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto_ing_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `programacion_usuario`
--

CREATE TABLE `programacion_usuario` (
  `idProgramacion` int(11) NOT NULL,
  `diaSemanaOrganicos` varchar(15) DEFAULT NULL,
  `diaSemanaInorganicos1` varchar(15) DEFAULT NULL,
  `diaSemanaInorganicos2` varchar(15) DEFAULT NULL,
  `diaMesPeligrosos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programacion_usuario`
--

INSERT INTO `programacion_usuario` (`idProgramacion`, `diaSemanaOrganicos`, `diaSemanaInorganicos1`, `diaSemanaInorganicos2`, `diaMesPeligrosos`) VALUES
(1, 'Lunes', 'Martes', NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idCargo` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idCargo`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Empresa');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `puntosAcumulados` int(11) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `idProgramacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `direccion`, `telefono`, `email`, `puntosAcumulados`, `idCargo`, `clave`, `idProgramacion`) VALUES
(12, 'Empresa abc', 'Abcd', '1234567', 'empresa', 0, 3, '1234', NULL),
(125, 'Adminus', 'Abcd', '1234567', 'Adminus', 0, 1, '1234', NULL),
(1234, 'qasd asd', 'asd asd', '123', 'asd', 0, 2, '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `programacion_usuario`
--
ALTER TABLE `programacion_usuario`
  ADD PRIMARY KEY (`idProgramacion`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idCargo` (`idCargo`),
  ADD KEY `fk_programacion_usuario` (`idProgramacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `programacion_usuario`
--
ALTER TABLE `programacion_usuario`
  MODIFY `idProgramacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_programacion_usuario` FOREIGN KEY (`idProgramacion`) REFERENCES `programacion_usuario` (`idProgramacion`),
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idCargo`) REFERENCES `rol` (`idCargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
