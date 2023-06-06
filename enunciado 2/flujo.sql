SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `flujo` (
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `proceso_siguiente` varchar(5) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `pantalla` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `flujo` (`flujo`, `proceso`, `proceso_siguiente`, `tipo`, `rol`, `pantalla`) VALUES
('F1', 'P1', 'P2', 'I', 'Estudiante', 'solicita'),
('F1', 'P2', 'P3', 'P', 'Decanatura', 'atiendeSolicitud'),
('F1', 'P3', 'P4', 'P', 'Decanatura', 'verificacion'),
('F1', 'P4', '', 'C', 'Kardex', 'terminoPlanEstudio'),
('F1', 'P5', '', 'F', 'Decanatura', 'observacion'),
('F1', 'P6', 'P7', 'P', 'Decanatura', 'extensionCertificado'),
('F1', 'P7', '', 'F', 'Estudiante', 'recibeCertificado');

CREATE TABLE `flujocondicion` (
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `procesoSI` varchar(3) DEFAULT NULL,
  `procesoNO` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `flujocondicion` (`flujo`, `proceso`, `procesoSI`, `procesoNO`) VALUES
('F1', 'P4', 'P6', 'P5');

CREATE TABLE `flujotramite` (
  `Flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `nro_tramite` int(11) DEFAULT NULL,
  `fechaini` datetime DEFAULT NULL,
  `fechafin` datetime DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INICIALIZADOR
INSERT INTO `flujotramite` (`Flujo`, `proceso`, `nro_tramite`, `fechaini`, `fechafin`, `usuario`) VALUES
('F1', 'P1', 500, '2023-06-03 15:00:00', NULL, 'carlos'),
('F1', 'P4', 500, '2023-06-03 15:30:00', NULL, 'ana'),
('F1', 'P2', 500, '2023-06-03 16:30:00', NULL, 'jhoel');
