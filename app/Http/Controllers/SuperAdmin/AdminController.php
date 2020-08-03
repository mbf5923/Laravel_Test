<?php


namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Http\Resources\FailedResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class AdminController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createAdmin(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',

        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $this->user->createAdmin($request->only(['username', 'email', 'password']));
        return new UserResource([]);
    }

    public function getAllAdmin()
    {
        $user = $this->user->getAllAdmin();
        return new UserResourceCollection($user);
    }

    public function getAdminById($id)
    {
        $user = $this->user->getAdminById($id);
        return new UserResource($user); //return response with resource
    }


    public function updateAdmin(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'username' => [
                'string',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'string',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'string',

        ]);
        if ($validated->fails()) {
            return $this->failedValidationResponse($validated->errors());
        }
        $user = $this->user->getAdminById($id);
        $this->user->updateAdmin($user, $request->only(['username', 'email', 'password']));
        return $this->SuccessResponse();
    }

    public function deleteAdmin($id)
    {
        $user = $this->user->getAdminById($id);
        $this->user->deleteAdmin($user);
        return $this->SuccessResponse();
    }

    public function getAllAdminAgency()
    {
        $user = $this->user->getAllAdmin();
        return new UserResourceCollection($user);
    }
}
