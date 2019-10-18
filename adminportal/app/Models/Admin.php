<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {

    use Notifiable;
    
    protected $primaryKey = 'admin_id';

    /**
     * 不可批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        return $this->attributes['admin_level'] == 1;
    }
}
