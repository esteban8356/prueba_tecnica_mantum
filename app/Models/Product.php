<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];

    public function buys()
    {
        return $this->belongsToMany(Buy::class, 'buy_product')->withPivot('amount');
    }
}
