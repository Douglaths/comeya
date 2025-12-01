<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\UsuarioModel;

class Empresas extends BaseController
{
    protected $empresaModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $filtros = $this->request->getGet();
        
        $builder = $this->empresaModel;
        
        if (!empty($filtros['estado'])) {
            $builder = $builder->where('estado', $filtros['estado']);
        }
        
        if (!empty($filtros['plan'])) {
            $builder = $builder->where('plan', $filtros['plan']);
        }
        
        if (!empty($filtros['ciudad'])) {
            $builder = $builder->like('ciudad', $filtros['ciudad']);
        }

        // Contar solicitudes pendientes
        $db = \Config\Database::connect();
        $solicitudesPendientes = $db->table('solicitudes_registro')
                                   ->where('estado', 'pendiente')
                                   ->countAllResults();

        $data = [
            'empresas' => $builder->findAll(),
            'filtros' => $filtros,
            'ciudades' => $this->empresaModel->select('ciudad')->distinct()->findAll(),
            'solicitudes_pendientes' => $solicitudesPendientes
        ];

        return view('dashboard/empresas/index', $data);
    }

    public function crear()
    {
        return view('dashboard/empresas/crear');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[empresas.email]',
            'telefono' => 'permit_empty|max_length[20]',
            'direccion' => 'permit_empty',
            'ciudad' => 'required|max_length[100]',
            'plan' => 'required|in_list[basico,premium,enterprise]',
            'admin_nombre' => 'required|min_length[3]|max_length[255]',
            'admin_email' => 'required|valid_email|is_unique[usuarios.email]',
            'admin_password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Crear empresa
            $empresaData = [
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'telefono' => $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion'),
                'ciudad' => $this->request->getPost('ciudad'),
                'plan' => $this->request->getPost('plan'),
                'estado' => 'activo',
                'limite_productos' => $this->getLimiteByPlan($this->request->getPost('plan'))
            ];

            $empresaId = $this->empresaModel->insert($empresaData);

            // Crear usuario admin
            $usuarioData = [
                'empresa_id' => $empresaId,
                'nombre' => $this->request->getPost('admin_nombre'),
                'email' => $this->request->getPost('admin_email'),
                'password' => password_hash($this->request->getPost('admin_password'), PASSWORD_DEFAULT),
                'rol' => 'admin_empresa',
                'activo' => 1
            ];

            $this->usuarioModel->insert($usuarioData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Error al crear la empresa');
            }

            return redirect()->to(base_url('superadmin/empresas'))->with('success', 'Empresa creada exitosamente');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Error al crear la empresa: ' . $e->getMessage());
        }
    }

    public function inactivas()
    {
        $data = [
            'empresas' => $this->empresaModel->whereIn('estado', ['inactivo', 'suspendido'])->findAll()
        ];

        return view('dashboard/empresas/inactivas', $data);
    }

    public function trial()
    {
        $data = [
            'empresas' => $this->empresaModel->where('estado', 'trial')->findAll()
        ];

        return view('dashboard/empresas/trial', $data);
    }

    public function impersonar($empresaId)
    {
        $empresa = $this->empresaModel->find($empresaId);
        
        if (!$empresa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Empresa no encontrada');
        }

        session()->set('impersonating_empresa_id', $empresaId);
        return redirect()->to(base_url('dashboard/empresa'))->with('success', 'Accediendo como ' . $empresa['nombre']);
    }

    public function cambiarEstado($empresaId)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $json = $this->request->getJSON();
        $nuevoEstado = $json->estado;

        $result = $this->empresaModel->update($empresaId, ['estado' => $nuevoEstado]);

        return $this->response->setJSON(['success' => $result]);
    }

    public function cambiarPlan($empresaId)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $json = $this->request->getJSON();
        $nuevoPlan = $json->plan;
        $limite = $this->getLimiteByPlan($nuevoPlan);

        $result = $this->empresaModel->update($empresaId, [
            'plan' => $nuevoPlan,
            'limite_productos' => $limite
        ]);

        return $this->response->setJSON(['success' => $result]);
    }

    private function getLimiteByPlan($plan)
    {
        $limites = [
            'basico' => 25,
            'premium' => 100,
            'enterprise' => 500
        ];

        return $limites[$plan] ?? 25;
    }

    public function solicitudes()
    {
        $db = \Config\Database::connect();
        $solicitudes = $db->table('solicitudes_registro')
                         ->orderBy('fecha_solicitud', 'DESC')
                         ->get()
                         ->getResultArray();

        $data = ['solicitudes' => $solicitudes];
        return view('dashboard/empresas/solicitudes', $data);
    }

    public function aprobarSolicitud($id)
    {
        $db = \Config\Database::connect();
        $solicitud = $db->table('solicitudes_registro')->where('id', $id)->get()->getRowArray();
        
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada');
        }

        $db->transStart();

        try {
            // Crear empresa
            $empresaData = [
                'nombre' => $solicitud['nombre_empresa'],
                'email' => $solicitud['email'],
                'telefono' => $solicitud['telefono'],
                'direccion' => $solicitud['direccion'],
                'plan' => 'basico',
                'estado' => 'activo',
                'limite_productos' => 25
            ];

            $empresaId = $this->empresaModel->insert($empresaData);

            // Actualizar solicitud
            $db->table('solicitudes_registro')
               ->where('id', $id)
               ->update([
                   'estado' => 'aprobada',
                   'fecha_respuesta' => date('Y-m-d H:i:s')
               ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Error al aprobar la solicitud');
            }

            return redirect()->back()->with('success', 'Solicitud aprobada y empresa creada exitosamente');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function rechazarSolicitud($id)
    {
        $db = \Config\Database::connect();
        
        $result = $db->table('solicitudes_registro')
                    ->where('id', $id)
                    ->update([
                        'estado' => 'rechazada',
                        'fecha_respuesta' => date('Y-m-d H:i:s'),
                        'notas_admin' => $this->request->getPost('notas')
                    ]);

        if ($result) {
            return redirect()->back()->with('success', 'Solicitud rechazada');
        } else {
            return redirect()->back()->with('error', 'Error al rechazar la solicitud');
        }
    }

    public function editar($id)
    {
        $empresa = $this->empresaModel->find($id);
        
        if (!$empresa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Empresa no encontrada');
        }

        $data = ['empresa' => $empresa];
        return view('dashboard/empresas/editar', $data);
    }

    public function actualizar($id)
    {
        $empresa = $this->empresaModel->find($id);
        
        if (!$empresa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Empresa no encontrada');
        }

        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[255]',
            'email' => "required|valid_email|is_unique[empresas.email,id,{$id}]",
            'telefono' => 'permit_empty|max_length[20]',
            'direccion' => 'permit_empty',
            'descripcion' => 'permit_empty',
            'ciudad' => 'permit_empty|max_length[100]',
            'categoria_comida' => 'permit_empty|max_length[100]',
            'plan' => 'required|in_list[basico,premium,enterprise]',
            'estado' => 'required|in_list[activo,inactivo,suspendido,trial]',
            'limite_productos' => 'permit_empty|integer',
            'fecha_trial_fin' => 'permit_empty|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'telefono' => $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion'),
                'descripcion' => $this->request->getPost('descripcion'),
                'ciudad' => $this->request->getPost('ciudad'),
                'categoria_comida' => $this->request->getPost('categoria_comida'),
                'plan' => $this->request->getPost('plan'),
                'estado' => $this->request->getPost('estado'),
                'limite_productos' => $this->request->getPost('limite_productos') ?: $this->getLimiteByPlan($this->request->getPost('plan')),
                'envio_gratis' => $this->request->getPost('envio_gratis') ? 1 : 0,
                'descuento_activo' => $this->request->getPost('descuento_activo') ? 1 : 0,
                'oferta_2x1' => $this->request->getPost('oferta_2x1') ? 1 : 0,
                'destacado' => $this->request->getPost('destacado') ? 1 : 0,
                'fecha_trial_fin' => $this->request->getPost('fecha_trial_fin') ?: null,
                'codigo_referido' => $this->request->getPost('codigo_referido')
            ];

            $this->empresaModel->update($id, $data);

            return redirect()->to(base_url('superadmin/empresas'))->with('success', 'Empresa actualizada exitosamente');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar la empresa: ' . $e->getMessage());
        }
    }
}