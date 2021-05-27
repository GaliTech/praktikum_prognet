<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryDetails extends Model
{
    use HasFactory;
    //hubungkan nama model dengan nama tabel di database
    protected $table = 'product_category_details';
}
