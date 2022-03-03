<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productfamily()
    {
        return $this->belongsTo(ProductFamily::class, 'product_families_id');
    }
}
