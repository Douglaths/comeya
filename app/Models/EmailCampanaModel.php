<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailCampanaModel extends Model
{
    protected $table = 'email_campanas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'asunto', 'contenido', 'destinatarios', 'programado_para', 
        'enviado_en', 'estado', 'estadisticas'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'asunto' => 'required|max_length[255]',
        'contenido' => 'required',
        'destinatarios' => 'required|in_list[todos,activos,inactivos,trial]',
        'programado_para' => 'permit_empty|valid_date'
    ];
}