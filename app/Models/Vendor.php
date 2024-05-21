<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Store;
use App\Models\RoleUser;
use App\Traits\HasRoleTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    // images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable');
    }

    // roles

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function roleUsers()
    {
        return $this->morphOne(RoleUser::class, 'authorizable', 'authorizable_type','authorizable_id');
    }
}
