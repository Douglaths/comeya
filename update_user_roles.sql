USE comeya;

-- Actualizar usuarios existentes para que tengan rol de administrador
UPDATE usuarios SET rol = 'administrador' WHERE rol IS NULL OR rol = '';