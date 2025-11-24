ALTER TABLE pedidos 
ADD COLUMN fecha_procesando TIMESTAMP NULL AFTER fecha_pedido,
ADD COLUMN fecha_enviado TIMESTAMP NULL AFTER fecha_procesando,
ADD COLUMN fecha_completado TIMESTAMP NULL AFTER fecha_enviado;