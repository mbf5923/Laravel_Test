<?php


namespace App\Http\Controllers\Admin;


use App\Agency;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\AgencyResourceCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AgencyController extends Controller
{
    protected $agency;

    public function __construct(Agency $agency)
    {
        $this->agency=$agency;
    }

    public function createAgency(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:500',

        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $this->agency->createAgency($request->only(['name', 'address']));

        return $this->SuccessResponse();
    }

    public function getAllAgency(User $user)
    {
        $user=$user->getAdminById(Auth::id());
        return new AgencyResourceCollection($this->agency->getAllAgency($user));
    }

    public function getAgencyById(User $user,$id)
    {
        $user=$user->getAdminById(Auth::id());
        return new AgencyResource($this->agency->getAgencyById($user,$id));
    }




    public function updateAgency(User $user,Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'address' => 'string|max:500',
        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $user=$user->getAdminById(Auth::id());
        $agency = $this->agency->getAgencyById($user,$id);
        $this->agency->updateAgency($agency, $request->only(['name', 'address']));
        return $this->SuccessResponse();
    }


    public function deleteAgency(User $user,$id)
    {
        $user=$user->getAdminById(Auth::id());
        $user = $this->agency->getAgencyById($user,$id);
        $this->agency->deleteAdmin($user);
        return $this->SuccessResponse();
    }


}
