<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aprendiz;
use App\Http\Requests\StoreUpdateAprendizRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AprendizController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        
        $this->authorize('viewAny', Aprendiz::class);
        #latest ordena por fecha de creación: más recientes primero. paginate(10) devuelve 10 por página.
        #compact('aprendices') es equivalente a ['aprendices' => $aprendices],
        #nos permite pasar variables a la vista.
        $aprendices = Aprendiz::query()
            ->when(
                $request->filled('nombre'),
                fn($q) =>
                $q->where('nombre', 'like', '%' . $request->nombre . '%')
            )
            ->when(
                $request->filled('correo'),
                fn($q) =>
                $q->where('correo', 'like', '%' . $request->correo . '%')
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('aprendices.index', compact('aprendices'));
    }
    public function create()
    {
        $this->authorize('create', Aprendiz::class);
        return view('aprendices.create');
    }
    public function store(StoreUpdateAprendizRequest $request)
    {
        $this->authorize('create', Aprendiz::class);
        Aprendiz::create($request->validated());

        return redirect()
            ->route('aprendices.index')
            ->with('ok', 'Aprendiz creado correctamente.');
    }
    public function edit(Aprendiz $aprendiz)
    {
        $this->authorize('update', $aprendiz);
        return view(
            'aprendices.edit',
            compact('aprendiz')
        );
    }
    public function update(StoreUpdateAprendizRequest $request, Aprendiz $aprendiz)
    {
        $this->authorize('update', $aprendiz);
        $aprendiz->update($request->validated());
        return redirect()
            ->route('aprendices.index')
            ->with('ok', 'Aprendiz actualizado');
    }
    public function destroy(Aprendiz $aprendiz)
    {
        $this->authorize('delete', $aprendiz);
        $aprendiz->delete();
        return redirect()
            ->route('aprendices.index')
            ->with('ok', 'Aprendiz eliminado');
    }
}
