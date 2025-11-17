<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoModel extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'factura_id', 'monto', 'metodo_pago', 'estado', 'fecha_pago', 
        'referencia_externa', 'notas'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'factura_id' => 'required|integer',
        'monto' => 'required|decimal',
        'metodo_pago' => 'required|in_list[stripe,transferencia,efectivo,paypal]',
        'estado' => 'required|in_list[pendiente,completado,fallido,reembolsado]',
        'fecha_pago' => 'required|valid_date'
    ];

    protected $validationMessages = [
        'factura_id' => [
            'required' => 'La factura es obligatoria',
            'integer' => 'ID de factura inválido'
        ],
        'monto' => [
            'required' => 'El monto es obligatorio',
            'decimal' => 'El monto debe ser un número válido'
        ]
    ];
}