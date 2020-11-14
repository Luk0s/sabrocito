DROP TABLE IF EXISTS `bebida`;
CREATE TABLE `bebida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `cena`;
CREATE TABLE `cena` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio_2` int(11) DEFAULT NULL,
  `precio_3` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `desayuno`;
CREATE TABLE `desayuno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `entrada`;
CREATE TABLE `entrada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `extra`;
CREATE TABLE `extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `fondo`;
CREATE TABLE `fondo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `jugo`;
CREATE TABLE `jugo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_leche` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `otro`;
CREATE TABLE `otro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `pago_tipo`;
CREATE TABLE `pago_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `pedido_estado`;
CREATE TABLE `pedido_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_at` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `pago_tipo_id` int(11) NOT NULL,
  `rapida` tinyint(1) NOT NULL DEFAULT 0,
  `estado_id` int(11) NOT NULL DEFAULT 0,
  `terminada_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_rapida_pago_tipo_id_fk` (`pago_tipo_id`),
  KEY `venta_pedido_estado_id_fk` (`estado_id`),
  CONSTRAINT `venta_pedido_estado_id_fk` FOREIGN KEY (`estado_id`) REFERENCES `pedido_estado` (`id`),
  CONSTRAINT `venta_rapida_pago_tipo_id_fk` FOREIGN KEY (`pago_tipo_id`) REFERENCES `pago_tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `venta_detalle`;
CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_rapida_detalle_venta_rapida_id_fk` (`venta_id`),
  CONSTRAINT `venta_rapida_detalle_venta_rapida_id_fk` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `agregado`;
CREATE TABLE `agregado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `bebida` (`id`, `descripcion`, `precio`, `visible`) VALUES
('1', 'Fanta 500 ml', '900', '1'),
('2', 'Fanta 1 lt', '1200', '1'),
('3', 'Fanta 1.5 lt', '1500', '1'),
('4', 'Test111', '12', '0');

INSERT INTO `cena` (`id`, `descripcion`, `precio_2`, `precio_3`, `visible`) VALUES
('1', 'Chicharrón de Pollo', '2000', '3000', '1'),
('2', 'Lomo Saltado', '2000', '3000', '1'),
('3', 'Pollo a la Plancha', '2000', '3000', '1'),
('4', 'Arroz Chaufa', '2000', '3000', '1');

INSERT INTO `desayuno` (`id`, `descripcion`, `precio`, `visible`) VALUES
('1', 'Avena', '500', '1'),
('2', 'Pan con Palta', '700', '1'),
('3', 'Quinoa', '500', '1'),
('4', 'Pan con Huevo', '500', '1'),
('5', 'Té', '500', '1'),
('6', 'Pan con Queso Blanco', '500', '1'),
('7', 'Café', '500', '1'),
('8', 'Churrasco Palta', '1300', '1'),
('9', 'Manzanilla', '500', '1'),
('10', 'Ave Mayo', '700', '1'),
('12', 'Atún', '700', '1');

INSERT INTO `entrada` (`id`, `descripcion`, `precio`, `visible`) VALUES
('1', 'Cazuela de Pollo', '2000', '1'),
('2', 'Cazuela de Vacuno', '2000', '1'),
('3', 'test2', '40001', '0');

INSERT INTO `extra` (`id`, `descripcion`, `precio`, `visible`) VALUES
('3', 'Ceviche', '4000', '1'),
('4', 'Ceviche Mixto', '4000', '1'),
('5', 'Lomo Saltado', '4000', '1'),
('6', 'Chicharrón de Pez', '4000', '1'),
('7', 'Chicharrón de Pollo', '4000', '1'),
('8', 'Chicharrón de Chancho', '4000', '1'),
('9', 'Pollo a la Plancha', '4000', '1'),
('10', 'Arroz Chaufa Pollo Carne', '4000', '1'),
('11', 'Tallarín Saltado', '4000', '1'),
('12', 'Tallarín Saltado', '4000', '1'),
('13', 'Arroz con Marisco', '4000', '1'),
('14', 'Combinado', '4000', '1'),
('15', 'Lomo a lo Pobre', '4000', '1'),
('16', 'test', '4000', '0'),
('17', 'test', '5000', '0');

INSERT INTO `fondo` (`id`, `descripcion`, `precio`, `visible`) VALUES
('1', 'Pollo al Jugo + Arroz + Papa Cocida', '2500', '1'),
('2', 'Carne + Arroz + Ensalada', '2500', '1'),
('3', 'Test', '200022', '0');

INSERT INTO `jugo` (`id`, `descripcion`, `precio`, `precio_leche`, `visible`) VALUES
('1', 'Mango', '1000', '1500', '1'),
('2', 'Plátano', '1000', '1500', '1'),
('3', 'Melón', '1000', '1500', '1'),
('4', 'Frutilla', '1000', '1500', '1'),
('5', 'Papaya', '1000', '1500', '1'),
('6', 'Maracuya', '1000', '1500', '1'),
('7', 'Piña', '1000', '1500', '1'),
('8', 'Naranja', '1000', '1500', '1'),
('9', 'Guayaba', '1000', '1500', '1'),
('10', 'Limonada', '1000', '1500', '1'),
('11', 'Test111', '10002', '15003', '0');

INSERT INTO `otro` (`id`, `descripcion`, `precio`, `visible`) VALUES
('1', 'Papas fritas jamón serrano', '500', '1');

INSERT INTO `pago_tipo` (`id`, `descripcion`) VALUES
('1', 'Efectivo'),
('2', 'Débito'),
('3', 'Crédito');

INSERT INTO `pedido_estado` (`id`, `descripcion`) VALUES
('1', 'Pedido'),
('2', 'Pagado'),
('3', 'Anulado'),
('4', 'Preparado'),
('5', 'Entregado');

INSERT INTO `venta` (`id`, `venta_at`, `total`, `pago_tipo_id`, `rapida`, `estado_id`, `terminada_at`) VALUES
('15', '2020-11-09 00:02:47', '2500', '1', '0', '5', '2020-11-09 00:06:51');

INSERT INTO `venta_detalle` (`id`, `venta_id`, `tipo`, `producto_id`, `precio`, `comentario`) VALUES
('47', '15', 'desayuno', '1', '500', NULL),
('48', '15', 'fondo', '2', '2000', NULL);

INSERT INTO `agregado` (`id`, `descripcion`, `visible`) VALUES
('1', 'Arroz Blanco', '1'),
('2', 'Papa Cocida', '1'),
('3', 'Ensalada', '1'),
('4', 'Papa Frita', '1'),
('5', 'Arroz Chaufa', '1'),
('6', 'Plátano Frito', '1'),
('7', 'Test111', '0'),
('8', 'Papas Mayo', '1');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;