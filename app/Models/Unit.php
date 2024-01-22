<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $fillable = ['unit_name'];

    public function Sembakomasuk(){
        return $this->hasMany(Sembakomasuk::class);
    }
    public function Sembakokeluar(){
        return $this->hasMany(Sembakokeluar::class);
    }
}
