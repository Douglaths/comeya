<?php

namespace App\Controllers;

use App\Models\CampanaModel;
use App\Models\CodigoReferidoModel;
use App\Models\EmailCampanaModel;
use App\Models\EmpresaModel;

class Marketing extends BaseController
{
    protected $campanaModel;
    protected $codigoReferidoModel;
    protected $emailCampanaModel;
    protected $empresaModel;

    public function __construct()
    {
        $this->campanaModel = new CampanaModel();
        $this->codigoReferidoModel = new CodigoReferidoModel();
        $this->emailCampanaModel = new EmailCampanaModel();
        $this->empresaModel = new EmpresaModel();
    }

    public function index()
    {
        $data = [
            'totalCampanas' => $this->campanaModel->countAll(),
            'campanasActivas' => $this->campanaModel->where('estado', 'activa')->countAllResults(),
            'codigosActivos' => $this->codigoReferidoModel->where('activo', 1)->countAllResults(),
            'emailsEnviados' => $this->emailCampanaModel->where('estado', 'enviado')->countAllResults()
        ];
        return view('dashboard/marketing/index', $data);
    }

    public function campanas()
    {
        $filtros = [
            'tipo' => $this->request->getGet('tipo'),
            'estado' => $this->request->getGet('estado')
        ];

        $builder = $this->campanaModel;
        if ($filtros['tipo']) {
            $builder->where('tipo', $filtros['tipo']);
        }
        if ($filtros['estado']) {
            $builder->where('estado', $filtros['estado']);
        }

        $data = [
            'campanas' => $builder->orderBy('created_at', 'DESC')->findAll(),
            'filtros' => $filtros
        ];
        return view('dashboard/marketing/campanas', $data);
    }

    public function crearCampana()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'tipo' => $this->request->getPost('tipo'),
                'plataforma' => $this->request->getPost('plataforma'),
                'presupuesto' => $this->request->getPost('presupuesto'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
                'objetivo' => $this->request->getPost('objetivo'),
                'estado' => 'borrador'
            ];

            if ($this->campanaModel->insert($datos)) {
                return redirect()->to('/public/superadmin/marketing/campanas')->with('success', 'Campaña creada exitosamente');
            }
        }
        return view('dashboard/marketing/crear_campana');
    }

    public function referidos()
    {
        $data = [
            'codigos' => $this->codigoReferidoModel->findAll()
        ];
        return view('dashboard/marketing/referidos', $data);
    }

    public function crearReferido()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'codigo' => strtoupper($this->request->getPost('codigo')),
                'descripcion' => $this->request->getPost('descripcion'),
                'descuento_porcentaje' => $this->request->getPost('descuento_porcentaje'),
                'limite_usos' => $this->request->getPost('limite_usos'),
                'fecha_expiracion' => $this->request->getPost('fecha_expiracion'),
                'activo' => 1
            ];

            if ($this->codigoReferidoModel->insert($datos)) {
                return redirect()->to('/public/superadmin/marketing/referidos')->with('success', 'Código creado exitosamente');
            }
        }
        return view('dashboard/marketing/crear_referido');
    }

    public function emails()
    {
        $data = [
            'campanas' => $this->emailCampanaModel->orderBy('created_at', 'DESC')->findAll(),
            'empresas' => $this->empresaModel->where('activo', 1)->findAll()
        ];
        return view('dashboard/marketing/emails', $data);
    }

    public function crearEmail()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'asunto' => $this->request->getPost('asunto'),
                'contenido' => $this->request->getPost('contenido'),
                'destinatarios' => $this->request->getPost('destinatarios'),
                'programado_para' => $this->request->getPost('programado_para'),
                'estado' => 'borrador'
            ];

            if ($this->emailCampanaModel->insert($datos)) {
                return redirect()->to('/public/superadmin/marketing/emails')->with('success', 'Email programado exitosamente');
            }
        }
        return view('dashboard/marketing/crear_email');
    }
}