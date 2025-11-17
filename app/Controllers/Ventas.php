<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\PedidoModel;
use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Ventas extends Controller
{
    protected $empresaModel;
    protected $pedidoModel;
    protected $productoModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->pedidoModel = new PedidoModel();
        $this->productoModel = new ProductoModel();
    }

    public function index()
    {
        try {
            $data = [
                'title' => 'Resumen de Ventas',
                'ventasHoy' => $this->pedidoModel->getVentasHoy(),
                'ventasMes' => $this->pedidoModel->getVentasMes(),
                'ventasTotal' => $this->pedidoModel->getVentasTotal(),
                'pedidosHoy' => $this->pedidoModel->getPedidosHoy(),
                'chartData' => $this->pedidoModel->getVentasPorDia(30)
            ];
        } catch (\Exception $e) {
            $data = [
                'title' => 'Resumen de Ventas',
                'ventasHoy' => 0,
                'ventasMes' => 0,
                'ventasTotal' => 0,
                'pedidosHoy' => 0,
                'chartData' => []
            ];
        }

        return view('dashboard/ventas/index', $data);
    }

    public function empresas()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Ventas por Empresa',
            'rankingEmpresas' => $this->pedidoModel->getRankingEmpresas($fechaInicio, $fechaFin),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/ventas/empresas', $data);
    }

    public function productos()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Top Productos',
            'topProductos' => $this->productoModel->getTopProductos($fechaInicio, $fechaFin),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/ventas/productos', $data);
    }

    public function pedidos()
    {
        $filtros = [
            'empresa_id' => $this->request->getGet('empresa_id'),
            'estado' => $this->request->getGet('estado'),
            'fecha_inicio' => $this->request->getGet('fecha_inicio'),
            'fecha_fin' => $this->request->getGet('fecha_fin')
        ];

        $data = [
            'title' => 'Pedidos Globales',
            'pedidos' => $this->pedidoModel->getPedidosConFiltros($filtros),
            'empresas' => $this->empresaModel->findAll(),
            'filtros' => $filtros
        ];

        return view('dashboard/ventas/pedidos', $data);
    }

    public function exportar()
    {
        $tipo = $this->request->getGet('tipo') ?? 'csv';
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $datos = $this->pedidoModel->getReporteVentas($fechaInicio, $fechaFin);

        if ($tipo === 'excel') {
            return $this->exportarExcel($datos, $fechaInicio, $fechaFin);
        } else {
            return $this->exportarCSV($datos, $fechaInicio, $fechaFin);
        }
    }

    private function exportarCSV($datos, $fechaInicio, $fechaFin)
    {
        $filename = "ventas_{$fechaInicio}_{$fechaFin}.csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, ['Fecha', 'Empresa', 'Número Pedido', 'Cliente', 'Total', 'Estado']);
        
        foreach ($datos as $fila) {
            fputcsv($output, [
                $fila['fecha_pedido'],
                $fila['empresa_nombre'],
                $fila['numero_pedido'],
                $fila['cliente_nombre'],
                $fila['total'],
                $fila['estado']
            ]);
        }
        
        fclose($output);
        exit;
    }

    private function exportarExcel($datos, $fechaInicio, $fechaFin)
    {
        $filename = "ventas_{$fechaInicio}_{$fechaFin}.xlsx";
        
        // Crear contenido HTML que Excel puede interpretar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo '<table border="1">';
        echo '<tr><th>Fecha</th><th>Empresa</th><th>Número Pedido</th><th>Cliente</th><th>Total</th><th>Estado</th></tr>';
        
        foreach ($datos as $fila) {
            echo '<tr>';
            echo '<td>' . $fila['fecha_pedido'] . '</td>';
            echo '<td>' . $fila['empresa_nombre'] . '</td>';
            echo '<td>' . $fila['numero_pedido'] . '</td>';
            echo '<td>' . $fila['cliente_nombre'] . '</td>';
            echo '<td>' . $fila['total'] . '</td>';
            echo '<td>' . $fila['estado'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        exit;
    }
}