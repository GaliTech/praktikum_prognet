<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    protected $fillable = ['timeout','address',"regency","province","total","shipping_cost","sub_total","user_id","courier_id","proof_of_payment","status"];
    
    public function transaction_detail()
    {
        return $this->hasMany('App\Models\TransactionDetails');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function courier()
    {
        return $this->belongsTo('App\Models\Courier');
    }
}
