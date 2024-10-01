<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customers extends Model implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'image_profile',
        'email',
        'password',
        'phone',
        'address1',
        'address2',
        'address3'
    ];

    // Implementing methods from the Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }
    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id');
    }
    public function carts()
    {
        return $this->hasMany(Carts::class, 'customer_id');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlists::class, 'customer_id');
    }
}
