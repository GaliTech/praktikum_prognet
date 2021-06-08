<?php

namespace App\Models;

use Database\Factories\SomeFancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    use HasFactory;
    protected $table='product_reviews';

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function response()
    {
        return $this->hasMany('App\Models\Response');
    }
}
