<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            ['id' => 1, 'payment_code' => 'PAY-2026-0001', 'date' => '2026-07-27', 'amount' => 800000, 'invoice_id' => 1],
            ['id' => 2, 'payment_code' => 'PAY-2026-0002', 'date' => '2026-07-27', 'amount' => 1000000, 'invoice_id' => 2],
            ['id' => 3, 'payment_code' => 'PAY-2026-0003', 'date' => '2026-08-03', 'amount' => 1000000, 'invoice_id' => 1],
            ['id' => 4, 'payment_code' => 'PAY-2026-0004', 'date' => '2026-08-14', 'amount' => 11000000, 'invoice_id' => 1],
            ['id' => 5, 'payment_code' => 'PAY-2026-0005', 'date' => '2026-08-30', 'amount' => 500000, 'invoice_id' => 2],
        ]);
    }
}
