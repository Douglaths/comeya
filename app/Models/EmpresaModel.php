<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'telefono', 'direccion', 'descripcion', 'ciudad', 'categoria_comida', 'promociones', 'envio_gratis', 'descuento_activo', 'oferta_2x1', 'plan', 'estado', 'activo', 'destacado', 'logo', 'foto_presentacion', 'costo_envio'];

    public function getRestaurantesActivos($filters = [])
    {
        $builder = $this->where('estado', 'activo');

        if (!empty($filters['search'])) {
            $builder->like('nombre', $filters['search']);
        }

        if (!empty($filters['ciudad'])) {
            if (is_array($filters['ciudad'])) {
                $builder->whereIn('ciudad', $filters['ciudad']);
            } else {
                $builder->where('ciudad', $filters['ciudad']);
            }
        }

        if (!empty($filters['categoria'])) {
            if (is_array($filters['categoria'])) {
                $builder->whereIn('categoria_comida', $filters['categoria']);
            } else {
                $builder->where('categoria_comida', $filters['categoria']);
            }
        }

        if (!empty($filters['plan'])) {
            $builder->where('plan', $filters['plan']);
        }

        if (!empty($filters['oferta_2x1'])) {
            $builder->where('oferta_2x1', 1);
        }

        if (!empty($filters['envio_gratis'])) {
            $builder->where('envio_gratis', 1);
        }

        if (!empty($filters['descuento_activo'])) {
            $builder->where('descuento_activo', 1);
        }

        return $builder->orderBy('destacado', 'DESC')
                      ->orderBy('nombre', 'ASC')
                      ->findAll();
    }

    public function getCiudades()
    {
        return $this->select('ciudad')
                   ->where('estado', 'activo')
                   ->groupBy('ciudad')
                   ->orderBy('ciudad', 'ASC')
                   ->findAll();
    }

    public function getCategorias()
    {
        try {
            return $this->select('categoria_comida')
                       ->where('estado', 'activo')
                       ->where('categoria_comida IS NOT NULL')
                       ->groupBy('categoria_comida')
                       ->orderBy('categoria_comida', 'ASC')
                       ->findAll();
        } catch (\Exception $e) {
            // Si la columna no existe, retornar array vacío
            return [];
        }
    }
}