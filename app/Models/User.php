<?php

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'login',
        'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPassword()
    {
        return $this->password;
    }
}