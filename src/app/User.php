<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password', 'username', 'is_bannato'
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
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get reservations of the user
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation')->getResults();
    }

    /**
     * Get schedules of the user
     */
    public function schedules()
    {
        return $this->hasMany('App\Schedule')->getResults();
    }

    /**
     * Get reports of the user
     */
    public function reports()
    {
        return $this->hasMany('App\Report', 'user_id')->getResults();
    }

    /**
     * Get user role
     */
    public function role(){
        switch($this->tipo_utente){
            case 1: return "professor";
            case 2: return "supervisor";
            case 3: return "admin";
            default: return "student";
        }
    }
}
