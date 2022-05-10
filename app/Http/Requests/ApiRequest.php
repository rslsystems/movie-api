<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApiRequest
 * @package Requests
 * @version 1.0.0
 */
class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:191',
            'year' => 'nullable|numeric|min:1888|max:' . date('Y'),
            'actor' => 'nullable|string|max:191|exists:actors,name',
        ];
    }

    /**
     * Gets all the parameters
     * @param $keys
     * @return array
     */
    public function all($keys = null): array
    {
        $all = parent::all($keys);

        if ($this->route()) {
            array_merge($all, $this->route()->parameters());
        }

        return array_merge($all);
    }
}
