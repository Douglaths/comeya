<?php

namespace App\Controllers;

class Restaurantes extends BaseController
{
    public function index()
    {
        return view('Restaurantes/restaurantes');
    }

    public function ver($id)
    {
        return view('Restaurantes/restaurantes');
    }

    public function confirmarPedido()
    {
        return view('Restaurantes/confirmar_pedido');
    }

    public function verPorNombre($nombreRestaurante)
    {
        $db = \Config\Database::connect();
        
        // Buscar empresa por nombre (convertir URL a nombre)
        $nombreBuscar = str_replace('-', ' ', $nombreRestaurante);
        $empresa = $db->table('empresas')
            ->where('LOWER(nombre)', strtolower($nombreBuscar))
            ->where('activo', 1)
            ->get()
            ->getRowArray();
            
        if (!$empresa) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Obtener productos con sus categorías
        $productos = $db->table('productos p')
            ->select('p.*, c.nombre as categoria_nombre')
            ->join('categorias c', 'p.categoria_id = c.id', 'left')
            ->where('p.empresa_id', $empresa['id'])
            ->where('p.activo', 1)
            ->get()
            ->getResultArray();
            
        // Agrupar productos por categoría
        $productosPorCategoria = [];
        foreach ($productos as $producto) {
            $categoria = !empty($producto['categoria_nombre']) ? $producto['categoria_nombre'] : 'Sin categoría';
            $productosPorCategoria[$categoria][] = $producto;
        }
        
        $data = [
            'nombreRestaurante' => $nombreRestaurante,
            'empresa' => $empresa,
            'productos' => $productos,
            'productosPorCategoria' => $productosPorCategoria
        ];
        
        return view('Restaurantes/restaurantes', $data);
    }
}