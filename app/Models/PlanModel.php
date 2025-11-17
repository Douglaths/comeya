<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanModel extends Model
{
    protected $table = 'planes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre', 'precio', 'limite_productos', 'caracteristicas', 'activo'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|max_length[100]',
        'precio' => 'required|decimal',
        'limite_productos' => 'required|integer',
        'caracteristicas' => 'permit_empty|max_length[1000]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del plan es obligatorio',
            'max_length' => 'El nombre no puede exceder 100 caracteres'
        ],
        'precio' => [
            'required' => 'El precio es obligatorio',
            'decimal' => 'El precio debe ser un número válido'
        ]
    ];
}