<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'titulo', 'imagen_url', 'enlace', 'posicion', 'fecha_inicio', 
        'fecha_fin', 'clicks', 'activo'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'titulo' => 'required|max_length[255]',
        'imagen_url' => 'required|valid_url',
        'enlace' => 'permit_empty|valid_url',
        'posicion' => 'required|in_list[header,sidebar,footer,popup]',
        'fecha_inicio' => 'required|valid_date',
        'fecha_fin' => 'permit_empty|valid_date'
    ];
}