<?php

namespace App\Policies;

use App\MediumUsers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MediumUsersPolicy
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
        return ($user->is_admin);
    }

    /**
     * Determine whether the user can view the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUsers  $mediumUser
     * @return mixed
     */
    public function view(User $user, MediumUsers $mediumUser)
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
        //
    }

    /**
     * Determine whether the user can update the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUsers  $mediumUser
     * @return mixed
     */
    public function update(User $user, MediumUsers $mediumUser)
    {
        return ($user->id === $mediumUser->user_id);
    }

    /**
     * Determine whether the user can delete the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUsers  $mediumUser
     * @return mixed
     */
    public function delete(User $user, MediumUsers $mediumUser)
    {
        return (($user->id === $mediumUser->user_id) || $user->is_admin);
        
    }

    /**
     * Determine whether the user can restore the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUsers  $mediumUser
     * @return mixed
     */
    public function restore(User $user, MediumUsers $mediumUser)
    {
        return ($user->is_admin);
        
    }

    /**
     * Determine whether the user can permanently delete the medium user.
     *
     * @param  \App\User  $user
     * @param  \App\MediumUsers  $mediumUser
     * @return mixed
     */
    public function forceDelete(User $user, MediumUsers $mediumUser)
    {
        return ($user->is_admin);
        
    }
}
