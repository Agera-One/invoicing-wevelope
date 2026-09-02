<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['customer_code', 'name', 'email', 'phone', 'address', 'company_id'])]

class Customer extends Model
{
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
