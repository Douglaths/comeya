<?php
// Prueba del módulo de empresas
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'comeya';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    echo "✅ Conexión exitosa<br>";
    
    // Verificar si existen las columnas nuevas
    $stmt = $pdo->query("DESCRIBE empresas");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Columnas en tabla empresas:</h3>";
    foreach($columns as $column) {
        echo "- $column<br>";
    }
    
    // Verificar si existe la columna 'ciudad'
    if (in_array('ciudad', $columns)) {
        echo "<br>✅ Tabla actualizada correctamente";
        
        // Probar consulta de empresas
        $stmt = $pdo->query("SELECT * FROM empresas LIMIT 3");
        $empresas = $stmt->fetchAll();
        
        echo "<h3>Empresas de ejemplo:</h3>";
        foreach($empresas as $empresa) {
            echo "- {$empresa['nombre']} ({$empresa['ciudad']}) - Plan: {$empresa['plan']}<br>";
        }
    } else {
        echo "<br>❌ Falta ejecutar empresas_update.sql";
    }
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>