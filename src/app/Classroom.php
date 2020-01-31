<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Classroom extends Model
{
    use SpatialTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'rumorosita', 'frequenza_ble', 'righe', 'colonne', 'disegno', 'map_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    protected $spatialFields = [
        'disegno'
    ];

    /**
     * Get reservations of the classroom
     */
    public function reservations($data, $da_ora, $ad_ora)
    {
        $desks = $this->hasMany('App\Desk')->getResults();
        $reservations = collect([]);
        foreach($desks as $desk){
            $reservations = $reservations->merge($desk->reservations($data, $da_ora, $ad_ora));
        }
        return $reservations;
    }

    /**
     * Get schedules of the classroom
     */
    public function schedules()
    {
        return $this->hasMany('App\Schedule')->getResults();
    }

    /**
     * Get closings of the classroom
     */
    public function closings()
    {
        return $this->hasMany('App\Closing')->getResults();
    }

    /**
     * Get desks of the classroom
     */
    public function desks()
    {
        return $this->hasMany('App\Desk')->getResults();
    }
}
