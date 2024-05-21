<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model  implements HasMedia
{
    // use HasFactory , SoftDeletes,InteractsWithMedia;
    use HasFactory ,InteractsWithMedia;


    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'address',
        'city',
        'email',
        'phone',
        'industry',
        'logo',
        'social_media_links',
        'return_policy',
        'shipping_policy',
        'rating',
        'rating_count',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function booted()
    {
        static::creating(function (Store $store) {
            if (Auth::guard('vendor')->check()) {
                $store->vendor_id = Auth::guard('vendor')->id();
            }
        });
    }


}
