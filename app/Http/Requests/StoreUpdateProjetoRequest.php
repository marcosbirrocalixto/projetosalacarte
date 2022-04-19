<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProjetoRequest extends FormRequest
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
        $url = $this->segment(3);

        return [
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['nullable', 'min:3', 'max:1000'],
            'image' => ['nullable', 'image'],
            'orcamento' => "required|regex:(\d*,\d*)",
        ];
    }
}
