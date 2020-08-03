<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelerResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name.' '.$this->family,
            'phone'=>$this->phone
        ];
    }


    public function with($request)
    {
        return ['meta'=>['status'=>'Success']];
    }
}
