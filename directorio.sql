/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- All the data generated is fake

CREATE DATABASE `directorio`;
use `directorio`;

DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono_movil` int(9) DEFAULT NULL,
  `extension` int(4) DEFAULT NULL,
  `idArea` int(10) DEFAULT NULL,
  `telefono_fijo` int(9) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `idArea` (`idArea`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `passwd` char(64) NOT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'usuario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `area` (`Id`, `nombre_area`) VALUES
(1, 'Administración'),
(2, 'Dirección General'),
(3, 'Arte y Cultura'),
(4, 'Deportes y Recreación'),
(5, 'Comunicaciones'),
(6, 'Desarrollo Juvenil'),
(7, 'Identidad Corporativa'),
(8, 'Responsabilidad Social'),
(9, 'Tecnología de la Información'),
(10, 'Gestión Humana'),
(11, 'Diseño Creativo'),
(12, 'Centro de Documentación'),
(13, 'Animación Sociocultural'),
(14, 'Mantenimiento e Infraestructura'),
(15, 'Producción de Eventos'),
(16, 'Educación Artística'),
(17, 'Centro Cultural');

INSERT INTO `empleados` (`Id`, `nombre_apellidos`, `email`, `telefono_movil`, `extension`, `idArea`, `telefono_fijo`) VALUES
(104, 'Laura Martínez González', 'lmartinez@ejemplo.org', 612345678, 108, 6, 928754800),
(105, 'Carlos Ruiz Fernández', 'deportes@ejemplo.org', NULL, 208, 4, 928795280),
(106, 'Ana López Pérez', 'musica@ejemplo.org', NULL, 107, 16, 928754800),
(107, 'David Sánchez Jiménez', 'cultura@ejemplo.es', 648499211, 104, 3, 928754800),
(108, 'Elena García Martín', 'egarcia@ejemplo.org', NULL, NULL, 4, 928758877),
(109, 'Pablo Gómez Díaz', 'pgomez@ejemplo.org', NULL, NULL, 5, 928750182),
(110, 'Sofía Hernández López', 'shernandez@ejemplo.org', NULL, NULL, 4, 928122042),
(111, 'Javier Moreno Romero', 'jmoreno@ejemplo.org', NULL, NULL, 4, 928795280),
(112, 'Marta Jiménez Navarro', 'mjimenez@ejemplo.org', NULL, NULL, 12, 928759526),
(113, 'Alberto Torres Ruiz', 'atorres@ejemplo.org', NULL, NULL, 12, 928759526),
(114, 'Isabel Castro Méndez', 'musica.moderna@ejemplo.org', NULL, 107, 16, 928754800),
(115, 'Ricardo Vargas Soto', 'direccion.artistica@ejemplo.es', NULL, 107, 16, 928754800),
(116, 'Patricia Núñez Gil', 'pnunez@ejemplo.org', NULL, NULL, 13, 928793614),
(117, 'Fernando Blanco Cortés', 'fblanco@ejemplo.org', NULL, NULL, 13, 928793614),
(118, 'Silvia Ortega Medina', 'sortega@ejemplo.org', NULL, NULL, 4, 928758877),
(119, 'Óscar Marín Ríos', 'omarin@ejemplo.org', NULL, NULL, 4, 928794380),
(120, 'Nuria Cabrera Vega', 'ncabrera@ejemplo.org', NULL, NULL, 14, NULL),
(121, 'Héctor Delgado Mora', 'hdelgado@ejemplo.org', NULL, NULL, 14, NULL),
(122, 'Claudia Molina Santos', 'cmolina@ejemplo.org', NULL, NULL, 17, 928754800),
(123, 'Adrián Peña León', 'apeña@ejemplo.es', NULL, 103, 17, 928754800),
(124, 'Raquel Serrano Fuentes', 'rserrano@ejemplo.org', NULL, 210, 4, 928795280),
(125, 'Diego Campos Gil', 'dcampos@ejemplo.es', NULL, 101, 17, 928754800),
(126, 'Eva Rojas Mendoza', 'erojas@ejemplo.org', NULL, 116, 17, 928754800),
(127, 'Víctor Medina Cruz', 'vmedina@ejemplo.org', NULL, NULL, 4, 928122042),
(128, 'Cristina Vega Pardo', 'cvega@ejemplo.org', NULL, NULL, 4, 928795280),
(129, 'Rubén Soto Carrasco', 'rsoto@ejemplo.org', NULL, NULL, 12, 928759526),
(130, 'Natalia Guerrero Muñoz', 'nguerrero@ejemplo.org', NULL, NULL, NULL, NULL),
(131, 'Ángel Cortés Montes', 'acortes@ejemplo.org', NULL, NULL, 14, 928795280),
(132, 'Lorena Ferrer Calvo', 'lferrer@ejemplo.org', NULL, NULL, 17, 928754800),
(133, 'Manuel Robles Navarro', 'mrobles@ejemplo.com', NULL, 105, 17, 928754800),
(134, 'Sara Reyes Mora', 'sreyes@ejemplo.org', NULL, NULL, 17, 928754800),
(135, 'Jorge Navarro Castro', 'jnavarro@ejemplo.org', 690944585, 111, 9, 928754800),
(136, 'Francisco Javier Mora Soto', 'fmora@ejemplo.org', NULL, NULL, 3, 928755887),
(137, 'Beatriz León Rivas', 'bleon@ejemplo.org', NULL, NULL, 5, 928751006),
(138, 'Antonio José Gil Méndez', 'ajgil@ejemplo.com', NULL, 105, 11, 928754800),
(139, 'Marina Díaz Ortega', 'mdiaz@ejemplo.es', NULL, NULL, 12, 928759526),
(140, 'Lucía Romero Peña', 'lromero@ejemplo.org', NULL, NULL, 16, 928754800),
(141, 'Miguel Ángel Santos Rueda', 'msantos@ejemplo.org', NULL, NULL, NULL, 928758877),
(142, 'Carmen Esteban López', 'cesteban@ejemplo.org', NULL, NULL, 5, 928750182),
(143, 'Alejandro Gutiérrez Marín', 'instrumentos@ejemplo.org', NULL, 107, 16, 928754800),
(144, 'Rosa María Gil Soto', 'rgil@ejemplo.org', NULL, NULL, 14, NULL),
(145, 'Juan Carlos Medina Ruiz', 'jcmedina@ejemplo.org', NULL, 210, 4, 928795280),
(146, 'Teresa Blanco García', 'tblanco@ejemplo.org', NULL, NULL, 12, 928759526),
(147, 'Pedro José Martínez López', 'pjmartinez@ejemplo.org', NULL, NULL, 14, NULL),
(148, 'Alfonso Ruiz Mendoza', 'aruiz@ejemplo.org', NULL, NULL, 4, 928122042),
(149, 'Susana García Navarro', 'sgarcia@ejemplo.org', NULL, NULL, 4, 928758877),
(150, 'Joaquín Fernández Castro', 'jfernandez@ejemplo.es', 690944585, 111, 9, 928754800),
(151, 'Mariano López Gómez', 'mlopez@ejemplo.org', NULL, NULL, 14, NULL),
(152, 'Elena María Ruiz Díaz', 'teatro@ejemplo.es', NULL, 102, 16, 928754800),
(153, 'Francisco Javier Soto Méndez', 'violin@ejemplo.org', NULL, 107, 16, 928754800),
(154, 'Juan Antonio García Pérez', 'jagarcia@ejemplo.org', NULL, NULL, 14, NULL),
(155, 'José Manuel Torres Ruiz', 'percusion@ejemplo.org', NULL, 107, 16, 928754800),
(156, 'Antonio Jesús Martín Castro', 'ajmartin@ejemplo.org', NULL, 107, 16, 928754800),
(157, 'María José Sánchez López', 'flauta@ejemplo.org', NULL, 107, 16, 928754800),
(158, 'Luis Miguel García Fernández', 'museo@ejemplo.com', NULL, NULL, 7, 928759706),
(159, 'Ana Belén Martínez Ruiz', 'amartinez@ejemplo.org', NULL, NULL, 13, 928793614),
(160, 'Sergio González Pérez', 'piano@ejemplo.org', NULL, 107, 16, 928754800),
(161, 'Juan Francisco López García', 'jflopez@ejemplo.es', NULL, 102, 4, 928795280),
(162, 'Francisco José Martínez Sánchez', 'fjmartinez@ejemplo.org', NULL, NULL, 4, 928122042),
(163, 'José Antonio García López', 'folclore@ejemplo.org', NULL, 107, 16, 928754800),
(164, 'María Isabel Ruiz Sánchez', 'miruiz@ejemplo.es', NULL, NULL, 5, 928751006),
(165, 'Antonia García Martínez', 'agarcia@ejemplo.es', 699527269, NULL, 13, 928793614),
(166, 'María del Carmen López García', 'musicoterapia@ejemplo.org', NULL, 107, 16, 928754800),
(167, 'Isabel María Martínez López', 'immartinez@ejemplo.org', NULL, NULL, 12, 928759526),
(168, 'José Luis Sánchez García', 'jlsanchez@ejemplo.org', NULL, NULL, 5, 928750182),
(169, 'María Teresa García López', 'mtgarcia@ejemplo.org', NULL, NULL, 12, 928759526),
(170, 'Ana María López García', 'amlopez@ejemplo.org', NULL, NULL, 12, 928759526),
(171, 'María José Martínez López', 'mjmartinez@ejemplo.org', NULL, 101, 1, 928754800),
(172, 'Juan José García Martínez', 'jjgarcia@ejemplo.org', NULL, 107, 16, 928754800),
(173, 'Francisco Javier López García', 'fjlopez@ejemplo.es', NULL, 112, 1, 928754800),
(174, 'María Ángeles Martínez López', 'mamartinez@ejemplo.org', NULL, NULL, 4, 928795280),
(175, 'José Manuel García López', 'jmgarcia@ejemplo.org', NULL, NULL, 5, 928750182),
(176, 'Antonio Manuel Martínez García', 'ammartinez@ejemplo.org', NULL, NULL, 14, 928795280),
(177, 'Juan Carlos García Martínez', 'jcgarcia@ejemplo.org', NULL, NULL, 4, 928122042),
(178, 'José María López Martínez', 'jmlopez@ejemplo.org', NULL, NULL, 4, 928795280),
(179, 'María Luisa García Martínez', 'mlgarcia@ejemplo.org', NULL, NULL, 4, 928795280),
(180, 'Ana Isabel López García', 'ailopez@ejemplo.org', NULL, NULL, 12, 928759526),
(181, 'José Antonio Martínez López', 'jamartinez@ejemplo.org', NULL, NULL, 5, 928750182),
(182, 'Juan Manuel García López', 'jmgarcia@ejemplo.org', NULL, NULL, 1, 928754800),
(183, 'Francisco Manuel Martínez García', 'fmmartinez@ejemplo.org', NULL, NULL, 14, 928122042),
(184, 'María del Pilar López Martínez', 'mplopez@ejemplo.es', NULL, 115, 2, 928754800),
(185, 'Antonio José García Martínez', 'ajgarcia@ejemplo.org', NULL, NULL, 14, NULL),
(186, 'Juan Francisco Martínez López', 'jfmartinez@ejemplo.org', NULL, NULL, 4, 928795280),
(187, 'José Luis García Martínez', 'jlgarcia@ejemplo.org', NULL, NULL, 14, NULL),
(188, 'Francisco Javier Martínez García', 'fjmartinez@ejemplo.org', NULL, NULL, 14, NULL),
(189, 'Juan Antonio López García', 'jalopez@ejemplo.org', NULL, NULL, 14, NULL),
(190, 'José Francisco Martínez López', 'jfmartinez@ejemplo.org', NULL, NULL, 14, 928758877),
(191, 'Francisco José López Martínez', 'fjlopez@ejemplo.es', 659405927, 1116, 14, 928727200),
(192, 'Juan José Martínez García', 'jjmartinez@ejemplo.org', NULL, NULL, 13, 928793614),
(193, 'María José García López', 'mjgarcia@ejemplo.org', NULL, NULL, 12, 928759526),
(194, 'Ana María Martínez López', 'ammartinez@ejemplo.es', NULL, 107, 16, 928754800),
(195, 'María del Carmen Martínez García', 'mcmartinez@ejemplo.org', NULL, 108, 6, 928754800),
(196, 'José García Martínez', 'jgarcia@ejemplo.org', NULL, NULL, 12, 928759526),
(197, 'María Martínez García', 'mmartinez@ejemplo.org', NULL, 106, 1, 928754800),
(198, 'Ana López Martínez', 'alopez@ejemplo.org', NULL, NULL, 12, 928759526),
(199, 'José Martínez García', 'jmartinez@ejemplo.org', NULL, NULL, 5, 928751006),
(200, 'María García Martínez', 'mgarcia@ejemplo.org', NULL, NULL, 4, 928795280),
(201, 'Ana Martínez López', 'amartinez@ejemplo.org', NULL, NULL, 4, 928122042),
(202, 'María López García', 'mlopez@ejemplo.es', NULL, 109, 8, 928754800),
(203, 'José López Martínez', 'jlopez@ejemplo.org', NULL, NULL, 4, 928122042),
(204, 'María García López', 'mgarcia@ejemplo.es', NULL, 107, 1, 928754800),
(205, 'Ana García Martínez', 'agarcia@ejemplo.org', NULL, NULL, 4, 928122042),
(206, 'Consultas RRHH', 'rrhh@ejemplo.org', NULL, NULL, 10, NULL),
(207, 'Contratación', 'contratacion@ejemplo.es', NULL, 106, 2, 928754800);

INSERT INTO `usuarios` (`id`, `login`, `passwd`, `rol`) VALUES
(1, 'admin', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'administrador'); 
--default password: password

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;