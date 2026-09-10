<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['customer_code', 'name', 'email', 'phone', 'address', 'company_id'])]

class Customer extends Model
{
    public $timestamps = false;
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
