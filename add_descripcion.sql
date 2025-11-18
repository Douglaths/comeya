-- Agregar campo descripción
ALTER TABLE `empresas` ADD COLUMN `descripcion` TEXT DEFAULT NULL AFTER `direccion`;

-- Actualizar con descripciones de ejemplo
UPDATE `empresas` SET `descripcion` = 'Especialistas en carnes a la brasa y parrilla argentina con los mejores cortes' WHERE `id` = 1;
UPDATE `empresas` SET `descripcion` = 'Pizza artesanal al horno de leña con recetas tradicionales napolitanas' WHERE `id` = 2;
UPDATE `empresas` SET `descripcion` = 'Café de especialidad con ambiente acogedor y repostería artesanal' WHERE `id` = 3;
UPDATE `empresas` SET `descripcion` = 'Mariscos frescos del día preparados con técnicas tradicionales' WHERE `id` = 4;
UPDATE `empresas` SET `descripcion` = 'Hamburguesas gourmet con ingredientes premium y papas artesanales' WHERE `id` = 5;
UPDATE `empresas` SET `descripcion` = 'Auténtica cocina japonesa con los mejores ingredientes frescos' WHERE `id` = 6;
UPDATE `empresas` SET `descripcion` = 'Comida mexicana auténtica con sabores tradicionales y picantes' WHERE `id` = 7;