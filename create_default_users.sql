USE comeya;

-- Crear usuarios por defecto para empresas existentes que no tengan usuario
INSERT INTO usuarios (empresa_id, nombre, email, password, rol, activo)
SELECT 
    e.id,
    CONCAT('Admin ', e.nombre),
    e.email,
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: password
    'administrador',
    1
FROM empresas e
LEFT JOIN usuarios u ON e.id = u.empresa_id
WHERE u.id IS NULL;