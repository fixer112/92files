<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->type == 'user';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function viewBlade(User $user, User $model)
    {

        return ($model->role == 'user' && $user->type == 'user') || ($model->id == $user->id && $model->role == 'user') || ($user->isSuperAdmin() && $model->role == 'user');
    }

    public function view(User $user, User $model)
    {
        return $model->role == 'user' && $user->type == 'user';

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type == 'user';
    }

    public function manageAdmin(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return ($model->role == 'user' && $user->type == 'user') || ($model->id == $user->id); //|| $user->id == $model->id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //return $model->role == 'user' && $user->type == 'user';
        return false;
        //return !$model->isSuperAdmin() $user->type == 'user';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return $model->role == 'user' && $user->type == 'user';

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //return $model->role == 'user' && $user->type == 'user';

    }

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}