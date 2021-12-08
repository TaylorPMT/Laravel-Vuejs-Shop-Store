<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait TraitValidator
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $responseCode = 200;
        $response = new JsonResponse([
            'error' => $validator->errors(),
            'response_code' => $responseCode,
            'message' => 'error',
            'data' => null
        ], $responseCode);

        throw new ValidationException($validator, $response);
    }
}