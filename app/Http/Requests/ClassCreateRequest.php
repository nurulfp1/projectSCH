<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassCreateRequest extends FormRequest
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
            'name' => 'max:50|required',
            'teacher_id' => 'required'
        ];
    }
    
    public function messages()
    {
        return[
            'name.required' => 'Silahkan isi nama class',
            'name.max' => 'Name tidak boleh lebih dari :max karakter',
            'teacher_id.required' => 'Silahkan pilih teacher',
        ];
    }
}
