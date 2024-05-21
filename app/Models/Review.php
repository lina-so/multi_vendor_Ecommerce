<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory ,FilterTrait;
    protected $fillable = ['comment','rating','user_id','product_id','status'];

    public static function booted()
    {
        static::creating(function (Review $review) {
            return DB::transaction(function () use ($review) {
                $review->user_id = Auth::user()->id;
            });
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }




}
