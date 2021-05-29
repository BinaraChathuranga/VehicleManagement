<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driverDetail extends Model
{
    protected $table='driverInfo';
    protected $fillable = [
        'name', 'address', 'NIC', 'avatar','email','mobile','homeTel','otherTel','zone',
    ];

}
