<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class HoursRequest extends FormRequest
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

        $rules = [];

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
        //esto es para que convertir en falso a los switches ya que si llegan desactivados 
        //su valor es null y laravel no entiende a la hora de validar booleanos que un null es falso entonces explota. 
        //Por eso hay que transformar el valor de los switches a falso con el metodo has() el cual devuelve falso si el valor es nulo.
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
