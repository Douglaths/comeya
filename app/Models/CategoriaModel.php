<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['empresa_id', 'nombre', 'descripcion', 'orden', 'activo'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'empresa_id' => 'required|integer',
        'nombre' => 'required|min_length[3]|max_length[255]',
        'activo' => 'in_list[0,1]'
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}