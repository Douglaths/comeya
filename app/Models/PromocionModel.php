<?php

namespace App\Models;

use CodeIgniter\Model;

class PromocionModel extends Model
{
    protected $table = 'promociones';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'empresa_id', 'titulo', 'descripcion', 'descuento', 'fecha_inicio', 
        'fecha_fin', 'posicion', 'activo'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'empresa_id' => 'required|integer',
        'titulo' => 'required|max_length[255]',
        'descripcion' => 'permit_empty|max_length[500]',
        'descuento' => 'permit_empty|integer',
        'fecha_inicio' => 'required|valid_date',
        'fecha_fin' => 'required|valid_date',
        'posicion' => 'required|in_list[hero,sidebar,footer]'
    ];
}