<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class validacionesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre'    => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'precio'    => 'required|numeric|min:0',
            'stock'     => 'required|integer|min:0',
            'imagen'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}


   
