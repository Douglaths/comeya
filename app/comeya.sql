-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 05:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comeya`
--

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `plan` enum('basico','premium','enterprise') DEFAULT 'basico',
  `estado` enum('activo','inactivo','suspendido','trial') DEFAULT 'activo',
  `fecha_trial_fin` date DEFAULT NULL,
  `limite_productos` int(11) DEFAULT 50,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_alta` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `email`, `telefono`, `direccion`, `ciudad`, `plan`, `estado`, `fecha_trial_fin`, `limite_productos`, `activo`, `fecha_alta`, `created_at`, `updated_at`) VALUES
(1, 'Restaurante El Buen Sabor', 'contacto@elbuensabor.com', '555-0001', 'Calle Principal 123', 'Madrid', 'premium', 'activo', NULL, 50, 1, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(2, 'Pizzería Don Mario', 'info@donmario.com', '555-0002', 'Avenida Central 456', 'Barcelona', 'basico', 'activo', NULL, 50, 1, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(3, 'Café Central', 'hola@cafecentral.com', '555-0003', 'Plaza Mayor 789', 'Valencia', 'basico', 'inactivo', NULL, 50, 0, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(4, 'Mariscos La Costa', 'ventas@lacosta.com', '555-0004', 'Malecón 321', 'Sevilla', 'enterprise', 'trial', '2025-12-01', 50, 1, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(5, 'Burger King Express', 'admin@burgerexpress.com', '555-0005', 'Gran Vía 25', 'Madrid', 'premium', 'activo', NULL, 100, 1, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50'),
(6, 'Sushi Zen', 'contacto@sushizen.com', '555-0006', 'Paseo de Gracia 88', 'Barcelona', 'basico', 'trial', '2025-11-23', 25, 1, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50'),
(7, 'Taco Loco', 'info@tacoloco.com', '555-0007', 'Calle Sierpes 15', 'Sevilla', 'basico', 'suspendido', NULL, 25, 1, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `numero_pedido` varchar(50) NOT NULL,
  `cliente_nombre` varchar(255) DEFAULT NULL,
  `cliente_email` varchar(255) DEFAULT NULL,
  `cliente_telefono` varchar(20) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','procesando','completado','cancelado') DEFAULT 'pendiente',
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `empresa_id`, `numero_pedido`, `cliente_nombre`, `cliente_email`, `cliente_telefono`, `subtotal`, `impuestos`, `total`, `estado`, `fecha_pedido`, `created_at`, `updated_at`) VALUES
(1, 1, 'PED-001', 'Juan Pérez', 'juan@email.com', '666-111-222', 32.00, 3.36, 35.36, 'completado', '2024-01-15 14:30:00', '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(2, 1, 'PED-002', 'María García', 'maria@email.com', '666-333-444', 24.00, 2.52, 26.52, 'completado', '2024-01-16 19:45:00', '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(3, 2, 'PED-003', 'Carlos López', 'carlos@email.com', '666-555-666', 42.50, 4.46, 46.96, 'completado', '2024-01-15 20:15:00', '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(4, 2, 'PED-004', 'Ana Martín', 'ana@email.com', '666-777-888', 28.00, 2.94, 30.94, 'procesando', '2024-01-17 13:20:00', '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(5, 4, 'PED-005', 'Luis Rodríguez', 'luis@email.com', '666-999-000', 65.00, 6.83, 71.83, 'completado', '2024-01-16 21:00:00', '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(6, 1, 'PED-001', 'Juan Pérez', 'juan@email.com', '666-111-222', 32.00, 3.36, 35.36, 'completado', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(7, 1, 'PED-002', 'María García', 'maria@email.com', '666-333-444', 24.00, 2.52, 26.52, 'completado', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(8, 2, 'PED-003', 'Carlos López', 'carlos@email.com', '666-555-666', 42.50, 4.46, 46.96, 'completado', '2025-11-15 00:00:00', '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(9, 2, 'PED-004', 'Ana Martín', 'ana@email.com', '666-777-888', 28.00, 2.94, 30.94, 'procesando', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(10, 4, 'PED-005', 'Luis Rodríguez', 'luis@email.com', '666-999-000', 65.00, 6.83, 71.83, 'completado', '2025-11-14 00:00:00', '2025-11-16 23:34:46', '2025-11-16 23:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `pedido_items`
--

CREATE TABLE `pedido_items` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedido_items`
--

INSERT INTO `pedido_items` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`, `created_at`) VALUES
(1, 1, 1, 1, 18.50, 18.50, '2025-11-16 22:51:14'),
(2, 1, 3, 2, 5.50, 11.00, '2025-11-16 22:51:14'),
(3, 1, 2, 1, 8.00, 8.00, '2025-11-16 22:51:14'),
(4, 2, 1, 1, 18.50, 18.50, '2025-11-16 22:51:14'),
(5, 2, 3, 1, 5.50, 5.50, '2025-11-16 22:51:14'),
(6, 3, 4, 2, 12.00, 24.00, '2025-11-16 22:51:14'),
(7, 3, 5, 1, 14.50, 14.50, '2025-11-16 22:51:14'),
(8, 3, 6, 1, 16.00, 16.00, '2025-11-16 22:51:14'),
(9, 4, 4, 1, 12.00, 12.00, '2025-11-16 22:51:14'),
(10, 4, 6, 1, 16.00, 16.00, '2025-11-16 22:51:14'),
(11, 5, 7, 1, 28.00, 28.00, '2025-11-16 22:51:14'),
(12, 5, 8, 1, 15.00, 15.00, '2025-11-16 22:51:14'),
(13, 5, 9, 1, 22.00, 22.00, '2025-11-16 22:51:14'),
(14, 1, 1, 1, 18.50, 18.50, '2025-11-16 23:34:46'),
(15, 1, 3, 2, 5.50, 11.00, '2025-11-16 23:34:46'),
(16, 1, 2, 1, 8.00, 8.00, '2025-11-16 23:34:46'),
(17, 2, 1, 1, 18.50, 18.50, '2025-11-16 23:34:46'),
(18, 2, 3, 1, 5.50, 5.50, '2025-11-16 23:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `empresa_id`, `nombre`, `descripcion`, `precio`, `categoria`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, 'Platos principales', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(2, 1, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, 'Entrantes', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(3, 1, 'Flan Casero', 'Postre tradicional español', 5.50, 'Postres', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(4, 2, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, 'Pizzas', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(5, 2, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, 'Pizzas', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(6, 2, 'Lasaña Boloñesa', 'Lasaña tradicional italiana', 16.00, 'Pasta', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(7, 4, 'Parrillada de Mariscos', 'Selección de mariscos a la parrilla', 28.00, 'Mariscos', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(8, 4, 'Ceviche Peruano', 'Pescado marinado en limón', 15.00, 'Entrantes', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(9, 4, 'Arroz con Mariscos', 'Arroz con variedad de mariscos', 22.00, 'Platos principales', 1, '2025-11-16 22:51:14', '2025-11-16 22:51:14'),
(10, 1, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, 'Platos principales', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(11, 1, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, 'Entrantes', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(12, 1, 'Flan Casero', 'Postre tradicional español', 5.50, 'Postres', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(13, 2, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, 'Pizzas', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(14, 2, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, 'Pizzas', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(15, 2, 'Lasaña Boloñesa', 'Lasaña tradicional italiana', 16.00, 'Pasta', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(16, 4, 'Parrillada de Mariscos', 'Selección de mariscos a la parrilla', 28.00, 'Mariscos', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(17, 4, 'Ceviche Peruano', 'Pescado marinado en limón', 15.00, 'Entrantes', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46'),
(18, 4, 'Arroz con Mariscos', 'Arroz con variedad de mariscos', 22.00, 'Platos principales', 1, '2025-11-16 23:34:46', '2025-11-16 23:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('superadmin','admin_empresa','usuario') DEFAULT 'usuario',
  `activo` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `empresa_id`, `nombre`, `email`, `password`, `rol`, `activo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Super Administrador', 'superadmin@comeya.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin', 1, '2025-11-16 18:43:33', '2025-11-16 18:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_venta` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `empresa_id`, `total`, `fecha_venta`, `created_at`, `updated_at`) VALUES
(1, 1, 1250.50, '2024-01-15 14:30:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(2, 1, 890.75, '2024-01-16 19:45:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(3, 2, 2100.00, '2024-01-15 20:15:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(4, 2, 1650.25, '2024-01-17 13:20:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(5, 4, 3200.80, '2024-01-16 21:00:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(6, 1, 1450.90, '2025-02-10 10:15:00', '2025-11-16 19:05:00', '2025-11-16 19:05:00'),
(7, 3, 2750.40, '2025-02-11 16:45:00', '2025-11-16 19:05:00', '2025-11-16 19:05:00'),
(8, 4, 980.25, '2025-02-12 09:30:00', '2025-11-16 19:05:00', '2025-11-16 19:05:00'),
(9, 2, 1850.00, '2025-02-13 18:20:00', '2025-11-16 19:05:00', '2025-11-16 19:05:00'),
(10, 1, 1325.75, '2025-02-14 12:50:00', '2025-11-16 19:05:00', '2025-11-16 19:05:00'),
(11, 1, 1580.45, '2025-11-15 09:20:00', '2025-11-16 19:25:00', '2025-11-16 19:25:00'),
(12, 2, 2420.00, '2025-11-15 11:10:00', '2025-11-16 19:25:00', '2025-11-16 19:25:00'),
(13, 3, 980.75, '2025-11-15 14:45:00', '2025-11-16 19:25:00', '2025-11-16 19:25:00'),
(14, 4, 3150.60, '2025-11-15 17:30:00', '2025-11-16 19:25:00', '2025-11-16 19:25:00'),
(15, 1, 1275.30, '2025-11-15 20:10:00', '2025-11-16 19:25:00', '2025-11-16 19:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `fecha_visita` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitas`
--

INSERT INTO `visitas` (`id`, `empresa_id`, `ip`, `user_agent`, `fecha_visita`, `created_at`, `updated_at`) VALUES
(1, 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2024-01-15 10:30:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(2, 1, '192.168.1.101', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)', '2024-01-15 11:45:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(3, 2, '192.168.1.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)', '2024-01-16 09:15:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(4, 2, '192.168.1.103', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0)', '2024-01-16 16:20:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33'),
(5, 4, '192.168.1.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2024-01-17 12:10:00', '2025-11-16 18:43:33', '2025-11-16 18:43:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_empresas_activo` (`activo`),
  ADD KEY `idx_empresas_ciudad` (`ciudad`),
  ADD KEY `idx_empresas_plan` (`plan`),
  ADD KEY `idx_empresas_estado` (`estado`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pedidos_empresa` (`empresa_id`),
  ADD KEY `idx_pedidos_fecha` (`fecha_pedido`),
  ADD KEY `idx_pedidos_estado` (`estado`);

--
-- Indexes for table `pedido_items`
--
ALTER TABLE `pedido_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pedido_items_pedido` (`pedido_id`),
  ADD KEY `idx_pedido_items_producto` (`producto_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_productos_empresa` (`empresa_id`),
  ADD KEY `idx_productos_categoria` (`categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_usuarios_email` (`email`),
  ADD KEY `idx_usuarios_empresa` (`empresa_id`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ventas_empresa` (`empresa_id`),
  ADD KEY `idx_ventas_fecha` (`fecha_venta`);

--
-- Indexes for table `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_visitas_empresa` (`empresa_id`),
  ADD KEY `idx_visitas_fecha` (`fecha_visita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pedido_items`
--
ALTER TABLE `pedido_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pedido_items`
--
ALTER TABLE `pedido_items`
  ADD CONSTRAINT `pedido_items_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_items_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
