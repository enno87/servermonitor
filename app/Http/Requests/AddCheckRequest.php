<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCheckRequest extends FormRequest
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
        $config = array_flip(config('server-monitor.checks'));
        $usedChecks = $this->route()->parameter('host')->checks->pluck('type');

        return [
            'name' => ['required', 'array'],
            'name.*' => [Rule::in($config), Rule::notIn($usedChecks)],
        ];
    }
}
