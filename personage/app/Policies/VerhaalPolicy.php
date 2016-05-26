<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Verhaal;
class VerhaalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
   public function destroy(User $user, Verhalen $verhalen)
    {
        return $user->id === $verhaal->user_id;
    }
}
