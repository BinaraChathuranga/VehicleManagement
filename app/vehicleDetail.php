<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicleDetail extends Model
{
    protected $table='vehicleInfo';
    protected $fillable = [
        'zone', 'regNo', 'regDate', 'makeAndtype','chasisNo','engineNo','horsePower','image','typeOfBody', 
        'payLoad','fTyreSize','rTyreSize','batteryVoltage','batteryAmp','capacity','crankSize',
    ];
}
