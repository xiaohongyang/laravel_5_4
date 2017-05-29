<?php

namespace App;

use App\Models\Oauth_ClientsModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable; use HasApiTokens;

    public function getRouteKeyName()
    {
        return 'id';
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];


    public function isAdmin(){
        return $this->name == 'JackXiao';
    }

    public function routeNotificationForMail()
    {
        return '258082291@qq.com';
    }

    public function clients(){
        $this->hasMany(Oauth_ClientsModel::class, 'user_id');
    }

}
