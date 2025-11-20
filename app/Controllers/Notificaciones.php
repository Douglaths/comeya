<?php

namespace App\Controllers;

class Notificaciones extends BaseController
{
    public function stream()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        
        $db = \Config\Database::connect();
        
        // Obtener el último pedido para la empresa
        $ultimoPedido = $db->table('pedidos')
            ->where('empresa_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();
            
        if ($ultimoPedido) {
            $data = [
                'type' => 'nuevo_pedido',
                'pedido' => $ultimoPedido
            ];
            
            echo "data: " . json_encode($data) . "\n\n";
        }
        
        flush();
    }
    
    public function checkNuevosPedidos()
    {
        $ultimoId = $this->request->getGet('ultimo_id') ?? 0;
        $db = \Config\Database::connect();
        
        $nuevosPedidos = $db->table('pedidos')
            ->where('empresa_id', 1)
            ->where('id >', $ultimoId)
            ->where('estado', 'pendiente')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
            
        return $this->response->setJSON([
            'success' => true,
            'pedidos' => $nuevosPedidos,
            'count' => count($nuevosPedidos)
        ]);
    }
}