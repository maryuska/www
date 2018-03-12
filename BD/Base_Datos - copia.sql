-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2007 at 04:03 PM
-- Server version: 4.1.12
-- PHP Version: 5.0.4
-- VersiÃ³n del servidor: 5.6.17
-- VersiÃ³n de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datos_curriculares`
--
DROP  DATABASE IF EXISTS`datos_curriculares`;
CREATE DATABASE IF NOT EXISTS`datos_curriculares` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `datos_curriculares`;

-- --------------------------------------------------------

--
-- usuario root contraseña root
--

grant all privileges on `datos_curriculares`.* to 'docente'@'localhost'
     identified by 'docente' with grant option;
 flush privileges;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL default '',
  `PasswordU` varchar(32)COLLATE latin1_spanish_ci NOT NULL default '',
  `NombreU` varchar(15)COLLATE latin1_spanish_ci NOT NULL default '',
  `ApellidosU` varchar(30)COLLATE latin1_spanish_ci NOT NULL default '',

  `TipoContrato` varchar(40)COLLATE latin1_spanish_ci NOT NULL default '',
  `Centro` varchar(100)COLLATE latin1_spanish_ci NOT NULL default '',
  `Departamento` varchar(100)COLLATE latin1_spanish_ci NOT NULL default '',
   PRIMARY KEY (`LoginU`)


) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuario`
--

-- --------------------------------------------------------

--
-- Table structure for table `universidad`
--
DROP TABLE IF EXISTS `universidad`;
CREATE TABLE IF NOT EXISTS `universidad` (
  `NombreUniversidad` varchar(40)COLLATE latin1_spanish_ci NOT NULL default '',
   `FechaInicio` date NOT NULL default '0000-00-00',
    `FechaFin` date NOT NULL default '0000-00-00',
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL default '',
 PRIMARY KEY (`NombreUniversidad`,`FechaInicio`,`LoginU`),
  KEY `FK_UNIVERSIDAD_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- RELACIONES PARA LA TABLA `universidad`:
--   `LoginU`
--       `usuario` -> `LoginU`

--
-- Table structure for table `titulo_academico`
--
DROP TABLE IF EXISTS `titulo_academico`;
CREATE TABLE IF NOT EXISTS `titulo_academico` (
  `NombreTitulo` varchar(40)COLLATE latin1_spanish_ci NOT NULL default '',
  `CentroTitulo` varchar(40)COLLATE latin1_spanish_ci NOT NULL default '',
   `FechaTitulo` date NOT NULL default '0000-00-00',
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY (`NombreTitulo`,`LoginU`),
  KEY `FK_TITULO_ACADEMICO_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD CONSTRAINT `universidad_ibfk_1` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);
--
-- Filtros para la tabla `titulo_academico`
--
ALTER TABLE `titulo_academico`
  ADD CONSTRAINT `titulo_academico_ibfk_1` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);
  
  
INSERT INTO `usuario` VALUES ('admin', 'e0b7feb3cf3e7d177da400774de0af5b', 'Administrador', '','','','');


