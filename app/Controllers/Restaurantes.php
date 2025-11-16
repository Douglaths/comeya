<?php

namespace App\Controllers;

class Restaurantes extends BaseController
{
    public function index()
    {
        return view('Restaurantes/restaurantes');
    }
}