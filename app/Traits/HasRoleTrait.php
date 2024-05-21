<?php

namespace App\Traits;
use App\Models\Role;


trait HasRoleTrait
{
    public function HasRoles()
    {
        return $this->morphToMany(Role::class,'authorizable','role_user');
    }

    public function hasAbility($ability)
    {
        $denied =  $this->HasRoles()->whereHas('abilities',function($query) use ($ability){
            $query->where('ability',$ability)
            ->where('type','=','deny');
        })->exists();

        if($denied)
        {
            return false;
        }

        return  $this->HasRoles()->whereHas('abilities',function($query) use ($ability){
            $query->where('ability',$ability)
            ->where('type','=','allow');
        })->exists();

    }
}
