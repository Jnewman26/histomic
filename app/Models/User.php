<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'USER_ID';
    protected $keyType = 'string';

    protected $fillable = [
        'USER_ID',
        'CART_ID',
        'LIBRARY_WRITER_ID',
        'LIBRARY_READER_ID',
        'WISHLIST_ID',
        'USER_NAME',
        'USER_EMAIL',
        'USER_PHONE',
        'USER_GENDER',
        'USER_VERIFIED_AT',
        'USER_PASSWORD',
        'USER_STATUS',
        'USER_JOIN_DATE'
    ];

    public $timestamps = false;

    public function getAuthIdentifierName()
    {
        return 'USER_ID';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->USER_PASSWORD;
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }
}
