-- Tablas para el módulo de contabilidad

-- Tabla de planes
CREATE TABLE IF NOT EXISTS `planes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `limite_productos` int(11) NOT NULL DEFAULT -1,
  `caracteristicas` text,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagada','vencida','cancelada') NOT NULL DEFAULT 'pendiente',
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`),
  KEY `empresa_id` (`empresa_id`),
  KEY `plan_id` (`plan_id`),
  FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura_id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` enum('stripe','transferencia','efectivo','paypal') NOT NULL,
  `estado` enum('pendiente','completado','fallido','reembolsado') NOT NULL DEFAULT 'pendiente',
  `fecha_pago` datetime NOT NULL,
  `referencia_externa` varchar(255) DEFAULT NULL,
  `notas` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `factura_id` (`factura_id`),
  FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar algunos planes de ejemplo
INSERT INTO `planes` (`nombre`, `precio`, `limite_productos`, `caracteristicas`, `activo`) VALUES
('Plan Gratuito', 0.00, 10, 'Gestión básica de productos\nSoporte por email\nReportes básicos', 1),
('Plan Básico', 29.99, 100, 'Gestión completa de productos\nSoporte prioritario\nReportes avanzados\nIntegraciones básicas', 1),
('Plan Pro', 59.99, 500, 'Productos ilimitados\nSoporte 24/7\nReportes personalizados\nIntegraciones avanzadas\nAPI completa', 1),
('Plan Enterprise', 99.99, -1, 'Todo incluido\nSoporte dedicado\nPersonalización completa\nIntegraciones empresariales\nConsultoría incluida', 1);

-- Insertar algunas facturas de ejemplo
INSERT INTO `facturas` (`empresa_id`, `numero`, `monto`, `estado`, `fecha_emision`, `fecha_vencimiento`, `concepto`, `plan_id`) VALUES
(1, 'FAC-2024-001', 29.99, 'pagada', '2024-01-01', '2024-01-31', 'Suscripción Plan Básico - Enero 2024', 2),
(2, 'FAC-2024-002', 59.99, 'pendiente', '2024-01-01', '2024-01-31', 'Suscripción Plan Pro - Enero 2024', 3),
(1, 'FAC-2024-003', 29.99, 'vencida', '2023-12-01', '2023-12-31', 'Suscripción Plan Básico - Diciembre 2023', 2);

-- Insertar algunos pagos de ejemplo
INSERT INTO `pagos` (`factura_id`, `monto`, `metodo_pago`, `estado`, `fecha_pago`, `referencia_externa`) VALUES
(1, 29.99, 'stripe', 'completado', '2024-01-02 10:30:00', 'pi_1234567890'),
(3, 29.99, 'transferencia', 'completado', '2024-01-15 14:20:00', 'TRANS-001-2024');