<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->type == 'user';

    }

    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        return $user->id == $file->user_id;
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type == 'user';

    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        return ($user->id == $file->user_id || $user->type == 'user') && $file->user->active;

    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        return $user->type == 'user';

    }

    /**
     * Determine whether the user can restore the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function restore(User $user, File $file)
    {
        return $user->type == 'user';

    }

    /**
     * Determine whether the user can permanently delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function forceDelete(User $user, File $file)
    {
        return $user->role == 'user';

    }

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin() || $user->type == 'user') {
            return true;
        }
    }
}