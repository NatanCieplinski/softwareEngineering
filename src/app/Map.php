<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * Get classrooms of the map
     */
    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }
}
