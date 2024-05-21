<?php

namespace App\Models;

use App\Models\RoleUser;
use App\Models\RoleAbility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name','guard_name'];

    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }

    public function roleUsers()
    {
        return $this->morph(RoleUser::class, 'authorizable', 'authorizable_type','authorizable_id');

    }



}
