<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:3'],
            'middle_name' => ['nullable', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:3'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'zip_code' => ['required', 'string', 'min:3'],
            'birthdate' => ['nullable', 'date'],
            'date_hired' => ['nullable', 'date'],
        ];
    }
}
