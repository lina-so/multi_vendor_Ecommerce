<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


class Coupon extends Model
{
    use HasFactory,Prunable;

    protected $dates = ['starts_at', 'expires_at'];

    protected $fillable = ['code','name','max_uses','max_uses_user','type','discount_amount'
    ,'min_amount','status','starts_at','expires_at'];

    public function prunable(): Builder
    {
        return static::where('expires_at', '<=', now()->subDay())->orWhere('max_uses',0);
    }
}

