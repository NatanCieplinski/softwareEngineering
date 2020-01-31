<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Desk extends Model
{
    use SpatialTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orientamento', 'x_pos', 'y_pos', 'classroom_id', 'desktype_id'
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
        'x_pos',
        'y_pos'
    ];

    /**
     * Get reservations of desk
     */
    public function reservations($data, $da_ora, $ad_ora)
    {
        return $this->hasMany('App\Reservation')
            ->where('data', $data)
            ->where('da_ora', '>=', $da_ora)
            ->where('ad_ora', '<=', $ad_ora)
            ->getResults();
    }
}
