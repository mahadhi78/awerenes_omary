<?php

namespace App\Http\Controllers\setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
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
            'system_title'=>'required|string|min:5',
            'system_name' => 'required|string|min:5',
            'address' => 'required|string|min:5',
            'system_email' => 'sometimes|nullable|email',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',

        ];
    }

    public function attributes()
    {
        return  [
            'system_name' => 'School Name',
            'system_email' => 'School Email',
            'current_session' => 'Current Session',
        ];
    }
}
