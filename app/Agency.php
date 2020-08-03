<?php

namespace App;

use App\Traits\AgencyModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agency extends Model
{
    use AgencyModelTrait;
    protected $table = "agency";

    protected $fillable = [
        'user_id', 'name', 'address'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tour()
    {
        return $this->hasMany(Tour::class, 'agency_id');
    }

    public function traveler()
    {
        return $this->hasMany(Traveler::class, 'agency_id', 'id');
    }


}
