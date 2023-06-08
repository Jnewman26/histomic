<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistDetail extends Model
{
    protected $table = 'wishlist_detail';
    protected $primaryKey = 'WISHLIST_ID';
    public $incrementing = false;

    protected $fillable = [
        'COMIC_ID',
        'WISHLIST_ID'
    ];

    public $timestamps = false;
}