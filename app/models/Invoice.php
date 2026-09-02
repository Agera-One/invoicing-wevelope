<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['invoice_code', 'date', 'due_date', 'company_id', 'customer_id', 'user_id'])]

class Invoice extends Model
{
    public function invoiceDetails()
    {
        return $this->hasOne(InvoiceDetail::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
