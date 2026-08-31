<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['id' => 1, 'customer_code' => 'CUST-2026-0001', 'name' => 'Budi Santoso', 'email' => 'budi.santoso@example.com', 'phone' => '81234567803', 'address' => 'Jl. Kenanga No. 8, Surabaya', 'company_id' => 1],
            ['id' => 2, 'customer_code' => 'CUST-2026-0002', 'name' => 'jesko', 'email' => 'jesko@example.com', 'phone' => '08127145725435', 'address' => 'jalan', 'company_id' => 1],
            ['id' => 3, 'customer_code' => 'CUST-2026-0003', 'name' => 'hanif', 'email' => 'hanif@example.com', 'phone' => '0813457785433', 'address' => 'jalan jalan jalan', 'company_id' => 1],
            ['id' => 4, 'customer_code' => 'CUST-2026-0004', 'name' => 'QQQQQQQQQQQQQQQ', 'email' => 'dzaki@example.com', 'phone' => '0346578543', 'address' => 'xetcfygbi', 'company_id' => 1],
            ['id' => 5, 'customer_code' => 'CUST-2026-0005', 'name' => 'hartono', 'email' => 'aiocbi@adiuvb', 'phone' => '34567876543', 'address' => 'esdrtfvyb', 'company_id' => 1],
            ['id' => 6, 'customer_code' => 'CUST-2026-0006', 'name' => 'Andi Pratama', 'email' => 'andi.pratama@example.com', 'phone' => '81234567801', 'address' => 'Jl. Melati No. 12, Bandung', 'company_id' => 1],
            ['id' => 7, 'customer_code' => 'CUST-2026-0007', 'name' => 'Siti Rahmawati', 'email' => 'siti.rahmawati@example.com', 'phone' => '81234567802', 'address' => 'Jl. Mawar No. 25, Jakarta', 'company_id' => 1],
            ['id' => 8, 'customer_code' => 'CUST-2026-0008', 'name' => 'Rina Wulandari', 'email' => 'rina.wulandari@example.com', 'phone' => '81234567804', 'address' => 'Jl. Anggrek No. 17, Yogyakarta', 'company_id' => 1],
            ['id' => 9, 'customer_code' => 'CUST-2026-0009', 'name' => 'Dimas Saputra', 'email' => 'dimas.saputra@example.com', 'phone' => '81234567805', 'address' => 'Jl. Cempaka No. 31, Semarang', 'company_id' => 1],
        ]);
    }
}
