<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $users = User::query()
            ->when(
                $request->filled('name'),
                fn($q) =>
                $q->where('name', 'like', '%' . $request->name . '%')
            )
            ->when(
                $request->filled('email'),
                fn($q) =>
                $q->where('email', 'like', '%' . $request->email . '%')
            )
            ->when(
                $request->filled('role'),
                fn($q) =>
                $q->where('role', $request->role)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    public function store(StoreUpdateUserRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validated();

        // El cast 'hashed' del modelo User hashea automáticamente
        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('ok', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);
        return view('users.edit', compact('usuario'));
    }

    public function update(StoreUpdateUserRequest $request, User $usuario)
    {
        $this->authorize('update', $usuario);

        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()
            ->route('users.index')
            ->with('ok', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        $this->authorize('delete', $usuario);

        $usuario->delete();

        return redirect()
            ->route('users.index')
            ->with('ok', 'Usuario eliminado correctamente.');
    }
}
