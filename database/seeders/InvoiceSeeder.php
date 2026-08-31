<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('invoices')->insert([
            ['id' => 1, 'invoice_code' => 'INV-2026-0001', 'date' => '2026-07-27', 'due_date' => '2026-08-03', 'company_id' => 1, 'customer_id' => 1, 'user_id' => 1],
            ['id' => 2, 'invoice_code' => 'INV-2026-0002', 'date' => '2026-07-30', 'due_date' => '2026-08-30', 'company_id' => 1, 'customer_id' => 2, 'user_id' => 1],
        ]);
    }
}
