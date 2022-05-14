<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;

class ValidationErrorSingularException extends Exception
{
    protected $validator;

    protected $code = 422;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function render(){
        $errors = [];
        foreach($this->validator->errors()->toArray() as $error => $bag){
            $errors[$error] = $bag[0];
        }
        return response()->json([
            'error' => 'Form validation error',
            'messages' => $errors,
        ], $this->code);
    }
}
