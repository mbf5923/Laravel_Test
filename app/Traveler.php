<?php

namespace App;

use App\Traits\TravelerModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Traveler extends Model
{
    use TravelerModelTrait;
    protected $table = "traveler";

    protected $fillable = [
        'agency_id', 'name', 'family', 'phone'
    ];


    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }


}
