<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory,FilterTrait,SoftDeletes;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function offers()
    {
        return $this->morphMany(Offer::class, 'offerable');
    }
}
