SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apaterno` varchar(100) DEFAULT NULL,
  `amaterno` varchar(100) DEFAULT NULL,
  `ci` varchar(30) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `persona` (`id`, `nombre`, `apaterno`, `amaterno`, `ci`, `celular`, `usuario`, `contrasenia`, `id_rol`) VALUES
(1, 'Carlos', 'Jahuira', 'Sullca', '9077347', 62478187, 'carlos', '11111', 1),
(2, 'Jhoel', 'Legua', 'Villegas', '8277075', 73282523, 'jhoel', '22222', 2),
(3, 'Ana', 'Cruz', 'Lopez', '1110001', 60624420, 'ana', '33333', 3);

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Estudiante'),
(2, 'Decanatura'),
(3, 'Kardex');

ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
