<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fuelConsumption extends Model
{
    protected $table='fuelconsuption';
    protected $fillable = [
        'vehicleNo', 'amount', 'journey', 'status',
    ];
}
