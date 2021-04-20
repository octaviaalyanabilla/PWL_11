<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Traits\ApiResponse;

abstract class ApiRequest extends FormRequest
{
    use ApiResponse;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiError(
           $validator->errors(),
           Response::HTTP_UNPROCESSABLE_ENTITY, 
        ));
    }

   
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiError(
            null,
            Response::HTTP_UNAUTHORIZED
        ));
    
    }
}
