<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Offer;
use App\Models\Store;
use App\Models\Option;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\OptionValue;
use App\Traits\FilterTrait;
use Spatie\MediaLibrary\HasMedia;
use App\Models\ProductOptionValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Product extends Model  implements HasMedia
{
    use HasFactory ,FilterTrait , SoftDeletes,InteractsWithMedia,Commentable;
    protected $fillable = ['brand_id','vendor_id','category_id','store_id','name','quantity',
    'slug','description','price','compare_price','status','featured','code','sales'];


    // product code generate
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            return DB::transaction(function () use ($product) {
                $code = mt_rand(1000000000, 9999999999);
                $product->code = $code;
            });

        });
    }

    // brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    // option
    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_option_values')->withPivot('option_value_id');
    }

    // optionValues
    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class, 'product_option_values')->withPivot('option_id');
    }

    // images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable');
    }

    // subCategory
    public function subCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function offer()
    {
        return $this->morphOne(Offer::class, 'offerable');
    }

    public function productOptionValues()
    {
        return $this->hasMany(ProductOptionValue::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


}
