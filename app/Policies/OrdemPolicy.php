<?php

namespace App\Policies;

use App\Models\Ordem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdemPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Ordem $oss){

        if($user->id == $oss->user_id){
            return true;
        }else{
            return false;
        }
        
    }
}
