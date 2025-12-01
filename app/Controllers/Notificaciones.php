<?php

namespace App\Controllers;

class Notificaciones extends BaseController
{
    public function stream()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        
        $empresaId = session()->get('empresa_id') ?? 1;
        $db = \Config\Database::connect();
        
        // Solo enviar si hay pedidos nuevos
        $ultimoIdSesion = session()->get('ultimo_pedido_id') ?? 0;
        
        $nuevosPedidos = $db->table('pedidos')
            ->where('empresa_id', $empresaId)
            ->where('id >', $ultimoIdSesion)
            ->where('estado', 'pendiente')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
            
        if (!empty($nuevosPedidos)) {
            $ultimoId = $nuevosPedidos[0]['id'];
            session()->set('ultimo_pedido_id', $ultimoId);
            
            $data = [
                'type' => 'nuevos_pedidos',
                'count' => count($nuevosPedidos),
                'pedidos' => $nuevosPedidos
            ];
            
            echo "data: " . json_encode($data) . "\n\n";
        }
        
        flush();
    }
    
    public function checkNuevosPedidos()
    {
        $ultimoId = $this->request->getGet('ultimo_id') ?? 0;
        $empresaId = session()->get('empresa_id') ?? 1;
        $db = \Config\Database::connect();
        
        $nuevosPedidos = $db->table('pedidos')
            ->where('empresa_id', $empresaId)
            ->where('id >', $ultimoId)
            ->where('estado', 'pendiente')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
            
        return $this->response->setJSON([
            'success' => true,
            'pedidos' => $nuevosPedidos,
            'count' => count($nuevosPedidos),
            'ultimo_id' => !empty($nuevosPedidos) ? $nuevosPedidos[0]['id'] : $ultimoId
        ]);
    }
}