<?php

namespace App\Controllers;

class Password extends BaseController
{
    public function forgot()
    {
        return view('password/forgot');
    }

    public function sendReset()
    {
        $email = $this->request->getPost('email');
        
        if (!$email) {
            return redirect()->back()->with('error', 'Email es requerido');
        }

        $db = \Config\Database::connect();
        
        // Verificar si el email existe
        $empresa = $db->table('empresas')->where('email', $email)->get()->getRowArray();
        
        if (!$empresa) {
            return redirect()->back()->with('error', 'Email no encontrado');
        }

        // Generar token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar token
        $db->table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiresAt
        ]);

        // Simular envío de email (en producción usar servicio real)
        $resetLink = base_url("password/reset/{$token}");
        
        return redirect()->to(base_url('login'))->with('success', 
            "Se ha enviado un enlace de recuperación a tu email. Link: {$resetLink}");
    }

    public function reset($token = null)
    {
        if (!$token) {
            return redirect()->to(base_url('login'))->with('error', 'Token inválido');
        }

        $db = \Config\Database::connect();
        
        // Verificar token
        $reset = $db->table('password_resets')
                   ->where('token', $token)
                   ->where('used', 0)
                   ->where('expires_at >', date('Y-m-d H:i:s'))
                   ->get()
                   ->getRowArray();

        if (!$reset) {
            return redirect()->to(base_url('login'))->with('error', 'Token inválido o expirado');
        }

        $data = ['token' => $token, 'email' => $reset['email']];
        return view('password/reset', $data);
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        if (strlen($password) < 6) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 6 caracteres');
        }

        $db = \Config\Database::connect();
        
        // Verificar token
        $reset = $db->table('password_resets')
                   ->where('token', $token)
                   ->where('used', 0)
                   ->where('expires_at >', date('Y-m-d H:i:s'))
                   ->get()
                   ->getRowArray();

        if (!$reset) {
            return redirect()->to(base_url('login'))->with('error', 'Token inválido o expirado');
        }

        $db->transStart();

        try {
            // Actualizar contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $db->table('empresas')
               ->where('email', $reset['email'])
               ->update(['password' => $hashedPassword]);

            // Marcar token como usado
            $db->table('password_resets')
               ->where('token', $token)
               ->update(['used' => 1]);

            $db->transComplete();

            return redirect()->to(base_url('login'))->with('success', 'Contraseña actualizada exitosamente');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error al actualizar la contraseña');
        }
    }
}