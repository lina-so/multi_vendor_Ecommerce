<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    // protected $fillable = ['comment','user_id','product_id'];

    // public function replies()
    // {
    //     return $this->hasMany(Comment::class,'parent_id','id')->withDefault();
    // }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
