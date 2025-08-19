<?php

// app/Models/Car.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    protected $fillable = [
    'user_id','marka','modell','evjarat','ar','leiras','kep','uzemanyag',
    'km_ora','teljesitmeny','valto','szin','karosszeria','extrak'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function images()
{
    return $this->hasMany(CarImage::class);
}
public function car()
{
    return $this->belongsTo(Car::class);
}

}



