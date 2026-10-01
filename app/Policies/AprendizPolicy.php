<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Aprendiz;

class AprendizPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['administrador', 'instructor', 'aprendiz']);
    }

    public function view(User $user, Aprendiz $aprendiz): bool
    {
        return in_array($user->role, ['administrador', 'instructor', 'aprendiz']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['administrador', 'instructor']);
    }

    public function update(User $user, Aprendiz $aprendiz): bool
    {
        return in_array($user->role, ['administrador', 'instructor']);
    }

    public function delete(User $user, Aprendiz $aprendiz): bool
    {
        // Solo admin
        if ($user->role !== 'administrador') {
            return false;
        }

        // No autoeliminarse
        if (strtolower($aprendiz->correo) === strtolower($user->email)) {
            return false;
        }

        // No eliminar a otro administrador
        $esAdmin = User::where('email', $aprendiz->correo)
                       ->where('role', 'administrador')
                       ->exists();

        if ($esAdmin) {
            return false;
        }

        return true;
    }
}