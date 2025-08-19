<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['username','email','password','bio','active'];
    protected $hidden = ['password'];
    public function cars() {
        return $this->hasMany(Car::class);
    }
}

