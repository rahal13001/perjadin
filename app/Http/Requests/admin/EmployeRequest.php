<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;


class EmployeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|max:255',
            'nip' => 'required|size:18|unique:employes,nip',
            'no_hp' => 'required|unique:employes,no_hp',
            'email' => 'required|unique:employes,email',
            'pangkat' => 'required',
            'status' => 'required',
            'tipe' => 'required',
            'foto' => 'image|max:2048',
            'jabatan' => 'required',
            'umur' => 'required'
        ];
    }
}
