CREATE TABLE `tracking_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json_data` longtext DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_entidad` enum('proveedor','trabajador','profesional') NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `ruta_archivo` text NOT NULL,
  `nombre_original` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_entidad_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entidad_tipo` varchar(100) NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `super_category_id` varchar(50) DEFAULT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `subcategory_id` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_entidad` (`entidad_tipo`,`entidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_nomina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_id` int(11) NOT NULL,
  `periodo_anio` int(11) DEFAULT NULL,
  `periodo_quincena` int(11) DEFAULT NULL,
  `dias_trabajados` int(11) DEFAULT NULL,
  `bono` decimal(10,2) DEFAULT NULL,
  `imss` decimal(10,2) DEFAULT NULL,
  `monto_total` decimal(10,2) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `folio_fiscal` varchar(50) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `fecha_limite_pago` date DEFAULT NULL,
  `monto_total` decimal(10,2) DEFAULT NULL,
  `archivo_ruta` varchar(255) DEFAULT NULL,
  `estado` enum('pendiente','pagado','vencido') DEFAULT 'pendiente',
  `fecha_pago` date DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `activo` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_profesionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `modalidad_fiscal` varchar(50) DEFAULT NULL,
  `monto_honorarios` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_terminacion` date DEFAULT NULL,
  `domicilio` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `cuenta_clabe` varchar(20) DEFAULT NULL,
  `unidad_negocio_id` int(11) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) DEFAULT NULL,
  `nombre_contacto` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `cuenta_clabe` varchar(20) DEFAULT NULL,
  `tiene_credito` tinyint(4) DEFAULT 0,
  `dias_credito` int(11) DEFAULT 0,
  `unidad_negocio_id` int(11) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

CREATE TABLE `tracking_trabajadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(150) NOT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `salario_diario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `curp` varchar(20) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL,
  `nss` varchar(20) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_terminacion` date DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `domicilio` text DEFAULT NULL,
  `banco` varchar(100) DEFAULT NULL,
  `cuenta_clabe` varchar(30) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

