<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_detail';
    protected $primaryKey = 'CART_ID';
    public $incrementing = false;

    protected $fillable = [
        'COMIC_ID',
        'CART_ID'
    ];

    public $timestamps = false;
}
