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
-- Table structure for table `articulo`
--
DROP TABLE IF EXISTS `articulo`;
CREATE TABLE IF NOT EXISTS `articulo` (
  `CodigoA` int(11) NOT NULL ,
  `AutoresA` varchar(200)  COLLATE latin1_spanish_ci NOT NULL ,
  `TituloA` varchar(100) COLLATE latin1_spanish_ci NOT NULL  ,
  `TituloR` varchar(100) COLLATE latin1_spanish_ci NOT NULL ,
  `ISSN` varchar(13) COLLATE latin1_spanish_ci NOT NULL  ,
  `VolumenR` varchar(4) COLLATE latin1_spanish_ci NOT NULL ,
  `PagIniA` int(4) NOT NULL ,
  `PagFinA` int(4) NOT NULL ,
  `FechaPublicacionR` date NOT NULL ,
  `EstadoA` enum('Enviado','Revision','Publicado') NOT NULL ,
  PRIMARY KEY (`CodigoA`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `congreso`
--
DROP TABLE IF EXISTS `congreso`;
CREATE TABLE IF NOT EXISTS `congreso` (
  `CodigoC` int(11)  NOT NULL ,
  `NombreC` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `AcronimoC` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
  `AnhoC` date NOT NULL ,
  `LugarC` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
  `AdjuntoC` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`CodigoC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estancia`
--
DROP TABLE IF EXISTS `estancia`;
CREATE TABLE IF NOT EXISTS `estancia` (
  `CodigoE` int(11) NOT NULL ,
  `CentroE` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `UniversidadE` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `PaisE` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaInicioE` date NOT NULL ,
  `FechaFinE` date NOT NULL ,
  `TipoE` enum('Investigacion','Doctorado','Invitado') NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
   `AdjuntoE` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`CodigoE`),
  KEY `FK_ESTANCIA_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `estancia`:
--   `LoginU`
--       `docente` -> `LoginU`
--

-- --------------------------------------------------------

--
-- Table structure for table `tesis`
--
DROP TABLE IF EXISTS `tesis`;
CREATE TABLE IF NOT EXISTS `tesis` (
  `CodigoTesis` varchar(10)COLLATE latin1_spanish_ci NOT NULL ,
  `AutorTesis` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaInscripcion` date NOT NULL ,
  `FechaLectura` date NOT NULL ,
  `CalificacionTesis` enum('Aprobado','Notable','Sobresaliente','Matricula') NOT NULL,
  `URLTesis` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
   `AdjuntoT` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`CodigoTesis`),
  KEY `FK_TESIS_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `tesis`:
--   `LoginU`
--       `docente` -> `LoginU`
--

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--
DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `CodigoL` int(11) NOT NULL ,
  `AutoresL` varchar(200)COLLATE latin1_spanish_ci NOT NULL ,
  `TituloL` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `ISBN` varchar(13)COLLATE latin1_spanish_ci NOT NULL ,
  `PagIniL` varchar(4)COLLATE latin1_spanish_ci NOT NULL,
  `PagFinL` varchar(4)COLLATE latin1_spanish_ci NOT NULL,
  `VolumenL` varchar(4)COLLATE latin1_spanish_ci NOT NULL,
  `EditorialL` varchar(100)COLLATE latin1_spanish_ci NOT NULL,
  `FechaPublicacionL` date NOT NULL ,
  `EditorL` varchar(100)COLLATE latin1_spanish_ci NOT NULL,
  `PaisEdicionL` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
    PRIMARY KEY (`CodigoL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `proyectoDirigido`
--
DROP TABLE IF EXISTS `proyectodirigido`;
CREATE TABLE IF NOT EXISTS `proyectoDirigido` (
  `CodigoPD` varchar(10)COLLATE latin1_spanish_ci NOT NULL ,
  `TituloPD` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `AlumnoPD` varchar(40)COLLATE latin1_spanish_ci NOT NULL,
  `FechaLecturaPD` date NOT NULL,
  `CalificacionPD` enum('Aprobado','Notable','Sobresaliente','Matricula') NOT NULL,
  `URLPD` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `CotutorPD` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `TipoPD` enum('PFC','TFG','TFM') NOT NULL,
  `AdjuntoPD` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
    PRIMARY KEY (`CodigoPD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `ponencia`
--
DROP TABLE IF EXISTS `ponencia`;
CREATE TABLE IF NOT EXISTS `ponencia` (
  `CodigoP` int(11) NOT NULL ,
  `AutoresP` varchar(200)COLLATE latin1_spanish_ci NOT NULL ,
  `TituloP` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `CongresoP` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaIniCP` date NOT NULL ,
  `FechaFinCP` date NOT NULL ,
  `LugarCP` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
  `PaisCP` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
   PRIMARY KEY (`CodigoP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proyecto`
--
DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `CodigoProy` int(11) NOT NULL ,
  `TituloProy` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `EntidadFinanciadora` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `AcronimoProy` varchar(20)COLLATE latin1_spanish_ci NOT NULL ,
  `AnhoInicioProy` year(4) NOT NULL ,
  `AnhoFinProy` year(4) NOT NULL ,
  `Importe` int(11) NOT NULL ,
   `AdjuntoProy` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
     PRIMARY KEY (`CodigoProy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tad`
--
DROP TABLE IF EXISTS `tad`;
CREATE TABLE IF NOT EXISTS `tad` (
  `CodigoTAD` varchar(10)COLLATE latin1_spanish_ci NOT NULL ,
  `TituloTAD` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `AlumnoTAD` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaLecturaTAD` date NOT NULL,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
   `AdjuntoTAD` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
   PRIMARY KEY (`CodigoTad`),
  KEY `FK_TAD_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `tad`:
--   `LoginU`
--       `docente` -> `LoginU`
--


-- --------------------------------------------------------


--
-- Table structure for table `materia`
--
DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `CodigoM` varchar(10)COLLATE latin1_spanish_ci NOT NULL,
  `TipoM` enum('Grado','Tercer Ciclo','Curso','Master','Postgrado') NOT NULL  ,
  `TipoParticipacionM` enum('Docente','Director') NOT NULL ,
  `DenominacionM` varchar(100) NOT NULL ,
  `TitulacionM` varchar(100) NOT NULL ,
  `AnhoAcademicoM` varchar(11) NOT NULL ,
  `CreditosM` int(3) NOT NULL ,
  `CuatrimestreM` enum('Primero','Segundo','Anual') NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
   `AdjuntoM` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY  (`CodigoM`),
   KEY `FK_MATERIA_USUARIO` (`LoginU`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- RELACIONES PARA LA TABLA `materia`:
--   `LoginU`
--       `docente` -> `LoginU`
--



-- --------------------------------------------------------

--
-- Table structure for table `technicalreport`
--
DROP TABLE IF EXISTS `technicalreport`;
CREATE TABLE IF NOT EXISTS `technicalreport` (
  `CodigoTR` int(11) NOT NULL ,
  `TituloTR` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `DepartamentoTR` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `UniversidadTR` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaTR` date NOT NULL ,
   PRIMARY KEY (`CodigoTR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  `PasswordU` varchar(32)COLLATE latin1_spanish_ci NOT NULL ,
  `NombreU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  `ApellidosU` varchar(30)COLLATE latin1_spanish_ci NOT NULL ,
  `Telefono` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  `Mail` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `DNI` varchar(10)COLLATE latin1_spanish_ci NOT NULL ,
  `FechaNacimiento` date NOT NULL,
  `TipoContrato` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `Centro` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `Departamento` varchar(100)COLLATE latin1_spanish_ci NOT NULL ,
  `TipoUsuario` enum('U','A') NOT NULL default 'U',
   PRIMARY KEY (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` VALUES ('admin', MD5('admin'), 'Administrador', '','','','','','','','','A');


--
-- --------------------------------------------------------

--
-- Table structure for table `universidad`
--
DROP TABLE IF EXISTS `universidad`;
CREATE TABLE IF NOT EXISTS `universidad` (
  `NombreUniversidad` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
   `FechaInicio` date NOT NULL ,
    `FechaFin` date NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
 PRIMARY KEY (`NombreUniversidad`,`FechaInicio`,`LoginU`),
  KEY `FK_UNIVERSIDAD_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- RELACIONES PARA LA TABLA `universidad`:
--   `LoginU`
--       `usuario` -> `LoginU`


-- --------------------------------------------------------

--
-- Table structure for table `autor`
--
DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `CodigoAutor` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAutor` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
 PRIMARY KEY (`CodigoAutor`),
  KEY `FK_AUTOR_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Table structure for table `titulo_academico`
--
DROP TABLE IF EXISTS `titulo_academico`;
CREATE TABLE IF NOT EXISTS `titulo_academico` (
  `NombreTitulo` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
  `CentroTitulo` varchar(40)COLLATE latin1_spanish_ci NOT NULL ,
   `FechaTitulo` date NOT NULL default '0000-00-00',
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  PRIMARY KEY (`NombreTitulo`,`LoginU`),
  KEY `FK_TITULO_ACADEMICO_USUARIO` (`LoginU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- RELACIONES PARA LA TABLA `universidad`:
--   `LoginU`
--       `usuario` -> `LoginU`
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `docente_congreso`
--
DROP TABLE IF EXISTS `docente_congreso`;
CREATE TABLE IF NOT EXISTS `docente_congreso` (
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  `CodigoC` int(11) NOT NULL ,
  `TipoParticipacionC` enum('MCO','MCC','R','C','PCO','PCC') NOT NULL ,
   PRIMARY KEY (`LoginU`,`CodigoC`),
  KEY `FK_DOCENTE_CONGRESO_USUARIO` (`LoginU`),
  KEY `FK_DOCENTE_CONGRESO_CONGRESO` (`CodigoC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `docente_congreso`:
--   `LoginU`
--       `usuario` -> `LoginU`
--     `CodigoC`
--       `congreso` -> `CodigoC`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `docente_proyectoDirigido`
--
DROP TABLE IF EXISTS `docente_proyectodirigido`;
CREATE TABLE IF NOT EXISTS `docente_proyectoDirigido` (
  `CodigoPD` varchar(10)COLLATE latin1_spanish_ci NOT NULL ,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
   PRIMARY KEY (`CodigoPD`,`LoginU`),
  KEY `FK_DOCENTE_PD_USUARIO` (`LoginU`),
  KEY `FK_DOCENTE_PD_PD` (`CodigoPD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `docente_proyectoDirigido`:
--   `LoginU`
--       `usuario` -> `LoginU`
--     `CodigoPD`
--       `proyectoDirigido` -> `CodigoPD`
--

-- --------------------------------------------------------

--
-- Table structure for table `docente_proyecto`
--
DROP TABLE IF EXISTS `docente_proyecto`;
CREATE TABLE IF NOT EXISTS `docente_proyecto` (
  `CodigoProy` int(11) NOT NULL,
  `LoginU` varchar(15)COLLATE latin1_spanish_ci NOT NULL ,
  `TipoParticipacionProy` enum('Investigador','Investigador Principal') NOT NULL ,
   PRIMARY KEY (`CodigoProy`,`LoginU`),
    KEY `FK_DOCENTE_PROYECTO_PROYECTO` (`CodigoProy`),
  KEY `FK_DOCENTE_PROYECTO_USUARIO` (`LoginU`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `docente_proyecto`:
--   `LoginU`
--       `usuario` -> `LoginU`
--     `CodigoProy`
--       `proyecto` -> `CodigoProy`
--
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `autor_libro`
--
DROP TABLE IF EXISTS `autor_libro`;
CREATE TABLE IF NOT EXISTS `autor_libro` (
  `CodigoL` int(11) NOT NULL ,
  `CodigoAutor` int(11) NOT NULL ,
   PRIMARY KEY (`CodigoL`,`CodigoAutor`),
  KEY `FK_AUTOR_LIBRO_LIBRO` (`CodigoL`),
  KEY `FK_AUTOR_LIBRO_AUTOR` (`CodigoAutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `autor_libro`:
--   `CodigoL`
--       `libro` -> `CodigoL`
--     `CodigoAutor`
--       `autor` -> `CodigoAutor`
--
--
-- --------------------------------------------------------

--
-- Table structure for table `autor_technicalreport`
--
DROP TABLE IF EXISTS `autor_technicalreport`;
CREATE TABLE IF NOT EXISTS `autor_technicalreport` (
  `CodigoTR` int(11) NOT NULL ,
  `CodigoAutor` int(11) NOT NULL ,
   PRIMARY KEY (`CodigoTR`,`CodigoAutor`),
  KEY `FK_AUTOR_TR_TR` (`CodigoTR`),
  KEY `FK_AUTOR_TR_AUTOR` (`CodigoAutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `autor_technicalreport`:
--   `CodigoTR`
--       `technicalreport` -> `CodigoTR`
--     `CodigoAutor`
--       `autor` -> `CodigoAutor`
--
--
--
-- --------------------------------------------------------

--
-- Table structure for table `autor_ponencia`
--
DROP TABLE IF EXISTS `autor_ponencia`;
CREATE TABLE IF NOT EXISTS `autor_ponencia` (
  `CodigoP` int(11) NOT NULL ,
  `CodigoAutor` int(11) NOT NULL ,
   PRIMARY KEY (`CodigoP`,`CodigoAutor`),
  KEY `FK_AUTOR_PONENCIA_PONENCIA` (`CodigoP`),
  KEY `FK_AUTOR_PONENCIA_AUTOR` (`CodigoAutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `autor_ponencia`:
--   `CodigoP`
--       `ponencia` -> `CodigoP`
--     `CodigoAutor`
--       `autor` -> `CodigoAutor`
--
--
-- --------------------------------------------------------

--
-- Table structure for table `autor_articulo`
--
DROP TABLE IF EXISTS `autor_articulo`;
CREATE TABLE IF NOT EXISTS `autor_articulo` (
  `CodigoA` int(11) NOT NULL ,
  `CodigoAutor` int(11) NOT NULL ,
   PRIMARY KEY (`CodigoA`,`CodigoAutor`),
  KEY `FK_AUTOR_ARTICULO_ARTICULO` (`CodigoA`),
  KEY `FK_AUTOR_ARTICULO_AUTOR` (`CodigoAutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
--
-- RELACIONES PARA LA TABLA `autor_articulo`:
--   `CodigoA`
--       `articulo` -> `CodigoA`
--     `CodigoAutor`
--       `autor` -> `CodigoAutor`
--
-- --------------------------------------------------------


--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuario_articulo`
--

CREATE TABLE `usuario_articulo` (
  `CodigoA` int(11) NOT NULL,
  `LoginU` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Restricciones para tablas volcadas
--

ALTER TABLE `usuario_articulo`
  ADD PRIMARY KEY (`CodigoA`,`LoginU`),
  ADD KEY `FK_USUARIO_ARTICULO_ARTICULO` (`CodigoA`),
  ADD KEY `FK_USUARIO_ARTICULO_USUARIO` (`LoginU`);

--
-- Filtros para la tabla `tesis`
--
ALTER TABLE `tesis`
  ADD CONSTRAINT `FK_TESIS_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);

--
-- Filtros para la tabla `estancia`
--
ALTER TABLE `estancia`
  ADD CONSTRAINT `FK_ESTANCIA_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);

--
-- Filtros para la tabla `tad`
--
ALTER TABLE `tad`
  ADD CONSTRAINT `FK_TAD_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);
--
--

-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
 ADD CONSTRAINT `FK_MATERIA_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);
--
-- Filtros para la tabla `universidad`
--
--
ALTER TABLE `universidad`
  ADD CONSTRAINT `FK_UNIVERSIDAD_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);
--
-- Filtros para la tabla `titulo_academico`
--
--
ALTER TABLE `titulo_academico`
 ADD CONSTRAINT `FK_TITULO_ACADEMICO_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`);

--
-- Filtros para la tabla `docente_congreso`
--
ALTER TABLE `docente_congreso`
  ADD CONSTRAINT `FK_DOCENTE_CONGRESO_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`),
  ADD CONSTRAINT `FK_DOCENTE_CONGRESO_CONGRESO` FOREIGN KEY (`CodigoC`) REFERENCES `congreso` (`CodigoC`);



--
-- Filtros para la tabla `docente_proyectoDirigido`
--
ALTER TABLE `docente_proyectodirigido`
  ADD CONSTRAINT `FK_DOCENTE_PD_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`) ,
  ADD CONSTRAINT `FK_DOCENTE_PD_PD` FOREIGN KEY (`CodigoPD`) REFERENCES `proyectodirigido` (`CodigoPD`);



--
-- Filtros para la tabla `docente_proyecto`
--

ALTER TABLE `docente_proyecto`
  ADD CONSTRAINT `FK_DOCENTE_PROYECTO_PROYECTO` FOREIGN KEY (`CodigoProy`) REFERENCES `proyecto` (`CodigoProy`),
  ADD CONSTRAINT `FK_DOCENTE_PROYECTO_USUARIO` FOREIGN KEY (`LoginU`) REFERENCES `usuario` (`LoginU`) ;



-- Filtros para la tabla `autor_libro`
--
ALTER TABLE `autor_libro`
  ADD CONSTRAINT `FK_AUTOR_LIBRO_LIBRO` FOREIGN KEY (`CodigoL`) REFERENCES `libro` (`CodigoL`),
  ADD CONSTRAINT `FK_AUTOR_LIBRO_AUTOR` FOREIGN KEY (`CodigoAutor`) REFERENCES `autor` (`CodigoAutor`);
    --
-- Filtros para la tabla `autor_technicalreport`
--
ALTER TABLE `autor_technicalreport`
  ADD CONSTRAINT `FK_AUTOR_TR_TR` FOREIGN KEY (`CodigoTR`) REFERENCES `technicalreport` (`CodigoTR`),
  ADD CONSTRAINT `FK_AUTOR_TR_AUTOR` FOREIGN KEY (`CodigoAutor`) REFERENCES `autor` (`CodigoAutor`);

-- Filtros para la tabla `autor_ponencia`
--
ALTER TABLE `autor_ponencia`
  ADD CONSTRAINT `FK_AUTOR_PONENCIA_PONENCIA` FOREIGN KEY (`CodigoP`) REFERENCES `ponencia` (`CodigoP`),
  ADD CONSTRAINT `FK_AUTOR_PONENCIA_AUTOR` FOREIGN KEY (`CodigoAutor`) REFERENCES `autor` (`CodigoAutor`);

-- Filtros para la tabla `autor_articulo`
--
ALTER TABLE `autor_articulo`
  ADD CONSTRAINT `FK_AUTOR_ARTICULO_ARTICULO` FOREIGN KEY (`CodigoA`) REFERENCES `articulo` (`CodigoA`),
  ADD CONSTRAINT `FK_AUTOR_ARTICULO_AUTOR` FOREIGN KEY (`CodigoAutor`) REFERENCES `autor` (`CodigoAutor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;