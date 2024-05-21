<?php

namespace App\Models;

use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $fillable = ['authorizable_id','authorizable_type','role_id'];

    public function authorizable()
    {
        return $this->morphTo();
    }
    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
