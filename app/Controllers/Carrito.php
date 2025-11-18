<?php

namespace App\Controllers;

class Carrito extends BaseController
{
    public function agregar()
    {
        $request = $this->request->getJSON();
        
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Datos inválidos']);
        }

        $session = session();
        $carrito = $session->get('carrito') ?? [];
        $restauranteId = $request->restauranteId ?? null;

        // Verificar si hay productos de otro restaurante
        if (!empty($carrito) && isset($carrito['restauranteId']) && $carrito['restauranteId'] !== $restauranteId) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Ya tienes productos de otro restaurante en tu carrito',
                'requireConfirm' => true
            ]);
        }

        // Inicializar carrito si está vacío
        if (empty($carrito)) {
            $carrito = [
                'restauranteId' => $restauranteId,
                'restauranteNombre' => $request->restauranteNombre ?? '',
                'items' => []
            ];
        }

        $productoId = $request->productoId;
        $encontrado = false;

        // Buscar si el producto ya existe
        foreach ($carrito['items'] as &$item) {
            if ($item['id'] === $productoId) {
                $item['cantidad']++;
                $encontrado = true;
                break;
            }
        }

        // Si no existe, agregarlo
        if (!$encontrado) {
            $carrito['items'][] = [
                'id' => $productoId,
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'imagen' => $request->imagen,
                'cantidad' => 1
            ];
        }

        $session->set('carrito', $carrito);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'carrito' => $carrito
        ]);
    }

    public function actualizar()
    {
        $request = $this->request->getJSON();
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        if (empty($carrito['items'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Carrito vacío']);
        }

        $productoId = $request->productoId;
        $accion = $request->accion; // 'increase', 'decrease', 'remove'

        foreach ($carrito['items'] as $key => &$item) {
            if ($item['id'] === $productoId) {
                switch ($accion) {
                    case 'increase':
                        $item['cantidad']++;
                        break;
                    case 'decrease':
                        if ($item['cantidad'] > 1) {
                            $item['cantidad']--;
                        }
                        break;
                    case 'remove':
                        unset($carrito['items'][$key]);
                        $carrito['items'] = array_values($carrito['items']); // Reindexar
                        break;
                }
                break;
            }
        }

        // Si no quedan items, limpiar carrito
        if (empty($carrito['items'])) {
            $session->remove('carrito');
            $carrito = [];
        } else {
            $session->set('carrito', $carrito);
        }

        return $this->response->setJSON([
            'success' => true,
            'carrito' => $carrito
        ]);
    }

    public function limpiar()
    {
        $session = session();
        $session->remove('carrito');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Carrito limpiado'
        ]);
    }

    public function obtener()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        return $this->response->setJSON([
            'success' => true,
            'carrito' => $carrito
        ]);
    }

    public function confirmarLimpieza()
    {
        $request = $this->request->getJSON();
        $session = session();
        
        // Limpiar carrito actual
        $session->remove('carrito');
        
        // Crear nuevo carrito con el producto
        $carrito = [
            'restauranteId' => $request->restauranteId,
            'restauranteNombre' => $request->restauranteNombre,
            'items' => [[
                'id' => $request->productoId,
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'imagen' => $request->imagen,
                'cantidad' => 1
            ]]
        ];

        $session->set('carrito', $carrito);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Carrito actualizado',
            'carrito' => $carrito
        ]);
    }
}