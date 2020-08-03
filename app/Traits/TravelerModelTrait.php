<?php


namespace App\Traits;


use App\Traveler;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

trait TravelerModelTrait
{
    public function createTraveler(array $traveler)
    {
        $this->create($traveler);
    }


    public function getAllTraveler(User $user)
    {
        return $user->agency()->with('traveler')->get()->pluck('traveler')->flatten();
    }

    public function getTravelerById(User $user, $id)
    {
        $travel = $user->agency()->with(array('traveler' => function ($query) use ($id) {
            $query->where('id', $id);
        }))->get()->pluck('traveler')->flatten()->first();
        if (!$travel) {
            throw new ModelNotFoundException;
        }
        return $travel;
    }

    public function updateTraveler(Traveler $traveler,array $data)
    {
        $traveler->update($data);
    }
}
