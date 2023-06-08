<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'ADMIN_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'ADMIN_ID',
        'ADMIN_NAME',
        'ADMIN_PASSWORD',
        'ADMIN_DATE_CREATE',
    ];
}
