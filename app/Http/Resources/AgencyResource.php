<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'name'=>$this->name,
            'address'=>$this->address
        ];
    }

    public function with($request)
    {
        return ['meta'=>['status'=>'Success']];
    }
}
