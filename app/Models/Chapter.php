<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';
    protected $primaryKey = 'CHAPTER_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'CHAPTER_ID',
        'COMIC_ID',
        'CHAPTER_NAME',
        'CHAPTER_DESC',
        'CHAPTER_RELEASE'
    ];
}