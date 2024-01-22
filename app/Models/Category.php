<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name'];

    public function Sembakomasuk(){
        return $this->hasMany(Sembakomasuk::class);
    }
    public function Sembakokeluar(){
        return $this->hasMany(Sembakokeluar::class);
    }
}
