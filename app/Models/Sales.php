<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'SALES_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'SALES_ID',
        'LIBRARY_READER_ID',
        'SALES_TOTAL',
        'SALES_DATE',
        'SALES_STATUS'
    ];

    public $timestamps = false;
}
