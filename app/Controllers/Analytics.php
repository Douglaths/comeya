<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\VisitaModel;
use CodeIgniter\Controller;

class Analytics extends Controller
{
    protected $empresaModel;
    protected $visitaModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->visitaModel = new VisitaModel();
    }

    public function index()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Analytics y Visitas',
            'visitasHoy' => $this->visitaModel->getVisitasHoy(),
            'visitasMes' => $this->visitaModel->getVisitasMes(),
            'visitasTotal' => $this->visitaModel->getVisitasTotal(),
            'empresasActivas' => $this->visitaModel->getEmpresasConVisitas(),
            'chartData' => $this->visitaModel->getVisitasPorDia(30),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/analytics/index', $data);
    }

    public function empresas()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Visitas por Empresa',
            'rankingEmpresas' => $this->visitaModel->getRankingEmpresas($fechaInicio, $fechaFin),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/analytics/empresas', $data);
    }

    public function dispositivos()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Dispositivos y Navegadores',
            'dispositivosStats' => $this->visitaModel->getDispositivosStats($fechaInicio, $fechaFin),
            'navegadoresStats' => $this->visitaModel->getNavegadoresStats($fechaInicio, $fechaFin),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/analytics/dispositivos', $data);
    }

    public function origenes()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio') ?? date('Y-m-01');
        $fechaFin = $this->request->getGet('fecha_fin') ?? date('Y-m-d');

        $data = [
            'title' => 'Orígenes de Tráfico',
            'origenesStats' => $this->visitaModel->getOrigenesStats($fechaInicio, $fechaFin),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('dashboard/analytics/origenes', $data);
    }
}