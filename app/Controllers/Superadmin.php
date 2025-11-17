<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\VentaModel;
use App\Models\VisitaModel;

class Superadmin extends BaseController
{
    protected $empresaModel;
    protected $ventaModel;
    protected $visitaModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->ventaModel = new VentaModel();
        $this->visitaModel = new VisitaModel();
    }

    public function index()
    {
        try {
            $data = [
                'empresas' => $this->empresaModel->findAll(),
                'estadisticas' => [
                    'empresas_activas' => $this->empresaModel->where('activo', 1)->countAllResults(),
                    'total_ventas' => $this->ventaModel->selectSum('total')->get()->getRow()->total ?? 0,
                    'total_visitas' => $this->visitaModel->countAllResults()
                ]
            ];
        } catch (\Exception $e) {
            // Si hay error de BD, usar datos de prueba
            $data = [
                'empresas' => [],
                'estadisticas' => [
                    'empresas_activas' => 0,
                    'total_ventas' => 0,
                    'total_visitas' => 0
                ]
            ];
        }

        return view('Dashboard/superadmin', $data);
    }

    public function toggleEmpresa()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $json = $this->request->getJSON();
        $empresaId = $json->empresa_id;
        $activo = $json->activo;

        $result = $this->empresaModel->update($empresaId, ['activo' => $activo]);

        return $this->response->setJSON(['success' => $result]);
    }

    public function impersonar($empresaId)
    {
        $empresa = $this->empresaModel->find($empresaId);
        
        if (!$empresa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Empresa no encontrada');
        }

        session()->set('impersonating_empresa_id', $empresaId);
        return redirect()->to(base_url('dashboard/empresa'));
    }
}