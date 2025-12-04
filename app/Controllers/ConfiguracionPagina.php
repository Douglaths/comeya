<?php

namespace App\Controllers;

class ConfiguracionPagina extends BaseController
{
    public function obtener()
    {
        $db = \Config\Database::connect();
        
        // Obtener configuración existente
        $config = $db->table('configuracion_pagina')
                    ->where('id', 1)
                    ->get()
                    ->getRowArray();
        
        if (!$config) {
            // Crear configuración por defecto si no existe
            $defaultConfig = [
                'id' => 1,
                'titulo_principal' => 'Encuentra tu restaurante favorito',
                'subtitulo' => 'Comida deliciosa a domicilio',
                'promociones' => '[]'
            ];
            
            $db->table('configuracion_pagina')->insert($defaultConfig);
            $config = $defaultConfig;
        }
        
        // Decodificar promociones
        $config['promociones'] = json_decode($config['promociones'] ?? '[]', true);
        
        return $this->response->setJSON([
            'success' => true,
            'configuracion' => $config
        ]);
    }
    
    public function guardar()
    {
        $request = $this->request->getJSON();
        
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Datos inválidos']);
        }
        
        $db = \Config\Database::connect();
        
        $data = [
            'titulo_principal' => $request->titulo_principal ?? '',
            'subtitulo' => $request->subtitulo ?? '',
            'promociones' => json_encode($request->promociones ?? []),
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];
        
        // Verificar si existe configuración
        $exists = $db->table('configuracion_pagina')->where('id', 1)->get()->getRowArray();
        
        if ($exists) {
            $db->table('configuracion_pagina')->where('id', 1)->update($data);
        } else {
            $data['id'] = 1;
            $db->table('configuracion_pagina')->insert($data);
        }
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Configuración guardada exitosamente'
        ]);
    }
}