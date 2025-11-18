-- Agregar campos para categorización y promociones
ALTER TABLE `empresas` 
ADD COLUMN `categoria_comida` VARCHAR(100) DEFAULT NULL AFTER `ciudad`,
ADD COLUMN `promociones` JSON DEFAULT NULL AFTER `categoria_comida`,
ADD COLUMN `envio_gratis` TINYINT(1) DEFAULT 0 AFTER `promociones`,
ADD COLUMN `descuento_activo` TINYINT(1) DEFAULT 0 AFTER `envio_gratis`,
ADD COLUMN `oferta_2x1` TINYINT(1) DEFAULT 0 AFTER `descuento_activo`;

-- Actualizar datos existentes con categorías
UPDATE `empresas` SET `categoria_comida` = 'Parrilla', `envio_gratis` = 1, `descuento_activo` = 1 WHERE `id` = 1;
UPDATE `empresas` SET `categoria_comida` = 'Italiana', `oferta_2x1` = 1 WHERE `id` = 2;
UPDATE `empresas` SET `categoria_comida` = 'Café', `envio_gratis` = 1 WHERE `id` = 3;
UPDATE `empresas` SET `categoria_comida` = 'Mariscos', `descuento_activo` = 1 WHERE `id` = 4;
UPDATE `empresas` SET `categoria_comida` = 'Hamburguesas', `oferta_2x1` = 1, `envio_gratis` = 1 WHERE `id` = 5;
UPDATE `empresas` SET `categoria_comida` = 'Japonesa', `descuento_activo` = 1 WHERE `id` = 6;
UPDATE `empresas` SET `categoria_comida` = 'Mexicana', `oferta_2x1` = 1 WHERE `id` = 7;