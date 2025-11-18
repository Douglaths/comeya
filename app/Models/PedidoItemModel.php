<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoItemModel extends Model
{
    protected $table = 'pedido_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['pedido_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal', 'notas'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'pedido_id' => 'required|integer',
        'producto_id' => 'required|integer',
        'cantidad' => 'required|integer|greater_than[0]',
        'precio_unitario' => 'required|decimal',
        'subtotal' => 'required|decimal'
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}