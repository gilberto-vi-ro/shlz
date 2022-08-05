
DROP DATABASE IF EXISTS `shaliz`;
CREATE DATABASE IF NOT EXISTS `shaliz`
/*!40100 DEFAULT CHARACTER SET latin1 */;
USE `shaliz`;
-- Volcando estructura para tabla shaliz.administrador
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `usuario` VARCHAR(100) DEFAULT NULL,
  `contrasena` TEXT(1000) DEFAULT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
INSERT INTO `shaliz`.`administrador` (`nombre`, `apellido`, `usuario`, `contrasena`)
VALUES('Juan', 'Diaz', 'juan', 'juan');
-- Volcando estructura para tabla shaliz.empleado
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `rfc` char(30) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT now(),
  `usuario` VARCHAR(100) DEFAULT NULL,
  `contrasena` TEXT(1000) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_empleado_administrador` (`id_admin`),
  CONSTRAINT `FK_empleado_administrador` FOREIGN KEY (`id_admin`) REFERENCES `administrador` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
INSERT INTO`shaliz`.`empleado` ( `nombre`, `apellido`,`telefono`,`direccion`,`rfc`,`fecha_ingreso`,`usuario`, `contrasena`, `id_admin` )
  VALUES('Luis','Lopez','1234567890','Mexico','12345','2022-07-16','luis','luis','1' );
SELECT
  LAST_INSERT_ID();
-- Volcando estructura para tabla shaliz.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `cod_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `img` text(500) DEFAULT NULL,
  PRIMARY KEY (`cod_producto`)
) ENGINE = InnoDB AUTO_INCREMENT = 54544 DEFAULT CHARSET = latin1;
-- Volcando datos para la tabla shaliz.producto: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO
  `producto` (`cod_producto`, `nombre`, `precio`, `stock`)
VALUES
  (1, 'sabritas', 15, 10);
  
  /*!40000 ALTER TABLE `producto` ENABLE KEYS */;
-- Volcando estructura para tabla shaliz.venta
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
    `id_venta` int(11) NOT NULL AUTO_INCREMENT,
    `total` DOUBLE DEFAULT NULL,
    `fecha_venta` date DEFAULT NULL,
    `dni` int(11) DEFAULT NULL,
    PRIMARY KEY (`id_venta`),
    KEY `FK_venta_empleado` (`dni`),
    CONSTRAINT `FK_venta_empleado` FOREIGN KEY (`dni`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE = InnoDB DEFAULT CHARSET = LATIN1;

  
DROP TABLE IF EXISTS `productos_vendidos`;
CREATE TABLE IF NOT EXISTS `productos_vendidos` (
    `cod_producto` int(11) NOT NULL,
    `id_venta` int(11) NOT NULL,
    `cantidad` int(11) NOT NULL,
    `total` DOUBLE DEFAULT NULL,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;


