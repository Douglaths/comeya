<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['empresa_id', 'nombre', 'email', 'password', 'rol', 'activo', 'telefono', 'direccion', 'foto_perfil'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email|is_unique[usuarios.email]',
        'password' => 'required|min_length[6]',
        'rol' => 'required|in_list[superadmin,admin_empresa,usuario]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Este email ya está registrado.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}