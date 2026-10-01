<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUpdateAprendizRequest extends FormRequest
{
 public function authorize(): bool
 {
 // Autorizar esta operación (se puede integrar con auth más adelante)
 return true;
 }
 public function rules(): array
 {
 // Para update, obtener el ID del modelo si viene inyectado en la ruta
 $id = $this->route('aprendiz')?->id;
 return [
 'nombre' => ['required','string','max:120'],
 'documento' => [
 'required','string','max:40',
 Rule::unique('aprendices','documento')->ignore($id),
 ],
 'correo' => [
 'required','email','max:120',
 Rule::unique('aprendices','correo')->ignore($id),
 ],
 'ficha_id' => ['nullable','integer'],
 ];
 }
 public function messages(): array
 {
 return [
 'nombre.required' => 'El nombre es obligatorio.',
 'documento.required' => 'El documento es obligatorio.',
 'documento.unique' => 'El documento ya existe.',
 'correo.required' => 'El correo es obligatorio.',
 'correo.email' => 'El correo no es válido.',
 'correo.unique' => 'El correo ya existe.',
 'ficha_id.integer' => 'La ficha debe ser numérica.',
 ];
 }
}