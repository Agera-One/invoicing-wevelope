<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'name',
    'email',
    'phone',
    'business_entity',
    'sector',
    'website',
    'description',
    'country',
    'province',
    'city',
    'subdistrict',
    'address',
    'logo',
    'signature',
])]

class Company extends Model
{
    public $timestamps = false;
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
