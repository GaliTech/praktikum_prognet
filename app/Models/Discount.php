<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    //hubungkan nama model dengan nama tabel di database
    protected $table = 'discounts';
    protected $guarded = [];

    //Relasi One to Many dengan tabel product
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
