<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_types_id','name', 'description'
        ];

    public function productstype()
    {
        return $this->belongsTo(ProductType::class, 'product_types_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
