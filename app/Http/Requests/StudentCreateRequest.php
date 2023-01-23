<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nis' => 'unique:students|max:8|required',
            'name' => 'max:50|required',
            'gender' => 'required',
            'class_id' => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'class_id' => 'class',  // mengubah nama required/validation class id menjadi class
        ];
    }
    
    public function messages()
    {
        return [
            'nis.required' => 'NIS tidak boleh kosong',
            'nis.max' => 'NIS tidak boleh lebih dari :max karakter',
            'name.required' => 'Silahkan isi Name',
            'gender.required' => 'Silahkan isi gender anda',
            'class_id.required' => 'Silahkan isi class anda'
        ];
    }
}
