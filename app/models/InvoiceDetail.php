<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['unit_price', 'quantity', 'amount', 'invoice_id', 'item_id'])]

class InvoiceDetail extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
