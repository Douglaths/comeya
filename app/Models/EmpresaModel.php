<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nombre', 'email', 'telefono', 'direccion', 'activo', 'fecha_alta'];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email|is_unique[empresas.email]',
        'activo' => 'in_list[0,1]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Este email ya está registrado.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}