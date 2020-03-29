<?php

namespace App\Policies;

use App\MediumUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MediumUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any medium users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUser  $mediumUser
     * @return mixed
     */
    public function view(User $user, MediumUser $mediumUser)
    {
        //
    }

    /**
     * Determine whether the user can create medium users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->isAdmin()){
            Response::allow();
        }
        Response::deny("You are not allowed to access this resource");
    }

    /**
     * Determine whether the user can update the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUser  $mediumUser
     * @return mixed
     */
    public function update(User $user, MediumUser $mediumUser)
    {
        //
    }

    /**
     * Determine whether the user can delete the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUser  $mediumUser
     * @return mixed
     */
    public function delete(User $user, MediumUser $mediumUser)
    {
        //
    }

    /**
     * Determine whether the user can restore the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUser  $mediumUser
     * @return mixed
     */
    public function restore(User $user, MediumUser $mediumUser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUser  $mediumUser
     * @return mixed
     */
    public function forceDelete(User $user, MediumUser $mediumUser)
    {
        //
    }
}
