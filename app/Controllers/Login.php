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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            return redirect()->back()->with('error', 'Email y contraseña son requeridos');
        }

        $db = \Config\Database::connect();
        $empresa = $db->table('empresas')
            ->where('email', $email)
            ->where('activo', 1)
            ->get()
            ->getRowArray();

        if (!$empresa) {
            return redirect()->back()->with('error', 'Email no encontrado');
        }

        if (!password_verify($password, $empresa['password'])) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }

        session()->set([
            'empresa_id' => $empresa['id'],
            'user_name' => $empresa['nombre'],
            'user_email' => $empresa['email'],
            'logged_in' => true
        ]);
        
        return redirect()->to(base_url('admin'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}