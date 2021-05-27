<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
    use HasFactory;
    //hubungkan nama model dengan nama tabel di database
    protected $table = 'product_categories';

    //Relasi Many to Many dengan tabel product
    public function RelasiProduk()
    {
        return $this->belongsToMany(Product::class,'product_category_details','product_id','category_id');
    }
    use SoftDeletes;
}
