<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCreateRequest extends FormRequest
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
            'name' => 'max:5|required',
            'class_id' => 'required'
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
            'name.required' => 'Silahkan isi Name',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter',
            'class_id.required' => 'Silahkan pilih class'
        ];
    }
}
