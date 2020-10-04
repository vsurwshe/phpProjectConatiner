<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'product_name', 'product_qty', 'product_unit_price','product_total_price', 'user_id'
    ];

    public function user(){
       return $this->belongsTo('App\Models\User');
    }
}
