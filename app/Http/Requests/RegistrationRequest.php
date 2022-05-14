<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationErrorSingularException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'max:32', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'password_confirmation' => [
                'required_unless:password,null',
                function($attribute, $value, $fail){
                    if(!$this->password){
                        return true;
                    }
                    if($this->password !== $value){
                        $fail('Password tidak sama');
                    }
                }
            ]
        ];
    }

    public function messages(){
        return [
            'username.required' => 'Harap masukkan username Anda',
            'username.max' => 'Maksimal nama username adalah 32 karakter',
            'username.unique' => 'Username :value telah terdaftar',
            'email.required' => 'Harap masukkan email Anda',
            'email.email' => 'Harap masukkan format email yang benar',
            'email:unique' => 'Email :value telah terdaftar',
            'password.required' => 'Masukkan kata sandi Anda',
            'password_confirmation.required_unless' => 'Harap konfirmasi kata sandi Anda'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new ValidationErrorSingularException($validator);
    }
}
