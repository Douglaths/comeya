<?php

namespace App\Models;

use CodeIgniter\Model;

class CampanaModel extends Model
{
    protected $table = 'campanas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre', 'tipo', 'plataforma', 'presupuesto', 'fecha_inicio', 
        'fecha_fin', 'objetivo', 'estado', 'metricas'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|max_length[255]',
        'tipo' => 'required|in_list[google_ads,meta_ads,email,seo,contenido]',
        'plataforma' => 'permit_empty|max_length[100]',
        'presupuesto' => 'permit_empty|decimal',
        'fecha_inicio' => 'required|valid_date',
        'fecha_fin' => 'permit_empty|valid_date'
    ];
}