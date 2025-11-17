<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitaModel extends Model
{
    protected $table = 'visitas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empresa_id', 'ip', 'user_agent', 'dispositivo', 'navegador', 'origen', 'fecha_visita'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getVisitasHoy()
    {
        return $this->where('DATE(fecha_visita)', date('Y-m-d'))
                   ->countAllResults();
    }

    public function getVisitasMes()
    {
        return $this->where('YEAR(fecha_visita)', date('Y'))
                   ->where('MONTH(fecha_visita)', date('m'))
                   ->countAllResults();
    }

    public function getVisitasTotal()
    {
        return $this->countAllResults();
    }

    public function getEmpresasConVisitas()
    {
        return $this->select('COUNT(DISTINCT empresa_id) as total')
                   ->where('DATE(fecha_visita)', date('Y-m-d'))
                   ->get()->getRow()->total ?? 0;
    }

    public function getVisitasPorDia($dias = 30)
    {
        return $this->select('DATE(fecha_visita) as fecha, COUNT(*) as total')
                   ->where('fecha_visita >=', date('Y-m-d', strtotime("-{$dias} days")))
                   ->groupBy('DATE(fecha_visita)')
                   ->orderBy('fecha', 'ASC')
                   ->findAll();
    }

    public function getRankingEmpresas($fechaInicio, $fechaFin)
    {
        return $this->select('empresas.nombre, COUNT(visitas.id) as total_visitas, COUNT(DISTINCT visitas.ip) as visitantes_unicos')
                   ->join('empresas', 'empresas.id = visitas.empresa_id')
                   ->where('visitas.fecha_visita >=', $fechaInicio)
                   ->where('visitas.fecha_visita <=', $fechaFin . ' 23:59:59')
                   ->groupBy('visitas.empresa_id')
                   ->orderBy('total_visitas', 'DESC')
                   ->findAll();
    }

    public function getDispositivosStats($fechaInicio, $fechaFin)
    {
        return $this->select('dispositivo, COUNT(*) as total')
                   ->where('fecha_visita >=', $fechaInicio)
                   ->where('fecha_visita <=', $fechaFin . ' 23:59:59')
                   ->groupBy('dispositivo')
                   ->orderBy('total', 'DESC')
                   ->findAll();
    }

    public function getNavegadoresStats($fechaInicio, $fechaFin)
    {
        return $this->select('navegador, COUNT(*) as total')
                   ->where('fecha_visita >=', $fechaInicio)
                   ->where('fecha_visita <=', $fechaFin . ' 23:59:59')
                   ->groupBy('navegador')
                   ->orderBy('total', 'DESC')
                   ->limit(10)
                   ->findAll();
    }

    public function getOrigenesStats($fechaInicio, $fechaFin)
    {
        return $this->select('origen, COUNT(*) as total')
                   ->where('fecha_visita >=', $fechaInicio)
                   ->where('fecha_visita <=', $fechaFin . ' 23:59:59')
                   ->groupBy('origen')
                   ->orderBy('total', 'DESC')
                   ->findAll();
    }
}