<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['payment_code', 'date', 'amount', 'invoice_id',])]

class Payment extends Model
{
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
