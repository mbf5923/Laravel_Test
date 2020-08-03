<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

protected $table='role';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at','name','id'
    ];

    public function user(){
         return $this->hasMany(User::class,'role_id','id');//in user,in role
    }


}
