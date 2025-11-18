<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class Home extends BaseController
{
    public function index()
    {
        $empresaModel = new EmpresaModel();
        
        $filters = [
            'search' => $this->request->getGet('search'),
            'ciudad' => $this->request->getGet('ciudad'),
            'categoria' => $this->request->getGet('categoria'),
            'plan' => $this->request->getGet('plan'),
            'oferta_2x1' => $this->request->getGet('oferta_2x1'),
            'envio_gratis' => $this->request->getGet('envio_gratis'),
            'descuento_activo' => $this->request->getGet('descuento_activo')
        ];

        $data = [
            'restaurantes' => $empresaModel->getRestaurantesActivos($filters),
            'ciudades' => $empresaModel->getCiudades(),
            'categorias' => $empresaModel->getCategorias(),
            'filters' => $filters
        ];

        return view('home', $data);
    }
}