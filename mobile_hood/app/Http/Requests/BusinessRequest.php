<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        $rules = [
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png,jpeg,webp',
            'street' => 'required|string|max:255',
            'number' => 'required|integer',
            'user' => 'required|array|min:0|max:1',
            'user.*' => 'required|regex:/^[0-9]+$/',
            'category' => 'required|array|min:0|max:1',
            'category.*' => 'required|regex:/^[a-z_]+$/',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];

        foreach ($days as $day) {

            $rules["{$day}_switch"] = 'boolean';

            $rules["{$day}_open_time"] = 'array|min:0|max:1';
            $rules["{$day}_open_time.*"] = 'regex:/^[0-9:]+$/';
            $rules["{$day}_time_period_open"] = 'array|min:0|max:1';
            $rules["{$day}_time_period_open.*"] = 'regex:/^[AMP]+$/';
            $rules["{$day}_close_time"] = 'array|min:0|max:1';
            $rules["{$day}_close_time.*"] = 'regex:/^[0-9:]+$/';
            $rules["{$day}_time_period_close"] = 'array|min:0|max:1';
            $rules["{$day}_time_period_close.*"] = 'regex:/^[AMP]+$/';
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sunday_switch' => $this->has('sunday_switch'),
            'monday_switch' => $this->has('monday_switch'),
            'tuesday_switch' => $this->has('tuesday_switch'),
            'wednesday_switch' => $this->has('wednesday_switch'),
            'thursday_switch' => $this->has('thursday_switch'),
            'friday_switch' => $this->has('friday_switch'),
            'saturday_switch' => $this->has('saturday_switch'),
        ]);
    }
}
