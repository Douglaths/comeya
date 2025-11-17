<?php

namespace App\Controllers;

class Superadmin extends BaseController
{
    public function index()
    {
        // Datos de prueba para verificar que la vista funciona
        $data = [
            'empresas' => [],
            'estadisticas' => [
                'empresas_activas' => 0,
                'total_ventas' => 0,
                'total_visitas' => 0
            ]
        ];

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