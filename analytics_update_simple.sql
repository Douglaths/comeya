-- Actualización simple para Analytics
USE comeya;

-- Agregar campos a la tabla visitas
ALTER TABLE visitas 
ADD COLUMN dispositivo ENUM('mobile', 'desktop', 'tablet') DEFAULT 'desktop' AFTER user_agent,
ADD COLUMN navegador VARCHAR(50) DEFAULT 'unknown' AFTER dispositivo,
ADD COLUMN origen ENUM('qr', 'social', 'web', 'direct', 'other') DEFAULT 'direct' AFTER navegador;

-- Actualizar registros existentes con datos de ejemplo
UPDATE visitas SET 
    dispositivo = 'desktop', 
    navegador = 'Chrome', 
    origen = 'web' 
WHERE id = 1;

UPDATE visitas SET 
    dispositivo = 'mobile', 
    navegador = 'Safari', 
    origen = 'qr' 
WHERE id = 2;

UPDATE visitas SET 
    dispositivo = 'desktop', 
    navegador = 'Safari', 
    origen = 'social' 
WHERE id = 3;

UPDATE visitas SET 
    dispositivo = 'mobile', 
    navegador = 'Firefox', 
    origen = 'qr' 
WHERE id = 4;

UPDATE visitas SET 
    dispositivo = 'desktop', 
    navegador = 'Edge', 
    origen = 'web' 
WHERE id = 5;

-- Insertar más visitas con fechas actuales (noviembre 2025)
INSERT INTO visitas (empresa_id, ip, user_agent, dispositivo, navegador, origen, fecha_visita) VALUES
(1, '192.168.1.110', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'qr', '2025-11-16 10:30:00'),
(2, '192.168.1.111', 'Mozilla/5.0 (Windows)', 'desktop', 'Chrome', 'social', '2025-11-16 11:45:00'),
(1, '192.168.1.112', 'Mozilla/5.0 (iPad)', 'tablet', 'Safari', 'web', '2025-11-16 14:20:00'),
(4, '192.168.1.113', 'Mozilla/5.0 (Android)', 'mobile', 'Firefox', 'qr', '2025-11-16 16:10:00'),
(2, '192.168.1.114', 'Mozilla/5.0 (Windows)', 'desktop', 'Edge', 'direct', '2025-11-16 18:30:00'),
(1, '192.168.1.115', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'social', '2025-11-15 09:15:00'),
(3, '192.168.1.116', 'Mozilla/5.0 (Windows)', 'desktop', 'Chrome', 'web', '2025-11-15 12:40:00'),
(4, '192.168.1.117', 'Mozilla/5.0 (Android)', 'mobile', 'Chrome', 'qr', '2025-11-15 15:25:00'),
(2, '192.168.1.118', 'Mozilla/5.0 (iPad)', 'tablet', 'Safari', 'direct', '2025-11-14 11:20:00'),
(1, '192.168.1.119', 'Mozilla/5.0 (Windows)', 'desktop', 'Firefox', 'social', '2025-11-14 17:45:00'),
(3, '192.168.1.120', 'Mozilla/5.0 (iPhone)', 'mobile', 'Safari', 'qr', '2025-11-13 13:30:00'),
(4, '192.168.1.121', 'Mozilla/5.0 (Windows)', 'desktop', 'Edge', 'web', '2025-11-13 19:15:00');

-- Crear índices
CREATE INDEX idx_visitas_dispositivo ON visitas(dispositivo);
CREATE INDEX idx_visitas_navegador ON visitas(navegador);
CREATE INDEX idx_visitas_origen ON visitas(origen);