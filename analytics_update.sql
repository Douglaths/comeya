-- Actualización para módulo de Analytics
USE comeya;

-- Actualizar tabla visitas para analytics
ALTER TABLE visitas 
ADD COLUMN IF NOT EXISTS dispositivo ENUM('mobile', 'desktop', 'tablet') DEFAULT 'desktop' AFTER user_agent,
ADD COLUMN IF NOT EXISTS navegador VARCHAR(50) DEFAULT 'unknown' AFTER dispositivo,
ADD COLUMN IF NOT EXISTS origen ENUM('qr', 'social', 'web', 'direct', 'other') DEFAULT 'direct' AFTER navegador;

-- Insertar datos de ejemplo para visitas con nuevos campos
INSERT IGNORE INTO visitas (empresa_id, ip, user_agent, dispositivo, navegador, origen, fecha_visita) VALUES
(1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'desktop', 'Chrome', 'web', CURDATE()),
(1, '192.168.1.101', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)', 'mobile', 'Safari', 'qr', CURDATE()),
(2, '192.168.1.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)', 'desktop', 'Safari', 'social', CURDATE()),
(2, '192.168.1.103', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0)', 'mobile', 'Firefox', 'qr', DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
(4, '192.168.1.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', 'desktop', 'Edge', 'web', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
(1, '192.168.1.105', 'Mozilla/5.0 (iPad; CPU OS 14_0 like Mac OS X)', 'tablet', 'Safari', 'social', CURDATE()),
(3, '192.168.1.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'desktop', 'Chrome', 'direct', CURDATE()),
(1, '192.168.1.107', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)', 'mobile', 'Safari', 'qr', CURDATE()),
(2, '192.168.1.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', 'desktop', 'Chrome', 'social', CURDATE()),
(4, '192.168.1.109', 'Mozilla/5.0 (Android 12; Mobile; rv:68.0)', 'mobile', 'Firefox', 'web', CURDATE());

-- Crear índices adicionales para analytics
CREATE INDEX IF NOT EXISTS idx_visitas_dispositivo ON visitas(dispositivo);
CREATE INDEX IF NOT EXISTS idx_visitas_navegador ON visitas(navegador);
CREATE INDEX IF NOT EXISTS idx_visitas_origen ON visitas(origen);