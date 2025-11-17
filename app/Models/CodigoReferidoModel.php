<?php

namespace App\Models;

use CodeIgniter\Model;

class CodigoReferidoModel extends Model
{
    protected $table = 'codigos_referidos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'codigo', 'descripcion', 'descuento_porcentaje', 'limite_usos', 
        'usos_actuales', 'fecha_expiracion', 'activo'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'codigo' => 'required|max_length[50]|is_unique[codigos_referidos.codigo]',
        'descripcion' => 'permit_empty|max_length[255]',
        'descuento_porcentaje' => 'required|integer|greater_than[0]|less_than_equal_to[100]',
        'limite_usos' => 'permit_empty|integer'
    ];
}