<?php

namespace App;

use App\Traits\TourModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tour extends Model
{
    use TourModelTrait;
    protected $table = "tour";

    protected $fillable = [
        'agency_id', 'name'
    ];

    public function agency(){
        return $this->belongsTo(Agency::class,'agency_id','id');
    }



}
