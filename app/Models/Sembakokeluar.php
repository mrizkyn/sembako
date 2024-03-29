<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sembakokeluar extends Model
{
    protected $fillable = ['category_id', 'amount'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sembakomasuk()
    {
        return $this->belongsTo(Sembakomasuk::class);
    }
}
