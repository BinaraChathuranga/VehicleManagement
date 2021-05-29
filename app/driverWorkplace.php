<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driverWorkplace extends Model
{
    protected $table='driverWorkPlaces';
    protected $fillable = [
        'NIC', 'workPlace', 'workFrom', 'workTo',
    ];
}
