<?php


namespace App\Http\Controllers\Admin;


use App\Agency;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\AgencyResourceCollection;
use App\Http\Resources\TravelerResource;
use App\Http\Resources\TravelerResourceCollection;
use App\Traveler;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TravelerController extends Controller
{
    protected $traveler;

    public function __construct(Traveler $traveler)
    {
        $this->traveler = $traveler;
    }

    public function createTraveler(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'agency_id' => 'required|exists:agency,id,user_id,' . Auth::id(),
            'name' => 'required|max:255',
            'family' => 'required|max:255',
            'phone' => 'required|unique:traveler'

        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $this->traveler->createTraveler($request->only(['agency_id', 'name', 'family', 'phone']));

        return $this->SuccessResponse();
    }

    public function getAllTraveler(User $user)
    {
        $user = $user->getAdminById(Auth::id());
        return new TravelerResourceCollection($this->traveler->getAllTraveler($user));
    }

    public function getTravelerById(User $user, $id)
    {
        $user = $user->getAdminById(Auth::id());
        return new TravelerResource($this->traveler->getTravelerById($user, $id));
    }


    public function updateTraveler(User $user, Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'family' => 'string|max:500',
            'phone' => [
                'string',
                'max:15',
                Rule::unique('traveler')->ignore($id),
            ]
        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $user = $user->getAdminById(Auth::id());
        $traveler = $this->traveler->getTravelerById($user, $id);
        $this->traveler->updateTraveler($traveler, $request->only(['name', 'family', 'phone']));
        return $this->SuccessResponse();
    }
    public function deleteAgency($id)
    {
        $user = $this->agency->getAgencyById($id);
        $this->agency->deleteAdmin($user);
        return $this->SuccessResponse();
    }


}
