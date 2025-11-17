<?php

namespace App\Controllers;

use App\Models\PromocionModel;
use App\Models\BannerModel;
use App\Models\MaterialPromocionalModel;
use App\Models\EmpresaModel;

class Publicidad extends BaseController
{
    protected $promocionModel;
    protected $bannerModel;
    protected $materialModel;
    protected $empresaModel;

    public function __construct()
    {
        $this->promocionModel = new PromocionModel();
        $this->bannerModel = new BannerModel();
        $this->materialModel = new MaterialPromocionalModel();
        $this->empresaModel = new EmpresaModel();
    }

    public function index()
    {
        $data = [
            'promocionesActivas' => $this->promocionModel->where('activo', 1)->countAllResults(),
            'bannersActivos' => $this->bannerModel->where('activo', 1)->countAllResults(),
            'materialesDisponibles' => $this->materialModel->countAll(),
            'empresasDestacadas' => $this->empresaModel->where('destacado', 1)->countAllResults()
        ];
        return view('dashboard/publicidad/index', $data);
    }

    public function promociones()
    {
        $data = [
            'promociones' => $this->promocionModel->select('promociones.*, empresas.nombre as empresa_nombre')
                                                 ->join('empresas', 'empresas.id = promociones.empresa_id')
                                                 ->orderBy('created_at', 'DESC')
                                                 ->findAll(),
            'empresas' => $this->empresaModel->findAll()
        ];
        return view('dashboard/publicidad/promociones', $data);
    }

    public function crearPromocion()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'empresa_id' => $this->request->getPost('empresa_id'),
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'descuento' => $this->request->getPost('descuento'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
                'posicion' => $this->request->getPost('posicion'),
                'activo' => 1
            ];

            if ($this->promocionModel->insert($datos)) {
                return redirect()->to('/public/superadmin/publicidad/promociones')->with('success', 'Promoción creada exitosamente');
            }
        }

        $data = ['empresas' => $this->empresaModel->findAll()];
        return view('dashboard/publicidad/crear_promocion', $data);
    }

    public function banners()
    {
        $data = [
            'banners' => $this->bannerModel->orderBy('posicion', 'ASC')->findAll()
        ];
        return view('dashboard/publicidad/banners', $data);
    }

    public function crearBanner()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'titulo' => $this->request->getPost('titulo'),
                'imagen_url' => $this->request->getPost('imagen_url'),
                'enlace' => $this->request->getPost('enlace'),
                'posicion' => $this->request->getPost('posicion'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
                'activo' => 1
            ];

            if ($this->bannerModel->insert($datos)) {
                return redirect()->to('/public/superadmin/publicidad/banners')->with('success', 'Banner creado exitosamente');
            }
        }
        return view('dashboard/publicidad/crear_banner');
    }

    public function material()
    {
        $data = [
            'materiales' => $this->materialModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('dashboard/publicidad/material', $data);
    }

    public function crearMaterial()
    {
        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'tipo' => $this->request->getPost('tipo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'archivo_url' => $this->request->getPost('archivo_url'),
                'categoria' => $this->request->getPost('categoria')
            ];

            if ($this->materialModel->insert($datos)) {
                return redirect()->to('/public/superadmin/publicidad/material')->with('success', 'Material creado exitosamente');
            }
        }
        return view('dashboard/publicidad/crear_material');
    }

    public function destacados()
    {
        $data = [
            'empresasDestacadas' => $this->empresaModel->where('destacado', 1)->findAll(),
            'empresasDisponibles' => $this->empresaModel->where('destacado', 0)->where('activo', 1)->findAll()
        ];
        return view('dashboard/publicidad/destacados', $data);
    }

    public function toggleDestacado($id)
    {
        $empresa = $this->empresaModel->find($id);
        if ($empresa) {
            $this->empresaModel->update($id, ['destacado' => !$empresa['destacado']]);
        }
        return redirect()->to('/public/superadmin/publicidad/destacados');
    }
}