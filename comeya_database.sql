-- Base de datos para el sistema Comeya
-- Crear base de datos
CREATE DATABASE IF NOT EXISTS comeya CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE comeya;

-- Tabla de empresas
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion TEXT,
    activo TINYINT(1) DEFAULT 1,
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de usuarios (superadmin y usuarios de empresas)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NULL,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('superadmin', 'admin_empresa', 'usuario') DEFAULT 'usuario',
    activo TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Tabla de ventas
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    fecha_venta DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Tabla de visitas
CREATE TABLE visitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    ip VARCHAR(45) NOT NULL,
    user_agent TEXT,
    fecha_visita DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Insertar datos de ejemplo
INSERT INTO empresas (nombre, email, telefono, direccion, activo) VALUES
('Restaurante El Buen Sabor', 'contacto@elbuensabor.com', '555-0001', 'Calle Principal 123', 1),
('Pizzería Don Mario', 'info@donmario.com', '555-0002', 'Avenida Central 456', 1),
('Café Central', 'hola@cafecentral.com', '555-0003', 'Plaza Mayor 789', 0),
('Mariscos La Costa', 'ventas@lacosta.com', '555-0004', 'Malecón 321', 1);

-- Insertar usuario superadmin
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Super Administrador', 'superadmin@comeya.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin');

-- Insertar algunos datos de ejemplo para ventas
INSERT INTO ventas (empresa_id, total, fecha_venta) VALUES
(1, 1250.50, '2024-01-15 14:30:00'),
(1, 890.75, '2024-01-16 19:45:00'),
(2, 2100.00, '2024-01-15 20:15:00'),
(2, 1650.25, '2024-01-17 13:20:00'),
(4, 3200.80, '2024-01-16 21:00:00');

-- Insertar algunos datos de ejemplo para visitas
INSERT INTO visitas (empresa_id, ip, user_agent, fecha_visita) VALUES
(1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2024-01-15 10:30:00'),
(1, '192.168.1.101', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)', '2024-01-15 11:45:00'),
(2, '192.168.1.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)', '2024-01-16 09:15:00'),
(2, '192.168.1.103', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0)', '2024-01-16 16:20:00'),
(4, '192.168.1.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2024-01-17 12:10:00');

-- Índices para mejorar rendimiento
CREATE INDEX idx_empresas_activo ON empresas(activo);
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_usuarios_empresa ON usuarios(empresa_id);
CREATE INDEX idx_ventas_empresa ON ventas(empresa_id);
CREATE INDEX idx_ventas_fecha ON ventas(fecha_venta);
CREATE INDEX idx_visitas_empresa ON visitas(empresa_id);
CREATE INDEX idx_visitas_fecha ON visitas(fecha_visita);