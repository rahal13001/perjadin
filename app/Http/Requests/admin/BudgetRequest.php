<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
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
            'kode_anggaran' => 'required|max:255',
            'mata_anggaran' => 'required',
            'jumlah' => 'required',
            'dokumen' => 'required|max:255'
        ];
    }
}
