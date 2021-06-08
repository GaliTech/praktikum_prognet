<?php

// namespace App\Models;


namespace App\Models;

use App\Models\UserNotifications;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'user';

    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createNotifUser($data)
    {
        $notif = new UserNotifications();
        $notif->type = 'App\Notifications\UserNotification';
        $notif->notifiable_type = 'App\Models\Admin';
        $notif->notifiable_id = $this->id;
        $notif->data = $data;
        $notif->save();
    }
}
