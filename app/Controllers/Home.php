<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Página de Inicio'
        ];
        return view('home', $data);
    }
}
