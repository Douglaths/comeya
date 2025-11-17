<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'empresa_id', 'numero', 'monto', 'estado', 'fecha_emision', 
        'fecha_vencimiento', 'concepto', 'plan_id'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'empresa_id' => 'required|integer',
        'numero' => 'required|max_length[50]',
        'monto' => 'required|decimal',
        'estado' => 'required|in_list[pendiente,pagada,vencida,cancelada]',
        'fecha_emision' => 'required|valid_date',
        'fecha_vencimiento' => 'required|valid_date'
    ];

    protected $validationMessages = [
        'empresa_id' => [
            'required' => 'La empresa es obligatoria',
            'integer' => 'ID de empresa inválido'
        ],
        'numero' => [
            'required' => 'El número de factura es obligatorio',
            'max_length' => 'El número no puede exceder 50 caracteres'
        ],
        'monto' => [
            'required' => 'El monto es obligatorio',
            'decimal' => 'El monto debe ser un número válido'
        ]
    ];
}