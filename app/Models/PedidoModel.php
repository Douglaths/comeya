<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empresa_id', 'numero_pedido', 'cliente_nombre', 'cliente_email', 'cliente_telefono', 'subtotal', 'impuestos', 'total', 'estado', 'fecha_pedido'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getVentasHoy()
    {
        $result = $this->selectSum('total')
                      ->where('DATE(fecha_pedido)', date('Y-m-d'))
                      ->where('estado !=', 'cancelado')
                      ->get()->getRow();
        return $result ? ($result->total ?? 0) : 0;
    }

    public function getVentasMes()
    {
        $result = $this->selectSum('total')
                      ->where('YEAR(fecha_pedido)', date('Y'))
                      ->where('MONTH(fecha_pedido)', date('m'))
                      ->where('estado !=', 'cancelado')
                      ->get()->getRow();
        return $result ? ($result->total ?? 0) : 0;
    }

    public function getVentasTotal()
    {
        $result = $this->selectSum('total')
                      ->where('estado !=', 'cancelado')
                      ->get()->getRow();
        return $result ? ($result->total ?? 0) : 0;
    }

    public function getPedidosHoy()
    {
        return $this->where('DATE(fecha_pedido)', date('Y-m-d'))
                   ->countAllResults();
    }

    public function getVentasPorDia($dias = 30)
    {
        return $this->select('DATE(fecha_pedido) as fecha, SUM(total) as total')
                   ->where('fecha_pedido >=', date('Y-m-d', strtotime("-{$dias} days")))
                   ->where('estado !=', 'cancelado')
                   ->groupBy('DATE(fecha_pedido)')
                   ->orderBy('fecha', 'ASC')
                   ->findAll();
    }

    public function getRankingEmpresas($fechaInicio, $fechaFin)
    {
        return $this->select('empresas.nombre, SUM(pedidos.total) as total_ventas, COUNT(pedidos.id) as total_pedidos')
                   ->join('empresas', 'empresas.id = pedidos.empresa_id')
                   ->where('pedidos.fecha_pedido >=', $fechaInicio)
                   ->where('pedidos.fecha_pedido <=', $fechaFin . ' 23:59:59')
                   ->where('pedidos.estado !=', 'cancelado')
                   ->groupBy('pedidos.empresa_id')
                   ->orderBy('total_ventas', 'DESC')
                   ->findAll();
    }

    public function getPedidosConFiltros($filtros)
    {
        $builder = $this->select('pedidos.*, empresas.nombre as empresa_nombre')
                       ->join('empresas', 'empresas.id = pedidos.empresa_id');

        if (!empty($filtros['empresa_id'])) {
            $builder->where('pedidos.empresa_id', $filtros['empresa_id']);
        }

        if (!empty($filtros['estado'])) {
            $builder->where('pedidos.estado', $filtros['estado']);
        }

        if (!empty($filtros['fecha_inicio'])) {
            $builder->where('pedidos.fecha_pedido >=', $filtros['fecha_inicio']);
        }

        if (!empty($filtros['fecha_fin'])) {
            $builder->where('pedidos.fecha_pedido <=', $filtros['fecha_fin'] . ' 23:59:59');
        }

        return $builder->orderBy('pedidos.fecha_pedido', 'DESC')
                      ->findAll();
    }

    public function getReporteVentas($fechaInicio, $fechaFin)
    {
        return $this->select('pedidos.fecha_pedido, empresas.nombre as empresa_nombre, pedidos.numero_pedido, pedidos.cliente_nombre, pedidos.total, pedidos.estado')
                   ->join('empresas', 'empresas.id = pedidos.empresa_id')
                   ->where('pedidos.fecha_pedido >=', $fechaInicio)
                   ->where('pedidos.fecha_pedido <=', $fechaFin . ' 23:59:59')
                   ->orderBy('pedidos.fecha_pedido', 'DESC')
                   ->findAll();
    }
}