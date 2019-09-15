<?php

namespace App\Policies;

use App\Folder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any folders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return mixed
     */
    public function view(User $user, Folder $folder)
    {
        return $user->type == 'user' || $user->id == $folder->user_id;

    }

    /**
     * Determine whether the user can create folders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'user';
    }

    /**
     * Determine whether the user can update the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return mixed
     */
    public function update(User $user, Folder $folder)
    {
        return $user->id == $folder->user_id;

    }

    /**
     * Determine whether the user can delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return mixed
     */
    public function delete(User $user, Folder $folder)
    {
        return $user->id == $folder->user_id;

    }

    /**
     * Determine whether the user can restore the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return mixed
     */
    public function restore(User $user, Folder $folder)
    {
        //return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return mixed
     */
    public function forceDelete(User $user, Folder $folder)
    {
        //return $user->isAdmin();
    }

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}