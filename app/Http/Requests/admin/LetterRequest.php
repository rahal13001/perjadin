<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LetterRequest extends FormRequest
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
            'no_spt' => 'required',
            'tujuan' => 'required|string',
            'budget_id' => 'required|exists:budgets,id',
            'keterangan' => 'required',
            'agenda' => 'required|max:255|string',
            'tanggal' => 'required|date',
            'durasi' => 'required|integer'
        ];
    }
}
