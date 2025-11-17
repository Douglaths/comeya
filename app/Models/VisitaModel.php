<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitaModel extends Model
{
    protected $table = 'visitas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['empresa_id', 'ip', 'user_agent', 'fecha_visita'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'empresa_id' => 'required|integer',
        'ip' => 'required|valid_ip'
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}