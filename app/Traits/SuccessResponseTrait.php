<?php


namespace App\Traits;


trait SuccessResponseTrait
{
    protected function SuccessResponse(...$message)
    {
        return response()->json([
            'meta' => [
                'status' => 'Success',
                'message' => $message
            ]

        ], 200);
    }

    protected function tokenResponse($token)
    {
        return response()->json([
            'data'=>[
                'token'=>$token
            ],
            'meta' => [
                'status' => 'Success'
            ]

        ], 200);
    }
}
