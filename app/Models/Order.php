<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderAdress;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,FilterTrait;
    protected $fillable = [
        'store_id','user_id','payment_method','status','payment_status','discount','tax','total','tracking_number'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAdress::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAdress::class)->where('type','billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAdress::class)->where('type','shipping');
    }


public static function booted()
{
    static::creating(function (Order $order) {
        // retry to generate a unique code if it already exists
        return DB::transaction(function () use ($order) {
            $order->code = self::getNextCode();
        });
    });
}

public static function getNextCode()
{
    $year = Carbon::now()->year;

    return DB::transaction(function () use ($year) {
        $maxCode = Order::whereYear('created_at', $year)->max('code');

        if ($maxCode) {
            return $maxCode + 1;
        }

        return intval($year . '0001');
    });
}


}
