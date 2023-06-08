<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $keyType = 'string';

    protected $fillable = [
        'USER_ID',
        'CART_ID'
    ];

    public $timestamps = false;
}
