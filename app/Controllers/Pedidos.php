<?php

namespace App\Controllers;

class Pedidos extends BaseController
{
    public function crear()
    {
        $request = $this->request->getJSON();
        
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Datos inválidos']);
        }

        $db = \Config\Database::connect();
        
        // Generar número de pedido alfanumérico
        $restauranteNombre = strtolower($request->restaurante->nombre);
        $restauranteSlug = preg_replace('/[^a-z0-9]/', '', $restauranteNombre);
        $restauranteSlug = substr($restauranteSlug, 0, 6);
        
        // Obtener siguiente número secuencial para este restaurante
        $ultimoPedido = $db->table('pedidos')
            ->where('empresa_id', $request->restaurante->id)
            ->orderBy('id', 'DESC')
            ->get()
            ->getRowArray();
            
        $numeroSecuencial = $ultimoPedido ? (intval(substr($ultimoPedido['numero_pedido'], -4)) + 1) : 1;
        $numeroPedido = $restauranteSlug . '-' . str_pad($numeroSecuencial, 4, '0', STR_PAD_LEFT);
        
        // Insertar pedido
        $pedidoData = [
            'numero_pedido' => $numeroPedido,
            'empresa_id' => $request->restaurante->id,
            'cliente_nombre' => $request->nombre,
            'cliente_telefono' => $request->telefono,
            'direccion_entrega' => $request->direccion,
            'notas' => $request->notas ?? '',
            'medio_pago' => $request->metodoPago,
            'subtotal' => $request->total,
            'costo_envio' => $request->envio,
            'total' => $request->totalFinal,
            'estado' => 'pendiente',
            'fecha_pedido' => date('Y-m-d H:i:s')
        ];
        
        $insertResult = $db->table('pedidos')->insert($pedidoData);
        
        if (!$insertResult) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al crear pedido']);
        }
        
        $pedidoId = $db->insertID();
        
        // Insertar items del pedido
        foreach ($request->items as $item) {
            $db->table('pedido_items')->insert([
                'pedido_id' => $pedidoId,
                'producto_id' => $item->id,
                'cantidad' => $item->cantidad,
                'precio_unitario' => $item->precio,
                'subtotal' => $item->precio * $item->cantidad
            ]);
        }
        
        return $this->response->setJSON([
            'success' => true,
            'numeroPedido' => $numeroPedido,
            'message' => 'Pedido creado exitosamente'
        ]);
    }
}