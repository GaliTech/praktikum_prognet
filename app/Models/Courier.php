<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;
    //hubungkan nama model dengan nama tabel di database
    protected $table = 'couriers';
}
