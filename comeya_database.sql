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

-- Actualización de la base de datos para el módulo de empresas
USE comeya;

-- Agregar campos adicionales a la tabla empresas
ALTER TABLE empresas 
ADD COLUMN ciudad VARCHAR(100) AFTER direccion,
ADD COLUMN plan ENUM('basico', 'premium', 'enterprise') DEFAULT 'basico' AFTER ciudad,
ADD COLUMN estado ENUM('activo', 'inactivo', 'suspendido', 'trial') DEFAULT 'activo' AFTER plan,
ADD COLUMN fecha_trial_fin DATE NULL AFTER estado,
ADD COLUMN limite_productos INT DEFAULT 50 AFTER fecha_trial_fin;

-- Actualizar empresas existentes con datos de ejemplo
UPDATE empresas SET 
    ciudad = 'Madrid', 
    plan = 'premium', 
    estado = 'activo' 
WHERE id = 1;

UPDATE empresas SET 
    ciudad = 'Barcelona', 
    plan = 'basico', 
    estado = 'activo' 
WHERE id = 2;

UPDATE empresas SET 
    ciudad = 'Valencia', 
    plan = 'basico', 
    estado = 'inactivo' 
WHERE id = 3;

UPDATE empresas SET 
    ciudad = 'Sevilla', 
    plan = 'enterprise', 
    estado = 'trial',
    fecha_trial_fin = DATE_ADD(CURDATE(), INTERVAL 15 DAY)
WHERE id = 4;

-- Insertar más empresas de ejemplo
INSERT INTO empresas (nombre, email, telefono, direccion, ciudad, plan, estado, fecha_trial_fin, limite_productos) VALUES
('Burger King Express', 'admin@burgerexpress.com', '555-0005', 'Gran Vía 25', 'Madrid', 'premium', 'activo', NULL, 100),
('Sushi Zen', 'contacto@sushizen.com', '555-0006', 'Paseo de Gracia 88', 'Barcelona', 'basico', 'trial', DATE_ADD(CURDATE(), INTERVAL 7 DAY), 25),
('Taco Loco', 'info@tacoloco.com', '555-0007', 'Calle Sierpes 15', 'Sevilla', 'basico', 'suspendido', NULL, 25);

-- Crear índices adicionales
CREATE INDEX idx_empresas_ciudad ON empresas(ciudad);
CREATE INDEX idx_empresas_plan ON empresas(plan);
CREATE INDEX idx_empresas_estado ON empresas(estado);

-- Módulo de ventas para Comeya
USE comeya;

-- Tabla de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(100),
    activo TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Tabla de pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    numero_pedido VARCHAR(50) NOT NULL,
    cliente_nombre VARCHAR(255),
    cliente_email VARCHAR(255),
    cliente_telefono VARCHAR(20),
    subtotal DECIMAL(10,2) NOT NULL,
    impuestos DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'procesando', 'completado', 'cancelado') DEFAULT 'pendiente',
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Tabla de items de pedidos
CREATE TABLE pedido_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

-- Insertar productos de ejemplo
INSERT INTO productos (empresa_id, nombre, descripcion, precio, categoria) VALUES
(1, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, 'Platos principales'),
(1, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, 'Entrantes'),
(1, 'Flan Casero', 'Postre tradicional español', 5.50, 'Postres'),
(2, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, 'Pizzas'),
(2, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, 'Pizzas'),
(2, 'Lasaña Boloñesa', 'Lasaña tradicional italiana', 16.00, 'Pasta'),
(4, 'Parrillada de Mariscos', 'Selección de mariscos a la parrilla', 28.00, 'Mariscos'),
(4, 'Ceviche Peruano', 'Pescado marinado en limón', 15.00, 'Entrantes'),
(4, 'Arroz con Mariscos', 'Arroz con variedad de mariscos', 22.00, 'Platos principales');

-- Insertar pedidos de ejemplo
INSERT INTO pedidos (empresa_id, numero_pedido, cliente_nombre, cliente_email, cliente_telefono, subtotal, impuestos, total, estado, fecha_pedido) VALUES
(1, 'PED-001', 'Juan Pérez', 'juan@email.com', '666-111-222', 32.00, 3.36, 35.36, 'completado', '2024-01-15 14:30:00'),
(1, 'PED-002', 'María García', 'maria@email.com', '666-333-444', 24.00, 2.52, 26.52, 'completado', '2024-01-16 19:45:00'),
(2, 'PED-003', 'Carlos López', 'carlos@email.com', '666-555-666', 42.50, 4.46, 46.96, 'completado', '2024-01-15 20:15:00'),
(2, 'PED-004', 'Ana Martín', 'ana@email.com', '666-777-888', 28.00, 2.94, 30.94, 'procesando', '2024-01-17 13:20:00'),
(4, 'PED-005', 'Luis Rodríguez', 'luis@email.com', '666-999-000', 65.00, 6.83, 71.83, 'completado', '2024-01-16 21:00:00');

-- Insertar items de pedidos
INSERT INTO pedido_items (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES
(1, 1, 1, 18.50, 18.50),
(1, 3, 2, 5.50, 11.00),
(1, 2, 1, 8.00, 8.00),
(2, 1, 1, 18.50, 18.50),
(2, 3, 1, 5.50, 5.50),
(3, 4, 2, 12.00, 24.00),
(3, 5, 1, 14.50, 14.50),
(3, 6, 1, 16.00, 16.00),
(4, 4, 1, 12.00, 12.00),
(4, 6, 1, 16.00, 16.00),
(5, 7, 1, 28.00, 28.00),
(5, 8, 1, 15.00, 15.00),
(5, 9, 1, 22.00, 22.00);

-- Índices para optimización
CREATE INDEX idx_productos_empresa ON productos(empresa_id);
CREATE INDEX idx_productos_categoria ON productos(categoria);
CREATE INDEX idx_pedidos_empresa ON pedidos(empresa_id);
CREATE INDEX idx_pedidos_fecha ON pedidos(fecha_pedido);
CREATE INDEX idx_pedidos_estado ON pedidos(estado);
CREATE INDEX idx_pedido_items_pedido ON pedido_items(pedido_id);
CREATE INDEX idx_pedido_items_producto ON pedido_items(producto_id);