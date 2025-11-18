-- Actualizar categoria_id basado en el campo categoria existente
UPDATE productos p 
SET categoria_id = (
    SELECT c.id 
    FROM categorias c 
    WHERE c.empresa_id = p.empresa_id 
    AND LOWER(c.nombre COLLATE utf8mb4_unicode_ci) = LOWER(p.categoria COLLATE utf8mb4_unicode_ci)
    LIMIT 1
)
WHERE p.categoria IS NOT NULL 
AND p.categoria != '';

-- Crear categorías faltantes para productos sin categoria_id
INSERT INTO categorias (empresa_id, nombre, descripcion, orden, activo)
SELECT DISTINCT 
    p.empresa_id,
    p.categoria,
    CONCAT('Categoría ', p.categoria),
    (SELECT COALESCE(MAX(orden), 0) + 1 FROM categorias WHERE empresa_id = p.empresa_id),
    1
FROM productos p
WHERE p.categoria IS NOT NULL 
AND p.categoria != ''
AND p.categoria_id IS NULL
AND NOT EXISTS (
    SELECT 1 FROM categorias c 
    WHERE c.empresa_id = p.empresa_id 
    AND LOWER(c.nombre COLLATE utf8mb4_unicode_ci) = LOWER(p.categoria COLLATE utf8mb4_unicode_ci)
);

-- Actualizar categoria_id para productos que aún no lo tienen
UPDATE productos p 
SET categoria_id = (
    SELECT c.id 
    FROM categorias c 
    WHERE c.empresa_id = p.empresa_id 
    AND LOWER(c.nombre COLLATE utf8mb4_unicode_ci) = LOWER(p.categoria COLLATE utf8mb4_unicode_ci)
    LIMIT 1
)
WHERE p.categoria IS NOT NULL 
AND p.categoria != ''
AND p.categoria_id IS NULL;