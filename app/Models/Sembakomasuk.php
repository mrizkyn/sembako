<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sembakomasuk extends Model
{

    protected $fillable = ['category_id', 'unit_id', 'name', 'date', 'exp_date', 'out_date', 'amount'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Sembakokeluar(){
        return $this->hasMany(Sembakokeluar::class);
    }
}
