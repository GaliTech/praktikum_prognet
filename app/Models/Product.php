<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    //Nama tabel yang digunakan di SQL
    protected $table ='products';
    //Relasi many to many dengan tabel product category
    public function RelasiProductCategories()
    {
        return $this->belongsToMany(ProductCategories::class,'product_category_details','product_id','category_id');
    }
    //Relasi One to Many dengan tabel product image
    public function RelasiProductImages(){
        return $this->hasMany(ProductImages::class);
    }
    //Relasi One to Many dengan tabel diskon
    public function diskon(){
        return $this->hasMany(Discount::class);
    }
    use SoftDeletes;
}
