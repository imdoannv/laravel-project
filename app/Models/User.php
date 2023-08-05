<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'role_id', 'username', 'password', 'email', 'address'];

    // Relationship with role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    use HasFactory;
}
