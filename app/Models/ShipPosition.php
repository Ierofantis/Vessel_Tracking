<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ShipPosition extends Eloquent
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    

    /**
     * The collection associated with the model.
     *
     * @var string
     */
    protected $collection = 'vessel_collection';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $dates = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'mmsi',
        'status',
        'stationId',
        'speed',
        'lon',
        'lat',
        'course',
        'heading',
        'rot',
        'timestamp'
    ];
    protected $primaryKey = '_id';
}
