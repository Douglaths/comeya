<?php
// Simple script to create ventas tables
$host = 'localhost';
$dbname = 'comeya';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create productos table
    $pdo->exec("CREATE TABLE IF NOT EXISTS productos (
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
    )");
    
    // Create pedidos table
    $pdo->exec("CREATE TABLE IF NOT EXISTS pedidos (
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
    )");
    
    // Create pedido_items table
    $pdo->exec("CREATE TABLE IF NOT EXISTS pedido_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pedido_id INT NOT NULL,
        producto_id INT NOT NULL,
        cantidad INT NOT NULL,
        precio_unitario DECIMAL(10,2) NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
        FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
    )");
    
    // Insert sample data if tables are empty
    $count = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
    if ($count == 0) {
        // Insert sample products
        $pdo->exec("INSERT INTO productos (empresa_id, nombre, descripcion, precio, categoria) VALUES
            (1, 'Paella Valenciana', 'Paella tradicional con pollo y verduras', 18.50, 'Platos principales'),
            (1, 'Gazpacho Andaluz', 'Sopa fría tradicional', 8.00, 'Entrantes'),
            (2, 'Pizza Margherita', 'Pizza con tomate, mozzarella y albahaca', 12.00, 'Pizzas'),
            (2, 'Pizza Pepperoni', 'Pizza con pepperoni y queso', 14.50, 'Pizzas')");
        
        // Insert sample orders
        $pdo->exec("INSERT INTO pedidos (empresa_id, numero_pedido, cliente_nombre, cliente_email, subtotal, impuestos, total, estado, fecha_pedido) VALUES
            (1, 'PED-001', 'Juan Pérez', 'juan@email.com', 32.00, 3.36, 35.36, 'completado', '2024-01-15 14:30:00'),
            (2, 'PED-002', 'María García', 'maria@email.com', 24.00, 2.52, 26.52, 'completado', '2024-01-16 19:45:00')");
        
        // Insert order items
        $pdo->exec("INSERT INTO pedido_items (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES
            (1, 1, 1, 18.50, 18.50),
            (1, 2, 1, 8.00, 8.00),
            (2, 3, 2, 12.00, 24.00)");
    }
    
    echo "Tables created successfully!";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>