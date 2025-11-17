<?php

namespace App\Controllers;

class Restaurantes extends BaseController
{
    public function index()
    {
        return view('Restaurantes/restaurantes');
    }

    public function confirmarPedido()
    {
        return view('Restaurantes/confirmar_pedido');
    }
}