<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\PagoModel;
use App\Models\PlanModel;
use App\Models\EmpresaModel;

class Contabilidad extends BaseController
{
    protected $facturaModel;
    protected $pagoModel;
    protected $planModel;
    protected $empresaModel;

    public function __construct()
    {
        $this->facturaModel = new FacturaModel();
        $this->pagoModel = new PagoModel();
        $this->planModel = new PlanModel();
        $this->empresaModel = new EmpresaModel();
    }

    public function index()
    {
        $data = [
            'totalFacturas' => $this->facturaModel->countAll(),
            'totalPagos' => $this->pagoModel->where('estado', 'completado')->countAllResults(),
            'pagosPendientes' => $this->pagoModel->where('estado', 'pendiente')->countAllResults(),
            'facturasMorosas' => $this->facturaModel->where('fecha_vencimiento <', date('Y-m-d'))->where('estado', 'pendiente')->countAllResults()
        ];
        return view('dashboard/contabilidad/index', $data);
    }

    public function facturas()
    {
        $filtros = [
            'empresa' => $this->request->getGet('empresa'),
            'estado' => $this->request->getGet('estado'),
            'fecha_inicio' => $this->request->getGet('fecha_inicio'),
            'fecha_fin' => $this->request->getGet('fecha_fin')
        ];

        $builder = $this->facturaModel->select('facturas.*, empresas.nombre as empresa_nombre')
                                     ->join('empresas', 'empresas.id = facturas.empresa_id');

        if ($filtros['empresa']) {
            $builder->where('facturas.empresa_id', $filtros['empresa']);
        }
        if ($filtros['estado']) {
            $builder->where('facturas.estado', $filtros['estado']);
        }
        if ($filtros['fecha_inicio']) {
            $builder->where('facturas.fecha_emision >=', $filtros['fecha_inicio']);
        }
        if ($filtros['fecha_fin']) {
            $builder->where('facturas.fecha_emision <=', $filtros['fecha_fin']);
        }

        $data = [
            'facturas' => $builder->orderBy('fecha_emision', 'DESC')->findAll(),
            'empresas' => $this->empresaModel->findAll(),
            'filtros' => $filtros
        ];
        return view('dashboard/contabilidad/facturas', $data);
    }

    public function pagos()
    {
        $filtros = [
            'empresa' => $this->request->getGet('empresa'),
            'metodo' => $this->request->getGet('metodo'),
            'estado' => $this->request->getGet('estado')
        ];

        $builder = $this->pagoModel->select('pagos.*, empresas.nombre as empresa_nombre, facturas.numero as factura_numero')
                                  ->join('facturas', 'facturas.id = pagos.factura_id')
                                  ->join('empresas', 'empresas.id = facturas.empresa_id');

        if ($filtros['empresa']) {
            $builder->where('facturas.empresa_id', $filtros['empresa']);
        }
        if ($filtros['metodo']) {
            $builder->where('pagos.metodo_pago', $filtros['metodo']);
        }
        if ($filtros['estado']) {
            $builder->where('pagos.estado', $filtros['estado']);
        }

        $data = [
            'pagos' => $builder->orderBy('fecha_pago', 'DESC')->findAll(),
            'empresas' => $this->empresaModel->findAll(),
            'filtros' => $filtros
        ];
        return view('dashboard/contabilidad/pagos', $data);
    }

    public function morosos()
    {
        $facturasMorosas = $this->facturaModel->select('facturas.*, empresas.nombre as empresa_nombre, empresas.email')
                                              ->join('empresas', 'empresas.id = facturas.empresa_id')
                                              ->where('facturas.fecha_vencimiento <', date('Y-m-d'))
                                              ->where('facturas.estado', 'pendiente')
                                              ->orderBy('facturas.fecha_vencimiento', 'ASC')
                                              ->findAll();

        $data = ['facturasMorosas' => $facturasMorosas];
        return view('dashboard/contabilidad/morosos', $data);
    }

    public function planes()
    {
        $data = ['planes' => $this->planModel->findAll()];
        return view('dashboard/contabilidad/planes', $data);
    }

    public function crearPlan()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'precio' => $this->request->getPost('precio'),
                'limite_productos' => $this->request->getPost('limite_productos'),
                'caracteristicas' => $this->request->getPost('caracteristicas'),
                'activo' => 1
            ];

            if ($this->planModel->insert($datos)) {
                return redirect()->to('/public/superadmin/contabilidad/planes')->with('success', 'Plan creado exitosamente');
            }
        }
        return view('dashboard/contabilidad/crear_plan');
    }

    public function exportarReporte()
    {
        $tipo = $this->request->getGet('tipo') ?? 'facturas';
        $formato = $this->request->getGet('formato') ?? 'csv';

        if ($tipo === 'facturas') {
            $datos = $this->facturaModel->select('facturas.*, empresas.nombre as empresa_nombre')
                                       ->join('empresas', 'empresas.id = facturas.empresa_id')
                                       ->findAll();
            $filename = 'reporte_facturas_' . date('Y-m-d');
        } else {
            $datos = $this->pagoModel->select('pagos.*, empresas.nombre as empresa_nombre, facturas.numero as factura_numero')
                                    ->join('facturas', 'facturas.id = pagos.factura_id')
                                    ->join('empresas', 'empresas.id = facturas.empresa_id')
                                    ->findAll();
            $filename = 'reporte_pagos_' . date('Y-m-d');
        }

        if ($formato === 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
            
            $output = fopen('php://output', 'w');
            
            if ($tipo === 'facturas') {
                fputcsv($output, ['Número', 'Empresa', 'Monto', 'Estado', 'Fecha Emisión', 'Fecha Vencimiento']);
                foreach ($datos as $factura) {
                    fputcsv($output, [
                        $factura['numero'],
                        $factura['empresa_nombre'],
                        $factura['monto'],
                        $factura['estado'],
                        $factura['fecha_emision'],
                        $factura['fecha_vencimiento']
                    ]);
                }
            } else {
                fputcsv($output, ['Factura', 'Empresa', 'Monto', 'Método', 'Estado', 'Fecha Pago']);
                foreach ($datos as $pago) {
                    fputcsv($output, [
                        $pago['factura_numero'],
                        $pago['empresa_nombre'],
                        $pago['monto'],
                        $pago['metodo_pago'],
                        $pago['estado'],
                        $pago['fecha_pago']
                    ]);
                }
            }
            
            fclose($output);
            exit;
        }
    }
}