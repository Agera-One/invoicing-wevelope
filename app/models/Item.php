<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['ref_no', 'name', 'price', 'invoice_id',])]

class Item extends Model
{
    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('ref_no', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        });
    }
}
