<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'user_id'=>$this->id,
            'username'=>$this->username,
            'email'=>$this->email,
            'article' => $this->when(Str::contains($request->url(),'withagency'), new AgencyResourceCollection($this->agency)),
        ];
    }

    public function with($request)
    {
        return ['meta'=>['status'=>'Success']];
    }
}
