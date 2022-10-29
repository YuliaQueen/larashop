<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'token'    => ['required'],
            'email'    => ['required', 'email:dns'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
             'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value()
        ]);
    }
}
