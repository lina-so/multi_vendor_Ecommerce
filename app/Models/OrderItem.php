<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Option;
use App\Models\Product;
use App\Models\OptionValue;
use App\Models\OrderAdress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable =['order_id','product_id','product_name','price','quantity','options'];
    // protected $fillable =['order_id','product_id','price','quantity','options'];


    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => $this->product_name
        ]);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function option()
    {
        return $this->belongsTo(Option::class);
    }


    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }



}

 /* #attributes: array:6 [▼  orderItem
    "order_id" => 61
    "product_id" => 36
    "product_name" => "prod 52"
    "price" => 8500.0
    "quantity" => 1
    "options" => "{"3":"54","4":"56"}"
  ]*/


  /*
            dd($orderItem->order);
 #attributes: array:12 [▼
    "id" => 62
    "user_id" => 14
    "store_id" => 1
    "code" => "20240001"
    "payment_method" => "PayPal"
    "status" => "pending"
    "payment_status" => "pending"
    "tax" => 0.0
    "discount" => 0.0
    "total" => 20050.0
    "created_at" => "2024-03-11 13:46:50"
    "updated_at" => "2024-03-11 13:46:50"
  */
