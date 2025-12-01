ALTER TABLE empresas 
ADD COLUMN logo VARCHAR(255) NULL AFTER categoria_comida,
ADD COLUMN foto_presentacion VARCHAR(255) NULL AFTER logo;