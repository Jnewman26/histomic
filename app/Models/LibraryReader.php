<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryReader extends Model
{
    protected $table = 'library_reader';
    protected $keyType = 'string';

    protected $fillable = [
        'USER_ID',
        'LIBRARY_READER_ID'
    ];

    public $timestamps = false;
}
