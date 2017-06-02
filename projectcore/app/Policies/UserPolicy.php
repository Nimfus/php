<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userModel
     * @return mixed
     */
    public function view(User $user, User $userModel)
    {
        //
    }

    /**
     * @param User $user
     */
    public function create(User $user)
    {
        //
    }

    /**
     * @param User $user
     * @param int $id
     *
     * @return bool
     */
    public function update(User $user, int $id)
    {
        return $user->isAdmin() || $user->id === $id;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->isAdmin();
    }
}
