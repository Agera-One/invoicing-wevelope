<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'name' => 'Red Hat, inc',
                'email' => 'redhat@example.com',
                'phone' => '081234567892',
                'business_entity' => 'PT',
                'sector' => 'Open Source Software',
                'website' => null,
                'description' => 'Red Hat is an American enterprise software company that provides open-source solutions for operating systems, hybrid cloud infrastructure, container platforms, automation, virtualization, middleware, and enterprise support services',
                'country' => 'United States',
                'province' => 'North Carolina',
                'city' => 'Raleigh',
                'subdistrict' => 'Downtown Raleigh',
                'address' => '100 East Davie Street, Raleigh, NC 27601, United States',
                'logo' => null,
                'signature' => null,
            ],
        ]);
    }
}
