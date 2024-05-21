<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory,Prunable;
    protected $fillable = ['compare_price','offerable_type','offerable_id','expired_at','period'];

    protected  static function boot()
    {
        parent::boot();
        static::creating(function($offer){
            $duration = request('period');

            if($duration=='week'){
                $expired_at = Carbon::now()->addWeek();
            }
            else if ($duration=='month')
            {
                $expired_at = Carbon::now()->addMonth();

            }
            $offer->expired_at = $expired_at;
        });

        static::updating(function($offer){
            $duration = request('period');

            if($duration=='week'){
                $expired_at = Carbon::now()->addWeek();
            }
            else if ($duration=='month')
            {
                $expired_at = Carbon::now()->addMonth();
            }
            $offer->expired_at = $expired_at;
        });

    }

    public function offerable()
    {
        return $this->morphTo();
    }
    // php artisan model:prune --pretend

    public function prunable(): Builder
    {
        return static::where('expired_at', '<=', now()->subDay());
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


