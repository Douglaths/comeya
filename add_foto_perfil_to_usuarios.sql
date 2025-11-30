USE comeya;

-- Agregar campo foto_perfil a la tabla usuarios
ALTER TABLE usuarios ADD COLUMN foto_perfil VARCHAR(255) DEFAULT NULL;