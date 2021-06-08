<?php

namespace App\Models;

use App\Models\AdminNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'username', 'password', 'name',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notifications()
    {
        return $this->morphMany(AdminNotifications::class, 'notifiable')->orderby('created_at', 'desc');
    }

    public function createNotif($data)
    {
        $notif = new AdminNotifications();
        $notif->type = 'App\Notifications\AdminNotification';
        $notif->notifiable_type = 'App\Models\User';
        $notif->notifiable_id = $this->id;
        $notif->data = $data;
        $notif->save();
    }
}
