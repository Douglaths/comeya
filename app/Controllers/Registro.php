<?php

namespace App\Controllers;

class Registro extends BaseController
{
    public function index()
    {
        return view('registro');
    }

    public function solicitar()
    {
        try {
            $db = \Config\Database::connect();
            
            $data = [
                'nombre_empresa' => $this->request->getPost('nombre_empresa'),
                'email' => $this->request->getPost('email'),
                'telefono' => $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion'),
                'nombre_contacto' => $this->request->getPost('nombre_contacto'),
                'mensaje' => $this->request->getPost('mensaje'),
                'estado' => 'pendiente'
            ];

            $result = $db->table('solicitudes_registro')->insert($data);
            
            if ($result) {
                return redirect()->to(base_url('login'))->with('success', 'Solicitud enviada correctamente. Te contactaremos pronto.');
            } else {
                return redirect()->back()->with('error', 'Error al enviar la solicitud');
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}