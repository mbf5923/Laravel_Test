<?php


namespace App\Traits;


use App\Agency;
use App\User;
use Illuminate\Support\Facades\Auth;

trait AgencyModelTrait
{
    public function createAgency(array $agency)
    {
        $agency['user_id'] = Auth::id();
        $this->create($agency);
    }

    public function getAllAgency(User $user)
    {
        return $user->agency()->paginate();
    }


    public function getAgencyById(User $user,$id)
    {
        return $user->agency()->findOrFail($id);
    }

    public function updateAgency(Agency $agency, array $data)
    {

        return $agency->update($data);
    }

    public function deleteAdmin(Agency $agency)
    {
        $agency->delete();
    }

    public function getAgencyTour($id)
    {
        return $this->getAgencyById($id)->tour()->get();
    }
}
