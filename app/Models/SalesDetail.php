<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    protected $table = 'sales_detail';
    protected $primaryKey = 'SALES_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'COMIC_ID',
        'SALES_ID',
        'TESTIMONY_ID',
        'TESTIMONY_DESC',
        'STAR_TESTIMONY',
    ];

    public $timestamps = false;
}
