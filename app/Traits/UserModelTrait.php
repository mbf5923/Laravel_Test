<?php


namespace App\Traits;


use App\User;

trait UserModelTrait
{

    public function getAllAdmin()
    {
        return $this->paginate();
    }

    public function getAdminById($id)
    {
        return $this->findOrFail($id);
    }

    public function createAdmin($user = array())
    {
        $user['password'] = bcrypt($user['password']);
        $this->create($user);
    }

    public function updateAdmin(User $user, array $data)
    {
        if (isset($data['password']))
            $data['password'] = bcrypt($data['password']);
        $user->update($data);
    }

    public function deleteAdmin(User $user)
    {
        $user->delete();
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->role->name == $role;

    }
}
