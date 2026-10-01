<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AprendizController extends Controller
{
 public function index()
 {
 // Semana 2: sin BD; solo devolvemos la vista
 return view('aprendices.index');
 }
 public function create()
 {
 return view('aprendices.create');
 }
 public function store(Request $request)
 {
 // Validación mínima (simulación de guardado)
 $data = $request->validate([
 'nombre' => ['required','string','max:120'],
 'documento' => ['required','string','max:40'],
 'correo' => ['required','email','max:120'],
 ]);
 // Aquí NO guardamos en BD (lo haremos en Semana 4 con Eloquent).
 // Objetivo Semana 2: comprobar flujo ruta ³ acción ³ vista ³ redirect.
 return redirect()->route('aprendices.index')
 ->with('ok','Aprendiz recibido (simulado)');
 }
 public function show($id) { abort(404); } // no usado en S2
 public function edit($id) { abort(404); } // no usado en S2
 public function update(Request $r, $id) { abort(404); } // no usado en S2
 public function destroy($id) { abort(404); } // no usado en S2
}