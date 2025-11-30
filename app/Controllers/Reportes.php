<?php

namespace App\Controllers;

class Reportes extends BaseController
{
    public function __construct()
    {
        if (!session()->get('logged_in')) {
            redirect()->to(base_url('login'))->send();
            exit;
        }
    }
    
    private function getEmpresaId()
    {
        return session()->get('empresa_id') ?? 1;
    }

    public function index()
    {
        $empresaId = $this->getEmpresaId();
        $db = \Config\Database::connect();
        
        // Filtros
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');
        
        // Reporte de ventas por pedido
        $ventasPorPedido = $db->table('pedidos')
            ->select('pedidos.numero_pedido, pedidos.fecha_pedido, pedidos.nombre_cliente, pedidos.telefono_cliente, pedidos.total, pedidos.estado, pedidos.medio_pago')
            ->where('pedidos.empresa_id', $empresaId)
            ->where('DATE(pedidos.fecha_pedido) >=', $fechaInicio)
            ->where('DATE(pedidos.fecha_pedido) <=', $fechaFin)
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->get()
            ->getResultArray();
        
        // Top productos más vendidos
        $topProductos = $db->table('pedido_items')
            ->select('productos.nombre, SUM(pedido_items.cantidad) as total_vendido, SUM(pedido_items.subtotal) as total_ingresos')
            ->join('pedidos', 'pedidos.id = pedido_items.pedido_id')
            ->join('productos', 'productos.id = pedido_items.producto_id')
            ->where('pedidos.empresa_id', $empresaId)
            ->where('DATE(pedidos.fecha_pedido) >=', $fechaInicio)
            ->where('DATE(pedidos.fecha_pedido) <=', $fechaFin)
            ->groupBy('pedido_items.producto_id')
            ->orderBy('total_vendido', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();
        
        $data = [
            'ventas_por_pedido' => $ventasPorPedido,
            'top_productos' => $topProductos,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'total_ventas' => array_sum(array_column($ventasPorPedido, 'total')),
            'total_pedidos' => count($ventasPorPedido)
        ];
        
        return view('Admin/reportes', $data);
    }

    public function exportarExcel()
    {
        $empresaId = $this->getEmpresaId();
        $db = \Config\Database::connect();
        
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');
        
        $ventas = $db->table('pedidos')
            ->select('pedidos.numero_pedido, pedidos.fecha_pedido, pedidos.nombre_cliente, pedidos.telefono_cliente, pedidos.total, pedidos.estado, COALESCE(pedidos.medio_pago, "efectivo") as medio_pago')
            ->where('pedidos.empresa_id', $empresaId)
            ->where('DATE(pedidos.fecha_pedido) >=', $fechaInicio)
            ->where('DATE(pedidos.fecha_pedido) <=', $fechaFin)
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->get()
            ->getResultArray();

        // Crear CSV
        $filename = 'reporte_ventas_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, ['Número Pedido', 'Fecha', 'Cliente', 'Teléfono', 'Total', 'Estado', 'Medio Pago']);
        
        // Datos
        foreach ($ventas as $venta) {
            fputcsv($output, [
                $venta['numero_pedido'],
                $venta['fecha_pedido'],
                $venta['nombre_cliente'],
                $venta['telefono_cliente'],
                '$' . number_format($venta['total'], 0),
                ucfirst($venta['estado']),
                $venta['medio_pago'] === 'efectivo' ? 'Efectivo' : 'Transferencia'
            ]);
        }
        
        fclose($output);
        exit;
    }
}