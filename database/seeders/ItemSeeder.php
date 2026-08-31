<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('items')->insert([
            ['id' => 1, 'ref_no' => 'REF-2026-0001', 'name' => 'Keyboard Mechanical Fantech', 'price' => 500000, 'company_id' => 1],
            ['id' => 2, 'ref_no' => 'REF-2026-0002', 'name' => 'Mouse Logitech M220', 'price' => 100000, 'company_id' => 1],
            ['id' => 3, 'ref_no' => 'REF-2026-0003', 'name' => 'Monitor LG 24 Inch', 'price' => 1850000, 'company_id' => 1],
            ['id' => 4, 'ref_no' => 'REF-2026-0004', 'name' => 'Monitor Samsung 24 Inch', 'price' => 2100000, 'company_id' => 1],
            ['id' => 5, 'ref_no' => 'REF-2026-0005', 'name' => 'Keyboard Logitech K120', 'price' => 175000, 'company_id' => 1],
            ['id' => 6, 'ref_no' => 'REF-2026-0006', 'name' => 'Mouse Logitech M331', 'price' => 325000, 'company_id' => 1],
            ['id' => 7, 'ref_no' => 'REF-2026-0007', 'name' => 'Webcam Logitech C270', 'price' => 450000, 'company_id' => 1],
            ['id' => 8, 'ref_no' => 'REF-2026-0008', 'name' => 'Headset HyperX Cloud Stinger', 'price' => 850000, 'company_id' => 1],
            ['id' => 9, 'ref_no' => 'REF-2026-0009', 'name' => 'USB Flashdisk Sandisk 64GB', 'price' => 125000, 'company_id' => 1],
            ['id' => 10, 'ref_no' => 'REF-2026-0010', 'name' => 'USB Flashdisk Sandisk 128GB', 'price' => 210000, 'company_id' => 1],
            ['id' => 11, 'ref_no' => 'REF-2026-0011', 'name' => 'SSD Kingston NV2 500GB', 'price' => 750000, 'company_id' => 1],
            ['id' => 12, 'ref_no' => 'REF-2026-0012', 'name' => 'SSD Samsung 980 500GB', 'price' => 950000, 'company_id' => 1],
            ['id' => 13, 'ref_no' => 'REF-2026-0013', 'name' => 'RAM Kingston 8GB DDR4', 'price' => 350000, 'company_id' => 1],
            ['id' => 14, 'ref_no' => 'REF-2026-0014', 'name' => 'RAM Kingston 16GB DDR4', 'price' => 650000, 'company_id' => 1],
            ['id' => 15, 'ref_no' => 'REF-2026-0015', 'name' => 'RAM Corsair 8GB DDR4', 'price' => 425000, 'company_id' => 1],
            ['id' => 16, 'ref_no' => 'REF-2026-0016', 'name' => 'RAM Corsair 16GB DDR4', 'price' => 725000, 'company_id' => 1],
            ['id' => 17, 'ref_no' => 'REF-2026-0017', 'name' => 'Power Supply 450W', 'price' => 550000, 'company_id' => 1],
            ['id' => 18, 'ref_no' => 'REF-2026-0018', 'name' => 'Power Supply 550W', 'price' => 700000, 'company_id' => 1],
            ['id' => 19, 'ref_no' => 'REF-2026-0019', 'name' => 'Power Supply 650W', 'price' => 850000, 'company_id' => 1],
            ['id' => 20, 'ref_no' => 'REF-2026-0020', 'name' => 'Casing PC ATX', 'price' => 650000, 'company_id' => 1],
            ['id' => 21, 'ref_no' => 'REF-2026-0021', 'name' => 'Casing PC Gaming RGB', 'price' => 950000, 'company_id' => 1],
            ['id' => 22, 'ref_no' => 'REF-2026-0022', 'name' => 'Cooling Fan 120mm', 'price' => 85000, 'company_id' => 1],
            ['id' => 23, 'ref_no' => 'REF-2026-0023', 'name' => 'CPU Cooler Deepcool', 'price' => 450000, 'company_id' => 1],
            ['id' => 24, 'ref_no' => 'REF-2026-0024', 'name' => 'HDMI Cable 2 Meter', 'price' => 75000, 'company_id' => 1],
            ['id' => 25, 'ref_no' => 'REF-2026-0025', 'name' => 'DisplayPort Cable 2 Meter', 'price' => 125000, 'company_id' => 1],
            ['id' => 26, 'ref_no' => 'REF-2026-0026', 'name' => 'LAN Cable Cat6 5 Meter', 'price' => 90000, 'company_id' => 1],
            ['id' => 27, 'ref_no' => 'REF-2026-0027', 'name' => 'LAN Cable Cat6 10 Meter', 'price' => 150000, 'company_id' => 1],
            ['id' => 28, 'ref_no' => 'REF-2026-0028', 'name' => 'Router TP-Link Archer C6', 'price' => 650000, 'company_id' => 1],
            ['id' => 29, 'ref_no' => 'REF-2026-0029', 'name' => 'Router TP-Link Archer AX10', 'price' => 950000, 'company_id' => 1],
            ['id' => 30, 'ref_no' => 'REF-2026-0030', 'name' => 'Switch TP-Link 8 Port', 'price' => 350000, 'company_id' => 1],
            ['id' => 31, 'ref_no' => 'REF-2026-0031', 'name' => 'Switch TP-Link 16 Port', 'price' => 750000, 'company_id' => 1],
            ['id' => 32, 'ref_no' => 'REF-2026-0032', 'name' => 'Printer Epson L3210', 'price' => 2350000, 'company_id' => 1],
            ['id' => 33, 'ref_no' => 'REF-2026-0033', 'name' => 'Printer Canon PIXMA G2020', 'price' => 2200000, 'company_id' => 1],
            ['id' => 34, 'ref_no' => 'REF-2026-0034', 'name' => 'Printer HP Ink Tank 315', 'price' => 1950000, 'company_id' => 1],
            ['id' => 35, 'ref_no' => 'REF-2026-0035', 'name' => 'Laptop Stand Aluminium', 'price' => 275000, 'company_id' => 1],
            ['id' => 36, 'ref_no' => 'REF-2026-0036', 'name' => 'Laptop Stand Adjustable', 'price' => 350000, 'company_id' => 1],
            ['id' => 37, 'ref_no' => 'REF-2026-0037', 'name' => 'Mouse Pad Gaming XL', 'price' => 175000, 'company_id' => 1],
            ['id' => 38, 'ref_no' => 'REF-2026-0038', 'name' => 'Mouse Pad Gaming XXL', 'price' => 225000, 'company_id' => 1],
            ['id' => 39, 'ref_no' => 'REF-2026-0039', 'name' => 'USB Hub 4 Port', 'price' => 150000, 'company_id' => 1],
            ['id' => 40, 'ref_no' => 'REF-2026-0040', 'name' => 'USB Hub Type C 6 Port', 'price' => 325000, 'company_id' => 1],
            ['id' => 41, 'ref_no' => 'REF-2026-0041', 'name' => 'Bluetooth Speaker JBL', 'price' => 850000, 'company_id' => 1],
            ['id' => 42, 'ref_no' => 'REF-2026-0042', 'name' => 'Bluetooth Speaker Anker', 'price' => 650000, 'company_id' => 1],
            ['id' => 43, 'ref_no' => 'REF-2026-0043', 'name' => 'Mechanical Keyboard Fantech MK872', 'price' => 750000, 'company_id' => 1],
            ['id' => 44, 'ref_no' => 'REF-2026-0044', 'name' => 'Mechanical Keyboard Royal Kludge', 'price' => 950000, 'company_id' => 1],
            ['id' => 45, 'ref_no' => 'REF-2026-0045', 'name' => 'Wireless Mouse Fantech', 'price' => 225000, 'company_id' => 1],
            ['id' => 46, 'ref_no' => 'REF-2026-0046', 'name' => 'Wireless Mouse Rexus', 'price' => 185000, 'company_id' => 1],
            ['id' => 47, 'ref_no' => 'REF-2026-0047', 'name' => 'Gaming Headset Fantech', 'price' => 550000, 'company_id' => 1],
            ['id' => 48, 'ref_no' => 'REF-2026-0048', 'name' => 'Gaming Headset Rexus', 'price' => 475000, 'company_id' => 1],
            ['id' => 49, 'ref_no' => 'REF-2026-0049', 'name' => 'Keyboard Wireless Logitech', 'price' => 450000, 'company_id' => 1],
            ['id' => 50, 'ref_no' => 'REF-2026-0050', 'name' => 'Mouse Wireless Logitech M185', 'price' => 175000, 'company_id' => 1],
        ]);
    }
}
