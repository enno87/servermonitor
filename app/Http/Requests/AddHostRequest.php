<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddHostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guest() === false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:hosts,name'],
            'ssh_user' => ['required'],
            'ip' => ['required', 'unique:hosts,ip', 'ip'],
            'port' => ['nullable', 'numeric'],
        ];
    }
}
