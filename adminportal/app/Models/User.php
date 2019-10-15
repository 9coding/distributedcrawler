<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use Notifiable;
    
    protected $primaryKey = 'user_id';

    /**
     * 不可批量赋值的属性
     *
     * @var array
     */
    protected $guarded = [
        'user_point','user_money','user_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password', 'user_privatekey',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    protected $appends = ['is_admin'];

    public function getRouteKeyName() {
        return $this->primaryKey;
    }

    public function getIsAdminAttribute() {
        return $this->attributes['user_role'] == 1;
    }
}
