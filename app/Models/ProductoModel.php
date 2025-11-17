<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empresa_id', 'nombre', 'descripcion', 'precio', 'categoria', 'activo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getTopProductos($fechaInicio, $fechaFin, $limit = 20)
    {
        return $this->select('productos.nombre, productos.precio, empresas.nombre as empresa_nombre, SUM(pedido_items.cantidad) as total_vendido, SUM(pedido_items.subtotal) as total_ingresos')
                   ->join('pedido_items', 'pedido_items.producto_id = productos.id')
                   ->join('pedidos', 'pedidos.id = pedido_items.pedido_id')
                   ->join('empresas', 'empresas.id = productos.empresa_id')
                   ->where('pedidos.fecha_pedido >=', $fechaInicio)
                   ->where('pedidos.fecha_pedido <=', $fechaFin . ' 23:59:59')
                   ->where('pedidos.estado !=', 'cancelado')
                   ->groupBy('productos.id')
                   ->orderBy('total_vendido', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    public function getProductosPorEmpresa($empresaId)
    {
        return $this->where('empresa_id', $empresaId)
                   ->where('activo', 1)
                   ->findAll();
    }
}