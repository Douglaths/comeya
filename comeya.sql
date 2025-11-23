-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 08:38 AM
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
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen_url` varchar(500) NOT NULL,
  `enlace` varchar(500) DEFAULT NULL,
  `posicion` enum('header','sidebar','footer','popup') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `titulo`, `imagen_url`, `enlace`, `posicion`, `fecha_inicio`, `fecha_fin`, `clicks`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Banner Principal Comeya', 'https://via.placeholder.com/800x200/007bff/ffffff?text=Comeya+Banner', 'https://comeya.com', 'header', '2024-01-01', '2024-12-31', 45, 1, '2025-11-17 05:28:31', '2025-11-17 05:28:31'),
(2, 'Promoción Sidebar', 'https://via.placeholder.com/300x250/28a745/ffffff?text=Promo+Sidebar', 'https://comeya.com/promo', 'sidebar', '2024-01-01', '2024-06-30', 23, 1, '2025-11-17 05:28:31', '2025-11-17 05:28:31'),
(3, 'Banner Principal', 'https://via.placeholder.com/800x200/007bff/ffffff?text=Comeya', 'https://comeya.com', 'header', '2024-01-01', NULL, 0, 1, '2025-11-17 05:34:04', '2025-11-17 05:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `campanas`
--

CREATE TABLE `campanas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` enum('google_ads','meta_ads','email','seo','contenido') NOT NULL,
  `plataforma` varchar(100) DEFAULT NULL,
  `presupuesto` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `objetivo` text DEFAULT NULL,
  `estado` enum('borrador','activa','pausada','finalizada') NOT NULL DEFAULT 'borrador',
  `metricas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metricas`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campanas`
--

INSERT INTO `campanas` (`id`, `nombre`, `tipo`, `plataforma`, `presupuesto`, `fecha_inicio`, `fecha_fin`, `objetivo`, `estado`, `metricas`, `created_at`, `updated_at`) VALUES
(1, 'Captación Restaurantes Q1', 'google_ads', 'Google Ads', 500.00, '2024-01-01', '2024-03-31', 'Atraer nuevos restaurantes a la plataforma', 'activa', NULL, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(2, 'Promoción Facebook', 'meta_ads', 'Facebook', 300.00, '2024-01-15', '2024-02-15', 'Aumentar awareness de marca', 'activa', NULL, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(3, 'Newsletter Mensual', 'email', 'Mailchimp', 50.00, '2024-01-01', NULL, 'Mantener engagement con clientes', 'activa', NULL, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(4, 'Captación Restaurantes Q1', 'google_ads', 'Google Ads', 500.00, '2024-01-01', '2024-03-31', 'Atraer nuevos restaurantes', 'activa', NULL, '2025-11-17 05:34:04', '2025-11-17 05:34:04'),
(5, 'Promoción Facebook', 'meta_ads', 'Facebook', 300.00, '2024-01-15', '2024-02-15', 'Aumentar awareness', 'activa', NULL, '2025-11-17 05:34:04', '2025-11-17 05:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `empresa_id`, `nombre`, `descripcion`, `orden`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bebidas Calientes', 'Café, té y bebidas calientes', 1, 1, '2025-11-17 20:55:51', '2025-11-17 20:55:51'),
(2, 1, 'Bebidas Frías', 'Jugos, sodas y bebidas refrescantes', 2, 1, '2025-11-17 20:55:51', '2025-11-17 20:55:51'),
(3, 1, 'Postres', 'Dulces, tortas y postres caseros', 3, 1, '2025-11-17 20:55:51', '2025-11-17 20:55:51'),
(4, 1, 'Desayunos', 'Opciones para empezar el día', 4, 1, '2025-11-17 20:55:51', '2025-11-17 20:55:51'),
(5, 1, '🍰 panes', 'panes', 5, 1, '2025-11-18 03:49:09', '2025-11-18 03:49:09'),
(6, 1, 'Platos principales', 'Categoría Platos principales', 6, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(7, 1, 'Entrantes', 'Categoría Entrantes', 6, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(8, 2, 'Pizzas', 'Categoría Pizzas', 1, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(9, 2, 'Pasta', 'Categoría Pasta', 1, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(10, 4, 'Mariscos', 'Categoría Mariscos', 1, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(11, 4, 'Entrantes', 'Categoría Entrantes', 1, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(12, 4, 'Platos principales', 'Categoría Platos principales', 1, 1, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(13, 2, 'Pizza de gato', 'son pizzas pero con carne de gato', 3, 1, '2025-11-23 01:29:33', '2025-11-23 01:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `codigos_referidos`
--

CREATE TABLE `codigos_referidos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `descuento_porcentaje` int(11) NOT NULL,
  `limite_usos` int(11) DEFAULT NULL,
  `usos_actuales` int(11) NOT NULL DEFAULT 0,
  `fecha_expiracion` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codigos_referidos`
--

INSERT INTO `codigos_referidos` (`id`, `codigo`, `descripcion`, `descuento_porcentaje`, `limite_usos`, `usos_actuales`, `fecha_expiracion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'PARTNER2024', 'Código para partners estratégicos', 20, 100, 0, '2024-12-31', 1, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(2, 'WELCOME10', 'Descuento de bienvenida', 10, NULL, 0, NULL, 1, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(3, 'PROMO50', 'Promoción especial 50% descuento', 50, 50, 0, '2024-06-30', 1, '2025-11-17 05:22:37', '2025-11-17 05:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `destacados`
--

CREATE TABLE `destacados` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `tipo` enum('producto','combo','promocion') NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_original` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `orden` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_campanas`
--

CREATE TABLE `email_campanas` (
  `id` int(11) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `destinatarios` enum('todos','activos','inactivos','trial') NOT NULL,
  `programado_para` datetime DEFAULT NULL,
  `enviado_en` datetime DEFAULT NULL,
  `estado` enum('borrador','programado','enviado','fallido') NOT NULL DEFAULT 'borrador',
  `estadisticas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`estadisticas`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_campanas`
--

INSERT INTO `email_campanas` (`id`, `asunto`, `contenido`, `destinatarios`, `programado_para`, `enviado_en`, `estado`, `estadisticas`, `created_at`, `updated_at`) VALUES
(1, 'Bienvenido a Comeya', 'Contenido del email de bienvenida', 'todos', NULL, NULL, 'enviado', NULL, '2025-11-17 05:34:04', '2025-11-17 05:34:04'),
(2, 'Nuevas funcionalidades', 'Te presentamos las nuevas funciones', 'activos', NULL, NULL, 'borrador', NULL, '2025-11-17 05:34:04', '2025-11-17 05:34:04');

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
  `descripcion` text DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `categoria_comida` varchar(100) DEFAULT NULL,
  `promociones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`promociones`)),
  `envio_gratis` tinyint(1) DEFAULT 0,
  `descuento_activo` tinyint(1) DEFAULT 0,
  `oferta_2x1` tinyint(1) DEFAULT 0,
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

INSERT INTO `empresas` (`id`, `nombre`, `email`, `telefono`, `direccion`, `descripcion`, `ciudad`, `categoria_comida`, `promociones`, `envio_gratis`, `descuento_activo`, `oferta_2x1`, `plan`, `estado`, `fecha_trial_fin`, `limite_productos`, `activo`, `destacado`, `codigo_referido`, `configuracion_notificaciones`, `fecha_alta`, `created_at`, `updated_at`) VALUES
(1, 'Galvis Café', 'admin@galvis.com', '3163127002', 'Calle 123 #45-67, Bogotá', 'Especialistas en carnes a la brasa y parrilla argentina con los mejores cortes', 'Madrid', 'Parrilla', NULL, 1, 1, 0, 'premium', 'activo', NULL, 500, 1, 1, NULL, '{\"email_pedidos\":true,\"whatsapp_pedidos\":true,\"email_reportes\":true}', '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-22 20:09:34'),
(2, 'Pizzería Don Mario', 'info@donmario.com', '555-0002', 'Avenida Central 456', 'Pizza artesanal al horno de leña con recetas tradicionales napolitanas', 'Barcelona', 'Italiana', NULL, 0, 0, 1, 'basico', 'activo', NULL, 50, 1, 1, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-18 00:39:47'),
(3, 'Café Central', 'hola@cafecentral.com', '555-0003', 'Plaza Mayor 789', 'Café de especialidad con ambiente acogedor y repostería artesanal', 'Valencia', 'Café', NULL, 1, 0, 0, 'basico', 'inactivo', NULL, 50, 0, 0, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-18 00:39:47'),
(4, 'Mariscos La Costa', 'ventas@lacosta.com', '555-0004', 'Malecón 321', 'Mariscos frescos del día preparados con técnicas tradicionales', 'Sevilla', 'Mariscos', NULL, 0, 1, 0, 'enterprise', 'trial', '2025-12-01', 50, 1, 0, NULL, NULL, '2025-11-16 18:43:33', '2025-11-16 18:43:33', '2025-11-18 00:39:47'),
(5, 'Burger King Express', 'admin@burgerexpress.com', '555-0005', 'Gran Vía 25', 'Hamburguesas gourmet con ingredientes premium y papas artesanales', 'Madrid', 'Hamburguesas', NULL, 1, 0, 1, 'premium', 'activo', NULL, 100, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-18 00:39:47'),
(6, 'Sushi Zen', 'contacto@sushizen.com', '555-0006', 'Paseo de Gracia 88', 'Auténtica cocina japonesa con los mejores ingredientes frescos', 'Barcelona', 'Japonesa', NULL, 0, 1, 0, 'basico', 'trial', '2025-11-23', 25, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-18 00:39:47'),
(7, 'Taco Loco', 'info@tacoloco.com', '555-0007', 'Calle Sierpes 15', 'Comida mexicana auténtica con sabores tradicionales y picantes', 'Sevilla', 'Mexicana', NULL, 0, 0, 1, 'basico', 'suspendido', NULL, 25, 1, 0, NULL, NULL, '2025-11-16 22:43:50', '2025-11-16 22:43:50', '2025-11-18 00:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagada','vencida','cancelada') NOT NULL DEFAULT 'pendiente',
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`id`, `empresa_id`, `numero`, `monto`, `estado`, `fecha_emision`, `fecha_vencimiento`, `concepto`, `plan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'FAC-2024-001', 29.99, 'pagada', '2024-01-01', '2024-01-31', 'Suscripción Plan Básico - Enero 2024', 2, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(2, 2, 'FAC-2024-002', 59.99, 'pendiente', '2024-01-01', '2024-01-31', 'Suscripción Plan Pro - Enero 2024', 3, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(3, 1, 'FAC-2024-003', 29.99, 'vencida', '2023-12-01', '2023-12-31', 'Suscripción Plan Básico - Diciembre 2023', 2, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(8, 1, 'FAC-2024-101', 59900.00, 'pagada', '2024-01-01', '2024-01-31', 'Suscripción Plan Premium - Enero 2024', 3, '2025-11-18 03:59:50', '2025-11-18 03:59:50'),
(9, 1, 'FAC-2024-102', 59900.00, 'pagada', '2024-02-01', '2024-02-29', 'Suscripción Plan Premium - Febrero 2024', 3, '2025-11-18 03:59:50', '2025-11-18 03:59:50'),
(10, 1, 'FAC-2024-103', 59900.00, 'pagada', '2024-03-01', '2024-03-31', 'Suscripción Plan Premium - Marzo 2024', 3, '2025-11-18 03:59:50', '2025-11-18 03:59:50'),
(11, 1, 'FAC-2024-104', 59900.00, 'pendiente', '2024-04-01', '2024-04-30', 'Suscripción Plan Premium - Abril 2024', 3, '2025-11-18 03:59:50', '2025-11-18 03:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `material_promocional`
--

CREATE TABLE `material_promocional` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` enum('flyer','qr','banner','plantilla','logo') NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `archivo_url` varchar(500) NOT NULL,
  `categoria` enum('restaurante','general','promocional') NOT NULL,
  `descargas` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_promocional`
--

INSERT INTO `material_promocional` (`id`, `nombre`, `tipo`, `descripcion`, `archivo_url`, `categoria`, `descargas`, `created_at`, `updated_at`) VALUES
(1, 'Flyer Promocional Comeya', 'flyer', 'Flyer promocional para restaurantes', 'https://example.com/flyer-comeya.pdf', 'promocional', 0, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(2, 'Código QR Personalizable', 'qr', 'Plantilla de código QR para mesas', 'https://example.com/qr-template.png', 'restaurante', 0, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(3, 'Banner Web Comeya', 'banner', 'Banner para sitios web de restaurantes', 'https://example.com/banner-web.jpg', 'general', 0, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(4, 'Logo Comeya Vectorial', 'logo', 'Logo oficial en formato vectorial', 'https://example.com/logo-comeya.svg', 'general', 0, '2025-11-17 05:22:37', '2025-11-17 05:22:37'),
(5, 'Flyer Comeya', 'flyer', 'Flyer promocional', 'https://example.com/flyer.pdf', 'promocional', 0, '2025-11-17 05:34:04', '2025-11-17 05:34:04'),
(6, 'QR Template', 'qr', 'Plantilla QR', 'https://example.com/qr.png', 'restaurante', 0, '2025-11-17 05:34:04', '2025-11-17 05:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` enum('stripe','transferencia','efectivo','paypal') NOT NULL,
  `estado` enum('pendiente','completado','fallido','reembolsado') NOT NULL DEFAULT 'pendiente',
  `fecha_pago` datetime NOT NULL,
  `referencia_externa` varchar(255) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id`, `factura_id`, `monto`, `metodo_pago`, `estado`, `fecha_pago`, `referencia_externa`, `notas`, `created_at`, `updated_at`) VALUES
(1, 1, 29.99, 'stripe', 'completado', '2024-01-02 10:30:00', 'pi_1234567890', NULL, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(2, 3, 29.99, 'transferencia', 'completado', '2024-01-15 14:20:00', 'TRANS-001-2024', NULL, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(3, 8, 59900.00, 'stripe', 'completado', '2024-01-02 10:30:00', 'pi_1234567890', NULL, '2025-11-18 03:59:50', '2025-11-18 03:59:50'),
(4, 9, 59900.00, 'stripe', 'completado', '2024-02-02 10:30:00', 'pi_1234567891', NULL, '2025-11-18 03:59:50', '2025-11-18 03:59:50'),
(5, 10, 59900.00, 'transferencia', 'completado', '2024-03-05 14:20:00', 'TRANS-001-2024', NULL, '2025-11-18 03:59:50', '2025-11-18 03:59:50');

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
  `direccion_entrega` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `metodo_pago` enum('efectivo','tarjeta') DEFAULT NULL,
  `mesa` varchar(10) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `costo_envio` decimal(10,2) DEFAULT 0.00,
  `impuestos` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','procesando','enviado','completado','cancelado') DEFAULT 'pendiente',
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `empresa_id`, `numero_pedido`, `cliente_nombre`, `cliente_email`, `cliente_telefono`, `direccion_entrega`, `notas`, `metodo_pago`, `mesa`, `subtotal`, `costo_envio`, `impuestos`, `total`, `estado`, `fecha_pedido`, `created_at`, `updated_at`) VALUES
(1, 1, 'PED-001', 'Juan Pérez', 'juan@email.com', '300-123-4567', NULL, NULL, NULL, 'Mesa 5', 32.00, 0.00, 3.36, 35.36, 'completado', '2024-01-15 14:30:00', '2025-11-16 22:51:14', '2025-11-17 22:55:17'),
(2, 1, 'PED-002-2', 'María García', 'maria@email.com', '300-987-6543', NULL, NULL, NULL, 'Mesa 2', 24.00, 0.00, 2.52, 26.52, 'completado', '2024-01-16 19:45:00', '2025-11-16 22:51:14', '2025-11-18 20:26:29'),
(3, 2, 'PED-003-3', 'Carlos López', 'carlos@email.com', '300-555-1234', NULL, NULL, NULL, 'Mesa 8', 42.50, 0.00, 4.46, 46.96, 'completado', '2024-01-15 20:15:00', '2025-11-16 22:51:14', '2025-11-18 20:26:29'),
(4, 2, 'PED-004-4', 'Ana Martín', 'ana@email.com', '666-777-888', NULL, NULL, NULL, NULL, 28.00, 0.00, 2.94, 30.94, 'procesando', '2024-01-17 13:20:00', '2025-11-16 22:51:14', '2025-11-18 20:26:29'),
(5, 4, 'PED-005-5', 'Luis Rodríguez', 'luis@email.com', '666-999-000', NULL, NULL, NULL, NULL, 65.00, 0.00, 6.83, 71.83, 'completado', '2024-01-16 21:00:00', '2025-11-16 22:51:14', '2025-11-18 20:26:29'),
(6, 1, 'PED-001-6', 'Juan Pérez', 'juan@email.com', '666-111-222', NULL, NULL, NULL, NULL, 32.00, 0.00, 3.36, 35.36, 'completado', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-18 20:26:29'),
(7, 1, 'PED-002-7', 'María García', 'maria@email.com', '666-333-444', NULL, NULL, NULL, NULL, 24.00, 0.00, 2.52, 26.52, 'completado', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-18 20:26:29'),
(8, 2, 'PED-003-8', 'Carlos López', 'carlos@email.com', '666-555-666', NULL, NULL, NULL, NULL, 42.50, 0.00, 4.46, 46.96, 'completado', '2025-11-15 00:00:00', '2025-11-16 23:34:46', '2025-11-18 20:26:29'),
(9, 2, 'PED-004-9', 'Ana Martín', 'ana@email.com', '666-777-888', NULL, NULL, NULL, NULL, 28.00, 0.00, 2.94, 30.94, 'procesando', '2025-11-16 00:00:00', '2025-11-16 23:34:46', '2025-11-18 20:26:29'),
(10, 4, 'PED-005-10', 'Luis Rodríguez', 'luis@email.com', '666-999-000', NULL, NULL, NULL, NULL, 65.00, 0.00, 6.83, 71.83, 'completado', '2025-11-14 00:00:00', '2025-11-16 23:34:46', '2025-11-18 20:26:29'),
(11, 1, '364-11', 'Ana Martínez', 'ana@email.com', '300-111-2222', NULL, NULL, NULL, 'Mesa 3', 25000.00, 0.00, 2500.00, 27500.00, 'pendiente', '2025-11-17 22:55:17', '2025-11-17 22:55:17', '2025-11-18 20:26:29'),
(12, 1, '422-12', 'Luis Rodríguez', 'luis@email.com', '300-333-4444', NULL, NULL, NULL, 'Mesa 7', 18000.00, 0.00, 1800.00, 19800.00, 'procesando', '2025-11-17 22:40:17', '2025-11-17 22:55:17', '2025-11-18 20:26:29'),
(13, 1, '17-13', 'Sofia Herrera', 'sofia@email.com', '300-777-8888', NULL, NULL, NULL, 'Mesa 1', 32000.00, 0.00, 3200.00, 35200.00, '', '2025-11-17 22:50:17', '2025-11-17 22:55:17', '2025-11-18 20:26:29'),
(14, 1, 'galvis-0008', 'asdasd', NULL, '234234', 'asdasd', 'asdasd', 'efectivo', NULL, 37.00, 3.00, 0.00, 40.00, 'cancelado', '2025-11-19 01:29:04', '2025-11-18 20:29:04', '2025-11-19 01:36:27'),
(15, 1, 'galvis-0009', '4234', NULL, '3242', 'asdasd', 'asdasd', 'efectivo', NULL, 37.00, 3.00, 0.00, 40.00, '', '2025-11-19 01:30:04', '2025-11-18 20:30:04', '2025-11-19 01:36:36'),
(16, 1, 'galvis-0010', 'asdasd', NULL, 'dasd', 'asdas', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, '', '2025-11-19 01:30:22', '2025-11-18 20:30:22', '2025-11-19 01:36:31'),
(17, 1, 'galvis-0011', 'dasda', NULL, '324234', 'asdas', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'cancelado', '2025-11-19 01:33:00', '2025-11-18 20:33:00', '2025-11-19 01:36:49'),
(18, 1, 'galvis-0012', 'asdasd', NULL, 'dasd', 'asdas', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, '', '2025-11-19 01:39:02', '2025-11-18 20:39:02', '2025-11-19 01:39:39'),
(19, 1, 'galvis-0013', 'sdasda', NULL, 'asda', 'asdasd', 'sdasd', 'efectivo', NULL, 55.50, 3.00, 0.00, 58.50, 'cancelado', '2025-11-19 01:39:10', '2025-11-18 20:39:10', '2025-11-19 01:39:31'),
(20, 1, 'galvis-0014', 'asdasd', NULL, 'sdasd', 'asda', 'asdasdasd', 'efectivo', NULL, 1232212.00, 3.00, 0.00, 1232215.00, '', '2025-11-19 01:39:20', '2025-11-18 20:39:20', '2025-11-19 01:39:37'),
(21, 1, 'galvis-0015', 'asdasd', NULL, '21341241234', 'asd', 'asdasdasd', 'efectivo', NULL, 37.00, 3.00, 0.00, 40.00, '', '2025-11-19 02:35:19', '2025-11-18 21:35:19', '2025-11-19 02:35:35'),
(22, 1, 'galvis-0016', 'aasdasd', NULL, '23234234', 'asdasdasd', 'asdasd', 'efectivo', NULL, 203.50, 3.00, 0.00, 206.50, '', '2025-11-19 02:38:33', '2025-11-18 21:38:33', '2025-11-19 02:39:10'),
(23, 1, 'galvis-0017', 'asdasd', NULL, '23423423', 'asdasdasd', 'asdasdasd', 'efectivo', NULL, 74.00, 3.00, 0.00, 77.00, 'enviado', '2025-11-19 02:40:51', '2025-11-18 21:40:51', '2025-11-19 02:41:07'),
(24, 1, 'galvis-0018', 'asdasd', NULL, '324234', 'sdasdsa', 'dasdasd', 'efectivo', NULL, 37.00, 3.00, 0.00, 40.00, 'enviado', '2025-11-20 04:39:14', '2025-11-19 23:39:14', '2025-11-20 04:39:35'),
(25, 1, 'galvis-0019', 'asdasd', NULL, '324234', 'asdasd', 'asdasd', 'efectivo', NULL, 55.50, 3.00, 0.00, 58.50, 'cancelado', '2025-11-20 04:42:03', '2025-11-19 23:42:03', '2025-11-20 04:44:54'),
(26, 1, 'galvis-0020', 'sadasd', NULL, '345435', 'sadasda', 'aasdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'enviado', '2025-11-20 04:43:43', '2025-11-19 23:43:43', '2025-11-20 04:44:56'),
(27, 1, 'galvis-0021', 'asdasd', NULL, '23423', 'sdasd', '23423', 'efectivo', NULL, 37.00, 3.00, 0.00, 40.00, 'enviado', '2025-11-20 04:44:32', '2025-11-19 23:44:32', '2025-11-20 04:44:52'),
(28, 1, 'galvis-0022', 'asdasd', NULL, '23423', 'asdasd', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'cancelado', '2025-11-20 04:45:21', '2025-11-19 23:45:21', '2025-11-20 05:22:24'),
(29, 1, 'galvis-0023', 'asdasd', NULL, '324', 'asdasd', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'cancelado', '2025-11-20 04:47:15', '2025-11-19 23:47:15', '2025-11-20 05:22:19'),
(30, 1, 'galvis-0024', 'sadasd', NULL, '23424323', 'asdasd', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'cancelado', '2025-11-20 04:47:26', '2025-11-19 23:47:26', '2025-11-20 05:22:22'),
(31, 1, 'galvis-0025', 'sdcsadf', NULL, '345345345', 'dfsdfsdf', 'sdfsdfdsf', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'pendiente', '2025-11-20 05:25:43', '2025-11-20 00:25:43', '2025-11-20 00:25:43'),
(32, 1, 'galvis-0026', 'asdas', NULL, '23423', 'asdasd', 'asdasd', 'efectivo', NULL, 18.50, 3.00, 0.00, 21.50, 'pendiente', '2025-11-20 05:26:52', '2025-11-20 00:26:52', '2025-11-20 00:26:52'),
(33, 1, 'galvis-0027', 'asdsa', NULL, '23423', 'asdasd', 'asdasd', 'efectivo', NULL, 8.00, 3.00, 0.00, 11.00, 'pendiente', '2025-11-20 19:40:27', '2025-11-20 14:40:27', '2025-11-20 14:40:27'),
(34, 1, 'galvis-0028', 'asdasd', NULL, '3234234', 'sfdads', 'asdasd', 'efectivo', NULL, 1212246.50, 3.00, 0.00, 1212249.50, 'enviado', '2025-11-22 00:41:09', '2025-11-21 19:41:09', '2025-11-22 00:41:26'),
(35, 2, 'pizzer-0005', 'asdasd', NULL, '2342342342', 'asdasd', 'asdasdasd', 'efectivo', NULL, 65.00, 3.00, 0.00, 68.00, 'enviado', '2025-11-23 01:28:52', '2025-11-22 20:28:52', '2025-11-23 01:29:09'),
(36, 2, 'pizzer-0006', 'asda', NULL, '23234234', 'asdasd', 'asdasd', 'efectivo', NULL, 100000.00, 3.00, 0.00, 100003.00, 'enviado', '2025-11-23 03:03:45', '2025-11-22 22:03:45', '2025-11-23 03:04:34');

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
  `notas` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedido_items`
--

INSERT INTO `pedido_items` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`, `notas`, `created_at`) VALUES
(1, 1, 1, 1, 18.50, 18.50, NULL, '2025-11-16 22:51:14'),
(3, 1, 2, 1, 8.00, 8.00, NULL, '2025-11-16 22:51:14'),
(4, 2, 1, 1, 18.50, 18.50, NULL, '2025-11-16 22:51:14'),
(6, 3, 4, 2, 12.00, 24.00, NULL, '2025-11-16 22:51:14'),
(7, 3, 5, 1, 14.50, 14.50, NULL, '2025-11-16 22:51:14'),
(8, 3, 6, 1, 16.00, 16.00, NULL, '2025-11-16 22:51:14'),
(9, 4, 4, 1, 12.00, 12.00, NULL, '2025-11-16 22:51:14'),
(10, 4, 6, 1, 16.00, 16.00, NULL, '2025-11-16 22:51:14'),
(11, 5, 7, 1, 28.00, 28.00, NULL, '2025-11-16 22:51:14'),
(12, 5, 8, 1, 15.00, 15.00, NULL, '2025-11-16 22:51:14'),
(13, 5, 9, 1, 22.00, 22.00, NULL, '2025-11-16 22:51:14'),
(14, 1, 1, 1, 18.50, 18.50, NULL, '2025-11-16 23:34:46'),
(16, 1, 2, 1, 8.00, 8.00, NULL, '2025-11-16 23:34:46'),
(17, 2, 1, 1, 18.50, 18.50, NULL, '2025-11-16 23:34:46'),
(19, 14, 1, 2, 18.50, 37.00, NULL, '2025-11-18 20:29:04'),
(20, 15, 1, 1, 18.50, 18.50, NULL, '2025-11-18 20:30:04'),
(21, 15, 10, 1, 18.50, 18.50, NULL, '2025-11-18 20:30:04'),
(22, 16, 1, 1, 18.50, 18.50, NULL, '2025-11-18 20:30:22'),
(23, 17, 1, 1, 18.50, 18.50, NULL, '2025-11-18 20:33:00'),
(24, 18, 1, 1, 18.50, 18.50, NULL, '2025-11-18 20:39:02'),
(25, 19, 10, 3, 18.50, 55.50, NULL, '2025-11-18 20:39:10'),
(26, 20, 19, 1, 1212212.00, 1212212.00, NULL, '2025-11-18 20:39:20'),
(27, 20, 20, 1, 20000.00, 20000.00, NULL, '2025-11-18 20:39:20'),
(28, 21, 1, 2, 18.50, 37.00, NULL, '2025-11-18 21:35:19'),
(29, 22, 10, 6, 18.50, 111.00, NULL, '2025-11-18 21:38:33'),
(30, 22, 1, 5, 18.50, 92.50, NULL, '2025-11-18 21:38:33'),
(31, 23, 1, 4, 18.50, 74.00, NULL, '2025-11-18 21:40:51'),
(32, 24, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:39:14'),
(33, 24, 10, 1, 18.50, 18.50, NULL, '2025-11-19 23:39:14'),
(34, 25, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:42:03'),
(35, 25, 10, 2, 18.50, 37.00, NULL, '2025-11-19 23:42:03'),
(36, 26, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:43:43'),
(37, 27, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:44:32'),
(38, 27, 10, 1, 18.50, 18.50, NULL, '2025-11-19 23:44:32'),
(39, 28, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:45:21'),
(40, 29, 1, 1, 18.50, 18.50, NULL, '2025-11-19 23:47:15'),
(41, 30, 10, 1, 18.50, 18.50, NULL, '2025-11-19 23:47:26'),
(42, 31, 1, 1, 18.50, 18.50, NULL, '2025-11-20 00:25:43'),
(43, 32, 1, 1, 18.50, 18.50, NULL, '2025-11-20 00:26:52'),
(44, 33, 2, 1, 8.00, 8.00, NULL, '2025-11-20 14:40:27'),
(45, 34, 19, 1, 1212212.00, 1212212.00, NULL, '2025-11-21 19:41:09'),
(46, 34, 11, 1, 8.00, 8.00, NULL, '2025-11-21 19:41:09'),
(47, 34, 10, 1, 18.50, 18.50, NULL, '2025-11-21 19:41:09'),
(48, 34, 2, 1, 8.00, 8.00, NULL, '2025-11-21 19:41:09'),
(49, 35, 4, 2, 12.00, 24.00, NULL, '2025-11-22 20:28:52'),
(50, 35, 5, 2, 14.50, 29.00, NULL, '2025-11-22 20:28:52'),
(51, 35, 13, 1, 12.00, 12.00, NULL, '2025-11-22 20:28:52'),
(52, 36, 21, 1, 100000.00, 100000.00, NULL, '2025-11-22 22:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `limite_productos` int(11) NOT NULL DEFAULT -1,
  `caracteristicas` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `nombre`, `precio`, `limite_productos`, `caracteristicas`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Plan Gratuito', 0.00, 10, 'Gestión básica de productos\nSoporte por email\nReportes básicos', 1, '2025-11-17 05:07:18', '2025-11-17 05:07:18'),
(2, 'Plan Básico', 29900.00, 100, 'Gestión básica de productos\nSoporte por email\nReportes básicos\nHasta 100 productos', 1, '2025-11-17 05:07:18', '2025-11-18 03:59:50'),
(3, 'Plan Pro', 59900.00, 500, 'Gestión completa de productos\nSoporte prioritario\nReportes avanzados\nIntegraciones básicas\nHasta 500 productos\nPromociones', 1, '2025-11-17 05:07:18', '2025-11-18 03:59:50'),
(4, 'Plan Enterprise', 99900.00, -1, 'Productos ilimitados\nSoporte 24/7\nReportes personalizados\nIntegraciones avanzadas\nAPI completa\nConsultoría incluida', 1, '2025-11-17 05:07:18', '2025-11-18 03:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `destacado` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `empresa_id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `activo`, `destacado`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, '1763447556_ec48ce2325d413782992.jpg', 'Platos principales', 1, 1, '2025-11-16 22:51:14', '2025-11-20 22:18:21'),
(2, 1, 7, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, '1763447575_cba6c52f931fe6f2b16c.jpg', 'Entrantes', 1, 1, '2025-11-16 22:51:14', '2025-11-20 22:18:24'),
(4, 2, 8, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, NULL, 'Pizzas', 1, 1, '2025-11-16 22:51:14', '2025-11-23 01:28:35'),
(5, 2, 8, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, NULL, 'Pizzas', 1, 1, '2025-11-16 22:51:14', '2025-11-23 01:28:36'),
(6, 2, 9, 'Lasaña Boloñesa', 'Lasaña tradicional italiana', 16.00, NULL, 'Pasta', 1, 0, '2025-11-16 22:51:14', '2025-11-18 01:18:45'),
(7, 4, 10, 'Parrillada de Mariscos', 'Selección de mariscos a la parrilla', 28.00, NULL, 'Mariscos', 1, 0, '2025-11-16 22:51:14', '2025-11-18 01:18:45'),
(8, 4, 11, 'Ceviche Peruano', 'Pescado marinado en limón', 15.00, NULL, 'Entrantes', 1, 0, '2025-11-16 22:51:14', '2025-11-18 01:18:45'),
(9, 4, 12, 'Arroz con Mariscos', 'Arroz con variedad de mariscos', 22.00, NULL, 'Platos principales', 1, 0, '2025-11-16 22:51:14', '2025-11-18 01:18:45'),
(10, 1, 6, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, '1763447565_871b1063428fa6677434.jpeg', 'Platos principales', 1, 1, '2025-11-16 23:34:46', '2025-11-20 22:18:22'),
(11, 1, 7, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, '1763447585_88667ffb3952ae2bf490.jpg', 'Entrantes', 1, 1, '2025-11-16 23:34:46', '2025-11-20 22:18:25'),
(13, 2, 8, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, NULL, 'Pizzas', 1, 1, '2025-11-16 23:34:46', '2025-11-23 01:28:37'),
(14, 2, 8, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, NULL, 'Pizzas', 1, 0, '2025-11-16 23:34:46', '2025-11-18 01:18:45'),
(15, 2, 9, 'Lasaña Boloñesa', 'Lasaña tradicional italiana', 16.00, NULL, 'Pasta', 1, 0, '2025-11-16 23:34:46', '2025-11-18 01:18:45'),
(16, 4, 10, 'Parrillada de Mariscos', 'Selección de mariscos a la parrilla', 28.00, NULL, 'Mariscos', 1, 0, '2025-11-16 23:34:46', '2025-11-18 01:18:45'),
(17, 4, 11, 'Ceviche Peruano', 'Pescado marinado en limón', 15.00, NULL, 'Entrantes', 1, 0, '2025-11-16 23:34:46', '2025-11-18 01:18:45'),
(18, 4, 12, 'Arroz con Mariscos', 'Arroz con variedad de mariscos', 22.00, NULL, 'Platos principales', 1, 0, '2025-11-16 23:34:46', '2025-11-18 01:18:45'),
(19, 1, 2, 'PROGRAMACION dkajshdahsdiahdiajsdñakjsdlkajsd{lakjdslakdasdasdads', 'asdasdasdxcbdbzdbzdhb5r6u457435i7623iu095834tj938jt9824jwewe\r\n\r\nwer\r\nwer\r\nwe\r\nrw\r\nere\r\nwr\r\n', 1212212.00, '1763437426_c75eb5b32759b1bb1793.jpeg', NULL, 1, 1, '2025-11-18 03:38:28', '2025-11-20 20:51:08'),
(20, 1, 2, 'Torta fria de arequipe', 'torta fria que viene decorada con arequipe, deliciosa', 20000.00, '1763446907_24cc91e68b0fe6cf53d6.jpg', NULL, 1, 1, '2025-11-18 06:21:47', '2025-11-20 22:18:19'),
(21, 2, 13, 'gato suizo en pizza', 'es pizza pero con gato suizo', 100000.00, '1763866912_4b6177902e566245b166.png', NULL, 1, 0, '2025-11-23 03:01:52', '2025-11-23 03:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `posicion` enum('hero','sidebar','footer') NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promociones`
--

INSERT INTO `promociones` (`id`, `empresa_id`, `titulo`, `descripcion`, `descuento`, `fecha_inicio`, `fecha_fin`, `posicion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Descuento Especial 20%', 'Promoción especial para nuevos clientes', 20, '2024-01-01', '2024-03-31', 'hero', 1, '2025-11-17 05:28:31', '2025-11-17 05:28:31'),
(2, 2, 'Menú del Día', 'Oferta especial de menú completo', 15, '2024-01-15', '2024-02-15', 'sidebar', 1, '2025-11-17 05:28:31', '2025-11-17 05:28:31'),
(3, 1, 'Descuento Especial 20%', 'Promoción especial', 20, '2024-01-01', '2024-03-31', 'hero', 1, '2025-11-17 05:34:04', '2025-11-17 05:34:04');

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
(1, NULL, 'Super Administrador', 'superadmin@comeya.com', '$2y$10$6iGPu8o4sFIWqhgq4GUcauyFid0ey6sy8ceJUJ8To5CNac9erx8f.', 'superadmin', 1, '2025-11-16 18:43:33', '2025-11-18 04:10:36'),
(2, 1, 'Admin Galvis', 'admin@galvis.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin_empresa', 1, '2025-11-17 23:09:44', '2025-11-17 23:09:44'),
(3, 1, 'mesero', 'mesero@gmail.com', '$2y$10$ghePMxeOBH1dr4Aohy9uMuT0GBapzNyodh4CjSUnWMudeBQGT/PTq', 'admin_empresa', 1, '2025-11-18 04:48:56', '2025-11-18 04:48:56');

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
  `dispositivo` enum('mobile','desktop','tablet') DEFAULT 'desktop',
  `navegador` varchar(50) DEFAULT 'unknown',
  `origen` enum('qr','social','web','direct','other') DEFAULT 'direct',
  `fecha_visita` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitas`
--

INSERT INTO `visitas` (`id`, `empresa_id`, `ip`, `user_agent`, `dispositivo`, `navegador`, `origen`, `fecha_visita`, `created_at`, `updated_at`) VALUES
(1, 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'desktop', 'Chrome', 'web', '2024-01-15 10:30:00', '2025-11-16 18:43:33', '2025-11-16 23:43:44'),
(2, 1, '192.168.1.101', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)', 'mobile', 'Safari', 'qr', '2024-01-15 11:45:00', '2025-11-16 18:43:33', '2025-11-16 23:43:44'),
(3, 2, '192.168.1.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)', 'desktop', 'Safari', 'social', '2024-01-16 09:15:00', '2025-11-16 18:43:33', '2025-11-16 23:43:44'),
(4, 2, '192.168.1.103', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0)', 'mobile', 'Firefox', 'qr', '2024-01-16 16:20:00', '2025-11-16 18:43:33', '2025-11-16 23:43:44'),
(5, 4, '192.168.1.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', 'desktop', 'Edge', 'web', '2024-01-17 12:10:00', '2025-11-16 18:43:33', '2025-11-16 23:43:44'),
(6, 1, '192.168.1.110', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'qr', '2025-11-16 00:00:00', '2025-11-16 23:43:44', '2025-11-16 23:43:44'),
(7, 2, '192.168.1.111', 'Mozilla/5.0 (Windows)', 'desktop', 'Chrome', 'social', '2025-11-16 00:00:00', '2025-11-16 23:43:44', '2025-11-16 23:43:44'),
(8, 1, '192.168.1.112', 'Mozilla/5.0 (iPad)', 'tablet', 'Safari', 'web', '2025-11-16 00:00:00', '2025-11-16 23:43:44', '2025-11-16 23:43:44'),
(9, 4, '192.168.1.113', 'Mozilla/5.0 (Android)', 'mobile', 'Firefox', 'qr', '2025-11-16 00:00:00', '2025-11-16 23:43:44', '2025-11-16 23:43:44'),
(10, 2, '192.168.1.114', 'Mozilla/5.0 (Windows)', 'desktop', 'Edge', 'direct', '2025-11-16 00:00:00', '2025-11-16 23:43:44', '2025-11-16 23:43:44'),
(11, 1, '192.168.1.115', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'social', '2025-11-15 09:15:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(12, 3, '192.168.1.116', 'Mozilla/5.0 (Windows)', 'desktop', 'Chrome', 'web', '2025-11-15 12:40:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(13, 4, '192.168.1.117', 'Mozilla/5.0 (Android)', 'mobile', 'Chrome', 'qr', '2025-11-15 15:25:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(14, 2, '192.168.1.118', 'Mozilla/5.0 (iPad)', 'tablet', 'Safari', 'direct', '2025-11-14 11:20:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(15, 1, '192.168.1.119', 'Mozilla/5.0 (Windows)', 'desktop', 'Firefox', 'social', '2025-11-14 17:45:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(16, 3, '192.168.1.120', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'qr', '2025-11-13 13:30:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38'),
(17, 4, '192.168.1.121', 'Mozilla/5.0 (Windows)', 'desktop', 'Edge', 'web', '2025-11-13 19:15:00', '2025-11-16 23:48:38', '2025-11-16 23:48:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanas`
--
ALTER TABLE `campanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_categorias_empresa` (`empresa_id`),
  ADD KEY `idx_categorias_orden` (`orden`);

--
-- Indexes for table `codigos_referidos`
--
ALTER TABLE `codigos_referidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `destacados`
--
ALTER TABLE `destacados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `email_campanas`
--
ALTER TABLE `email_campanas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `material_promocional`
--
ALTER TABLE `material_promocional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_numero_pedido` (`numero_pedido`),
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
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_productos_empresa` (`empresa_id`),
  ADD KEY `idx_productos_categoria` (`categoria`),
  ADD KEY `productos_categoria_fk` (`categoria_id`);

--
-- Indexes for table `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`);

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
  ADD KEY `idx_visitas_fecha` (`fecha_visita`),
  ADD KEY `idx_visitas_dispositivo` (`dispositivo`),
  ADD KEY `idx_visitas_navegador` (`navegador`),
  ADD KEY `idx_visitas_origen` (`origen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campanas`
--
ALTER TABLE `campanas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `codigos_referidos`
--
ALTER TABLE `codigos_referidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `destacados`
--
ALTER TABLE `destacados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_campanas`
--
ALTER TABLE `email_campanas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `material_promocional`
--
ALTER TABLE `material_promocional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pedido_items`
--
ALTER TABLE `pedido_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destacados`
--
ALTER TABLE `destacados`
  ADD CONSTRAINT `destacados_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `destacados_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `productos_categoria_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

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
