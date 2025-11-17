<?php
// Prueba de conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'comeya';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    echo "✅ Conexión exitosa a la base de datos 'comeya'<br>";
    
    // Probar consulta
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM empresas");
    $result = $stmt->fetch();
    echo "📊 Total de empresas: " . $result['total'];
    
} catch(PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
?>