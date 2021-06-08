<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $table='response';

    public function product_review()
    {
        return $this->belongsTo('App\Models\ProductReviews', 'review_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
