<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aprendiz;

class AprendizController extends Controller
{
    public function index(Request $request)
    {
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
        return view('aprendices.create');
    }
    public function store(Request $request)
    {
        // Validación mínima (simulación de guardado)
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'documento' => ['required', 'string', 'max:40'],
            'correo' => ['required', 'email', 'max:120'],
        ]);
        // Aquí NO guardamos en BD (lo haremos en Semana 4 con Eloquent).
        // Objetivo Semana 2: comprobar flujo ruta ³ acción ³ vista ³ redirect.
        return redirect()->route('aprendices.index')
            ->with('ok', 'Aprendiz recibido (simulado)');
    }
    public function show($id)
    {
        abort(404);
    } // no usado en S2
    public function edit($id)
    {
        abort(404);
    } // no usado en S2
    public function update(Request $r, $id)
    {
        abort(404);
    } // no usado en S2
    public function destroy($id)
    {
        abort(404);
    } // no usado en S2
}
