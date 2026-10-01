<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'administrador';
    }

    public function view(User $user, User $model): bool
    {
        return $user->role === 'administrador';
    }

    public function create(User $user): bool
    {
        return $user->role === 'administrador';
    }

    /**
     * El administrador puede editar a CUALQUIER usuario,
     * incluidos otros administradores y a sí mismo.
     */
    public function update(User $user, User $model): bool
    {
        return $user->role === 'administrador';
    }

    public function delete(User $user, User $model): bool
    {
        if ($user->role !== 'administrador') {
            return false;
        }

        // No autoeliminarse
        if ($user->id === $model->id) {
            return false;
        }

        // No eliminar otros administradores
        if ($model->role === 'administrador') {
            return false;
        }

        return true;
    }
}