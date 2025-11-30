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
                ->select('id, nombre, email, password, activo')
                ->where('email', $email)
                ->where('activo', 1)
                ->get()
                ->getRowArray();

            if (!$empresa) {
                return redirect()->back()->with('error', 'Email no encontrado');
            }

            // Verificar contraseña
            $passwordValid = false;
            
            if ($empresa['password']) {
                // Usar contraseña hasheada si existe
                $passwordValid = password_verify($password, $empresa['password']);
            } else {
                // Fallback a contraseña por defecto
                $passwordValid = ($password === '12345678');
            }

            if ($passwordValid) {
                // Buscar usuario asociado a la empresa
                $usuario = $db->table('usuarios')
                    ->select('nombre, email, foto_perfil, rol')
                    ->where('empresa_id', $empresa['id'])
                    ->where('activo', 1)
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getRowArray();
                
                // Convertir rol de base de datos a nombre legible
                $roleMap = [
                    'administrador' => 'Administrador',
                    'admin_empresa' => 'Administrador',
                    'empleado' => 'Empleado',
                    'gerente' => 'Gerente'
                ];
                
                $userRole = 'Administrador';
                if ($usuario && !empty($usuario['rol'])) {
                    $userRole = $roleMap[$usuario['rol']] ?? 'Administrador';
                }
                
                session()->set([
                    'empresa_id' => $empresa['id'],
                    'empresa_nombre' => $empresa['nombre'],
                    'user_name' => $usuario ? $usuario['nombre'] : $empresa['nombre'],
                    'user_email' => $usuario ? $usuario['email'] : $empresa['email'],
                    'user_photo' => $usuario ? $usuario['foto_perfil'] : null,
                    'user_role' => $userRole,
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