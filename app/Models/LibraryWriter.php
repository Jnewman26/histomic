<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryWriter extends Model
{
    protected $table = 'library_writer';
    protected $keyType = 'string';

    protected $fillable = [
        'USER_ID',
        'LIBRARY_WRITER_ID'
    ];

    public $timestamps = false;
}
