<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded= ["id"];
    protected $fillable = ['user_id','product_id',"qty","created_at","updated_at","status"];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
