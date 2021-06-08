<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotifications extends Model
{
    use HasFactory;
    protected $table = 'admin_notifications';
    protected $guarded = [];
}
