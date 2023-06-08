<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comic';
    protected $primaryKey = 'COMIC_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'COMIC_ID',
        'LIBRARY_WRITER_ID',
        'COMIC_TITLE',
        'COMIC_GENRE',
        'COMIC_COVER',
        'COMIC_PRICE'
    ];

    public $timestamps = false;
}