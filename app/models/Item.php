<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['ref_no', 'name', 'price', 'invoice_id',])]

class Item extends Model
{
    //
}
