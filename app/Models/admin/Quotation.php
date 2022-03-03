<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function producto(){
        return $this->belongsToMany(Product::class, 'orders_products')
        ->withTimestamps()
        ->withPivot('date','number');
    }
}
