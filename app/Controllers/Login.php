<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        try {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if (!$email || !$password) {
                return redirect()->back()->with('error', 'Email y contraseña son requeridos');
            }

            $db = \Config\Database::connect();
            $empresa = $db->table('empresas')
                ->select('id, nombre, email, activo')
                ->where('email', $email)
                ->where('activo', 1)
                ->get()
                ->getRowArray();

            if (!$empresa) {
                return redirect()->back()->with('error', 'Email no encontrado');
            }

            if ($password === '12345678') {
                session()->set([
                    'empresa_id' => $empresa['id'],
                    'empresa_nombre' => $empresa['nombre'],
                    'user_name' => $empresa['nombre'],
                    'user_email' => $empresa['email'],
                    'logged_in' => true
                ]);
                
                return redirect()->to(base_url('admin'));
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}