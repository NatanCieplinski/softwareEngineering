<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desktype extends Model
{
    /**
     * Get reservations of the user
     */
    public function desks()
    {
        return $this->hasMany('App\Desk');
    }
}
