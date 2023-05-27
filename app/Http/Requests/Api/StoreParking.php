<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreParking extends FormRequest
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
        $rules = [
            'user_id' => 'required',
            'vehicle_id' => 'required',
            'zone_id' => 'required',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'total_price' => 'nullable',
            'is_active' => 'required',
        ];

        return $rules;
    }
}
