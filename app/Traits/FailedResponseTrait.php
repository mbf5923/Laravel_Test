<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait FailedResponseTrait
{
    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function failedResponse($message, int $code)
    {
        return response()->json([
            'meta' => [
                'status' => 'failed',
                'message' => $message
            ]

        ], $code);
    }

    /**
     * @param $errors
     * @return JsonResponse
     */
    protected function failedValidationResponse($errors)
    {

        return $this->failedResponse($errors->messages(), 422);


    }


}
