<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialPromocionalModel extends Model
{
    protected $table = 'material_promocional';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre', 'tipo', 'descripcion', 'archivo_url', 'categoria', 'descargas'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|max_length[255]',
        'tipo' => 'required|in_list[flyer,qr,banner,plantilla,logo]',
        'descripcion' => 'permit_empty|max_length[500]',
        'archivo_url' => 'required|valid_url',
        'categoria' => 'required|in_list[restaurante,general,promocional]'
    ];
}