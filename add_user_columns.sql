ALTER TABLE usuarios 
ADD COLUMN telefono VARCHAR(20) NULL AFTER email,
ADD COLUMN direccion TEXT NULL AFTER telefono;