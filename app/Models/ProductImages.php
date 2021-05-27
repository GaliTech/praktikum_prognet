<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory;
    //hubungkan nama model dengan nama tabel di database
    protected $table = 'product_images';
    use SoftDeletes;
}
