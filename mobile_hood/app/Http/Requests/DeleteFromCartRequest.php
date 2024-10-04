<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class DeleteFromCartRequest extends FormRequest
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
        return [
            'user' => 'required|exists:users,id',
            'business' => 'required|exists:businesses,id',
            'products.*' => 'regex:/^[0-9]+$/',
            'cartProducts' => 'required|array',
            //'cartProducts.*' => 'exists:carts,id|nullable',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message' => 'Unauthorized',
            'errors' => $validator->errors(),
        ], Response::HTTP_UNAUTHORIZED);

        throw new ValidationException($validator, $response);
    }
}
