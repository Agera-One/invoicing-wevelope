<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('invoice_details')->insert([
            ['id' => 1, 'unit_price' => 500000, 'quantity' => 10, 'amount' => 5000000, 'invoice_id' => 1, 'item_id' => 1],
            ['id' => 2, 'unit_price' => 500000, 'quantity' => 3, 'amount' => 1500000, 'invoice_id' => 2, 'item_id' => 2],
            ['id' => 3, 'unit_price' => 500000, 'quantity' => 3, 'amount' => 1500000, 'invoice_id' => 1, 'item_id' => 4],
            ['id' => 4, 'unit_price' => 500000, 'quantity' => 15, 'amount' => 7500000, 'invoice_id' => 1, 'item_id' => 5],
        ]);
    }
}
