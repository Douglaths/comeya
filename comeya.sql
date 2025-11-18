-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 05:59 AM
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
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `codigo_referido` varchar(50) DEFAULT NULL,
  `configuracion_notificaciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`configuracion_notificaciones`)),
  `fecha_alta` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `email`, `telefono`, `direccion`, `ciudad`, `plan`, `estado`, `fecha_trial_fin`, `limite_productos`, `activo`, `destacado`, `codigo_referido`, `configuracion_notificaciones`, `fecha_alta`, `created_at`, `updated_at`) VALUES
(1, 'galvis', 'contacto@elbuensabor.com', '3163127002', 'Calle 123 #45-67, Bogotá', 'Madrid', 'premium', 'activo', NULL, 500, 1, 1, NULL, '{\"email_pedidos\":true,\"whatsapp_pedidos\":true,\"email_reportes\":true}', '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-17 23:49:17'),
(2, 'Pizzería Don Mario', 'info@donmario.com', '555-0002', 'Avenida Central 456', 'Barcelona', 'basico', 'activo', NULL, 50, 1, 1, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-17 00:28:31'),
(3, 'Café Central', 'hola@cafecentral.com', '555-0003', 'Plaza Mayor 789', 'Valencia', 'basico', 'inactivo', NULL, 50, 0, 0, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(4, 'Mariscos La Costa', 'ventas@lacosta.com', '555-0004', 'Malecón 321', 'Sevilla', 'enterprise', 'trial', '2025-12-01', 50, 1, 0, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-16 22:43:50'),
(5, 'Burger King Express', 'admin@burgerexpress.com', '555-0005', 'Gran Vía 25', 'Madrid', 'premium', 'activo', NULL, 100, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50'),
(6, 'Sushi Zen', 'contacto@sushizen.com', '555-0006', 'Paseo de Gracia 88', 'Barcelona', 'basico', 'trial', '2025-11-23', 25, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50'),
(7, 'Taco Loco', 'info@tacoloco.com', '555-0007', 'Calle Sierpes 15', 'Sevilla', 'basico', 'suspendido', NULL, 25, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-16 22:43:50');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
