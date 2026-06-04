<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin ISP',
            'email'    => 'admin@isp.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'NOC Operator',
            'email'    => 'noc@isp.com',
            'password' => bcrypt('password'),
            'role'     => 'operator',
        ]);

        $suppliers = [
            ['name' => 'PT Fiberhome Indonesia', 'contact_person' => 'Rudi', 'phone' => '021-1234567', 'email' => 'rudi@fiberhome.id', 'address' => 'Jakarta'],
            ['name' => 'PT Mikrotik Indonesia', 'contact_person' => 'Sari', 'phone' => '021-7654321', 'email' => 'sari@mikrotik.co.id', 'address' => 'Tangerang'],
            ['name' => 'PT Telkom Akses', 'contact_person' => 'Bambang', 'phone' => '021-5551234', 'email' => 'bambang@telkomakses.co.id', 'address' => 'Bandung'],
            ['name' => 'CV Sinar Jaya Fiber', 'contact_person' => 'Dewi', 'phone' => '0251-123456', 'email' => 'dewi@sinarjaya.com', 'address' => 'Bogor'],
            ['name' => 'UD Karya Mandiri', 'contact_person' => 'Agus', 'phone' => '0274-987654', 'email' => 'agus@karyamandiri.com', 'address' => 'Yogyakarta'],
        ];

        foreach ($suppliers as $s) {
            Supplier::create($s);
        }

        $categories = [
            ['name' => 'Router & Core Network', 'slug' => 'router-core-network'],
            ['name' => 'Switch', 'slug' => 'switch'],
            ['name' => 'GPON OLT', 'slug' => 'gpon-olt'],
            ['name' => 'GPON ONT', 'slug' => 'gpon-ont'],
            ['name' => 'SFP GPON', 'slug' => 'sfp-gpon'],
            ['name' => 'Wireless Equipment', 'slug' => 'wireless-equipment'],
            ['name' => 'Server & Monitoring', 'slug' => 'server-monitoring'],
            ['name' => 'Kabel Fiber Optik', 'slug' => 'kabel-fiber-optik'],
            ['name' => 'Patch Cord', 'slug' => 'patch-cord'],
            ['name' => 'Pigtail', 'slug' => 'pigtail'],
            ['name' => 'Adapter / Coupler', 'slug' => 'adapter-coupler'],
            ['name' => 'Splitter PLC', 'slug' => 'splitter-plc'],
            ['name' => 'ODP', 'slug' => 'odp'],
            ['name' => 'ODC', 'slug' => 'odc'],
            ['name' => 'FAT / FTB', 'slug' => 'fat-ftb'],
            ['name' => 'Joint Closure', 'slug' => 'joint-closure'],
            ['name' => 'OTB', 'slug' => 'otb'],
            ['name' => 'Kabel Instalasi', 'slug' => 'kabel-instalasi'],
            ['name' => 'Konektor', 'slug' => 'konektor'],
            ['name' => 'Aksesoris Instalasi', 'slug' => 'aksesoris-instalasi'],
            ['name' => 'Grounding', 'slug' => 'grounding'],
            ['name' => 'SFP Ethernet', 'slug' => 'sfp-ethernet'],
            ['name' => 'BiDi SFP', 'slug' => 'bidi-sfp'],
            ['name' => 'DAC & AOC', 'slug' => 'dac-aoc'],
            ['name' => 'Tools Fiber Optik', 'slug' => 'tools-fiber-optik'],
            ['name' => 'Tools LAN', 'slug' => 'tools-lan'],
            ['name' => 'Tools & Safety Umum', 'slug' => 'tools-safety-umum'],
            ['name' => 'Sparepart Darurat', 'slug' => 'sparepart-darurat'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $items = [
            ['slug' => 'router-core-network', 'items' => [
                ['name' => 'MikroTik CCR2004-1G-12S+2XS', 'serial' => 'CCR2004-001', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Rak NOC', 'mac' => '4C:5E:0C:AA:00:01'],
                ['name' => 'MikroTik CCR2116-12G-4S+', 'serial' => 'CCR2116-002', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC', 'mac' => '4C:5E:0C:BB:00:02'],
                ['name' => 'MikroTik RB5009UG+S+', 'serial' => 'RB5009-003', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '4C:5E:0C:CC:00:03'],
                ['name' => 'MikroTik RB750Gr3', 'serial' => 'RB750-004', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '4C:5E:0C:DD:00:04'],
            ]],
            ['slug' => 'switch', 'items' => [
                ['name' => 'Switch Layer 2', 'serial' => 'SW-L2-005', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Switch Layer 3', 'serial' => 'SW-L3-006', 'stock' => 6, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Access Switch 24 Port', 'serial' => 'SW-24P-007', 'stock' => 12, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Access Switch 48 Port', 'serial' => 'SW-48P-008', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'gpon-olt', 'items' => [
                ['name' => 'OLT GPON 4 Port PON', 'serial' => 'OLT-4P-009', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'OLT GPON 8 Port PON', 'serial' => 'OLT-8P-010', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'OLT GPON 16 Port PON', 'serial' => 'OLT-16P-011', 'stock' => 1, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
            ]],
            ['slug' => 'gpon-ont', 'items' => [
                ['name' => 'ONT 1 Port', 'serial' => 'ONT-1P-012', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:00:00:12'],
                ['name' => 'ONT 2 Port', 'serial' => 'ONT-2P-013', 'stock' => 150, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:00:00:13'],
                ['name' => 'ONT 4 Port', 'serial' => 'ONT-4P-014', 'stock' => 80, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:00:00:14'],
                ['name' => 'ONT WiFi Dual Band', 'serial' => 'ONT-WF-015', 'stock' => 120, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:00:00:15'],
            ]],
            ['slug' => 'sfp-gpon', 'items' => [
                ['name' => 'SFP GPON Class B+', 'serial' => 'SFP-GPON-B-016', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP GPON Class C+', 'serial' => 'SFP-GPON-C-017', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'wireless-equipment', 'items' => [
                ['name' => 'Access Point Indoor', 'serial' => 'AP-IN-018', 'stock' => 25, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '74:83:C2:AA:00:18'],
                ['name' => 'Access Point Outdoor', 'serial' => 'AP-OUT-019', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '74:83:C2:BB:00:19'],
                ['name' => 'Wireless Backhaul', 'serial' => 'WBH-020', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '74:83:C2:CC:00:20'],
                ['name' => 'Radio Point to Point', 'serial' => 'RADIO-PTP-021', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '74:83:C2:DD:00:21'],
                ['name' => 'Radio Point to Multipoint', 'serial' => 'RADIO-PTMP-022', 'stock' => 6, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => '74:83:C2:EE:00:22'],
            ]],
            ['slug' => 'server-monitoring', 'items' => [
                ['name' => 'Server Billing', 'serial' => 'SRV-BILL-023', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Server Radius', 'serial' => 'SRV-RAD-024', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Server Monitoring Zabbix', 'serial' => 'SRV-ZBX-025', 'stock' => 1, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Server LibreNMS', 'serial' => 'SRV-LMS-026', 'stock' => 1, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'NAS Storage', 'serial' => 'NAS-027', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'UPS Rackmount', 'serial' => 'UPS-028', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
            ]],
            ['slug' => 'kabel-fiber-optik', 'items' => [
                ['name' => 'Kabel FO 1 Core', 'serial' => 'FO-1C-029', 'stock' => 500, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO 2 Core', 'serial' => 'FO-2C-030', 'stock' => 400, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO 4 Core', 'serial' => 'FO-4C-031', 'stock' => 300, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO 12 Core', 'serial' => 'FO-12C-032', 'stock' => 200, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO 24 Core', 'serial' => 'FO-24C-033', 'stock' => 150, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO 48 Core', 'serial' => 'FO-48C-034', 'stock' => 100, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO ADSS', 'serial' => 'FO-ADSS-035', 'stock' => 200, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel FO Dropcore Flat', 'serial' => 'FO-DCF-036', 'stock' => 300, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'patch-cord', 'items' => [
                ['name' => 'Patch Cord SC/UPC - SC/UPC', 'serial' => 'PC-SCUP-SCUP-037', 'stock' => 150, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord SC/APC - SC/APC', 'serial' => 'PC-SCAP-SCAP-038', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord SC/APC - SC/UPC', 'serial' => 'PC-SCAP-SCUP-039', 'stock' => 50, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord LC/UPC - LC/UPC', 'serial' => 'PC-LCUP-LCUP-040', 'stock' => 80, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord LC/APC - LC/APC', 'serial' => 'PC-LCAP-LCAP-041', 'stock' => 60, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord LC - SC', 'serial' => 'PC-LC-SC-042', 'stock' => 40, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord Duplex LC-LC', 'serial' => 'PC-DUP-LC-043', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'pigtail', 'items' => [
                ['name' => 'Pigtail SC/APC', 'serial' => 'PT-SCAP-044', 'stock' => 300, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Pigtail SC/UPC', 'serial' => 'PT-SCUP-045', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Pigtail LC/APC', 'serial' => 'PT-LCAP-046', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Pigtail LC/UPC', 'serial' => 'PT-LCUP-047', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'adapter-coupler', 'items' => [
                ['name' => 'Adapter SC/APC', 'serial' => 'ADP-SCAP-048', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Adapter SC/UPC', 'serial' => 'ADP-SCUP-049', 'stock' => 150, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Adapter LC/UPC', 'serial' => 'ADP-LCUP-050', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Adapter LC/APC', 'serial' => 'ADP-LCAP-051', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'splitter-plc', 'items' => [
                ['name' => 'Splitter PLC 1:2', 'serial' => 'SPL-1-2-052', 'stock' => 50, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter PLC 1:4', 'serial' => 'SPL-1-4-053', 'stock' => 40, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter PLC 1:8', 'serial' => 'SPL-1-8-054', 'stock' => 60, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter PLC 1:16', 'serial' => 'SPL-1-16-055', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter PLC 1:32', 'serial' => 'SPL-1-32-056', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter PLC 1:64', 'serial' => 'SPL-1-64-057', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'odp', 'items' => [
                ['name' => 'ODP 8 Core', 'serial' => 'ODP-8C-058', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'ODP 16 Core', 'serial' => 'ODP-16C-059', 'stock' => 12, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'ODP 24 Core', 'serial' => 'ODP-24C-060', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'ODP 48 Core', 'serial' => 'ODP-48C-061', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'odc', 'items' => [
                ['name' => 'ODC 96 Core', 'serial' => 'ODC-96C-062', 'stock' => 4, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'ODC 144 Core', 'serial' => 'ODC-144C-063', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'ODC 288 Core', 'serial' => 'ODC-288C-064', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'fat-ftb', 'items' => [
                ['name' => 'FAT 8 Port', 'serial' => 'FAT-8P-065', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'FAT 16 Port', 'serial' => 'FAT-16P-066', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'FAT 24 Port', 'serial' => 'FAT-24P-067', 'stock' => 6, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'joint-closure', 'items' => [
                ['name' => 'Joint Closure 24 Core', 'serial' => 'JC-24C-068', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Joint Closure 48 Core', 'serial' => 'JC-48C-069', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Joint Closure 96 Core', 'serial' => 'JC-96C-070', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'otb', 'items' => [
                ['name' => 'OTB 4 Port', 'serial' => 'OTB-4P-071', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'OTB 8 Port', 'serial' => 'OTB-8P-072', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'OTB 12 Port', 'serial' => 'OTB-12P-073', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'OTB 24 Port', 'serial' => 'OTB-24P-074', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'kabel-instalasi', 'items' => [
                ['name' => 'Kabel UTP Cat5e', 'serial' => 'UTP-C5E-075', 'stock' => 30, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel UTP Cat6', 'serial' => 'UTP-C6-076', 'stock' => 20, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel Dropcore 1 Core', 'serial' => 'DC-1C-077', 'stock' => 50, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel Dropcore 2 Core', 'serial' => 'DC-2C-078', 'stock' => 40, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'konektor', 'items' => [
                ['name' => 'RJ45 Cat5e', 'serial' => 'RJ45-C5E-079', 'stock' => 500, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'RJ45 Cat6', 'serial' => 'RJ45-C6-080', 'stock' => 300, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fast Connector SC/APC', 'serial' => 'FC-SCAP-081', 'stock' => 400, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fast Connector SC/UPC', 'serial' => 'FC-SCUP-082', 'stock' => 300, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'aksesoris-instalasi', 'items' => [
                ['name' => 'Clamp Drop Wire', 'serial' => 'CLMP-DW-083', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Hook Tiang', 'serial' => 'HOOK-084', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Strap Stainless', 'serial' => 'STRAP-SS-085', 'stock' => 300, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Buckle Stainless', 'serial' => 'BUCKLE-SS-086', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Cable Tie', 'serial' => 'CTIE-087', 'stock' => 500, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Spiral Wrap', 'serial' => 'SPIRAL-088', 'stock' => 50, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
                ['name' => 'Isolasi Listrik', 'serial' => 'ISOLASI-089', 'stock' => 60, 'unit' => 'roll', 'loc' => 'Gudang Utama'],
                ['name' => 'Duct Kabel', 'serial' => 'DUCT-090', 'stock' => 40, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'grounding', 'items' => [
                ['name' => 'Ground Rod', 'serial' => 'GRD-ROD-091', 'stock' => 25, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Kabel Grounding', 'serial' => 'GRD-CBL-092', 'stock' => 100, 'unit' => 'meter', 'loc' => 'Gudang Utama'],
                ['name' => 'Ground Clamp', 'serial' => 'GRD-CLMP-093', 'stock' => 50, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'sfp-ethernet', 'items' => [
                ['name' => 'SFP 1G Single Mode 10KM', 'serial' => 'SFP-1G-10KM-094', 'stock' => 80, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP 1G Single Mode 20KM', 'serial' => 'SFP-1G-20KM-095', 'stock' => 50, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP 1G Single Mode 40KM', 'serial' => 'SFP-1G-40KM-096', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP+ 10G 10KM', 'serial' => 'SFP-10G-10KM-097', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP+ 10G 20KM', 'serial' => 'SFP-10G-20KM-098', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'bidi-sfp', 'items' => [
                ['name' => 'TX1310/RX1550 20KM', 'serial' => 'BIDI-1310-099', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'TX1550/RX1310 20KM', 'serial' => 'BIDI-1550-100', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'TX1270/RX1330 20KM', 'serial' => 'BIDI-1270-101', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'TX1330/RX1270 20KM', 'serial' => 'BIDI-1330-102', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'dac-aoc', 'items' => [
                ['name' => 'DAC 1M', 'serial' => 'DAC-1M-103', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'DAC 3M', 'serial' => 'DAC-3M-104', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'DAC 5M', 'serial' => 'DAC-5M-105', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'AOC 10M', 'serial' => 'AOC-10M-106', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'tools-fiber-optik', 'items' => [
                ['name' => 'Fusion Splicer', 'serial' => 'TOOL-FS-107', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fiber Cleaver', 'serial' => 'TOOL-FC-108', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Optical Power Meter', 'serial' => 'TOOL-OPM-109', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Visual Fault Locator (VFL)', 'serial' => 'TOOL-VFL-110', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'OTDR', 'serial' => 'TOOL-OTDR-111', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fiber Stripper', 'serial' => 'TOOL-FSTR-112', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fiber Cutter', 'serial' => 'TOOL-FCUT-113', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'tools-lan', 'items' => [
                ['name' => 'Crimping Tool', 'serial' => 'TOOL-CRIMP-114', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'LAN Tester', 'serial' => 'TOOL-LANT-115', 'stock' => 8, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Punch Down Tool', 'serial' => 'TOOL-PD-116', 'stock' => 6, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'tools-safety-umum', 'items' => [
                ['name' => 'Tang Kombinasi', 'serial' => 'TOOL-TANG-117', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Obeng Set', 'serial' => 'TOOL-OBENG-118', 'stock' => 10, 'unit' => 'set', 'loc' => 'Gudang Utama'],
                ['name' => 'Bor Listrik', 'serial' => 'TOOL-BOR-119', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Tangga Fiber', 'serial' => 'SAFE-TANGGA-120', 'stock' => 4, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Safety Belt', 'serial' => 'SAFE-BELT-121', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Helm Safety', 'serial' => 'SAFE-HELM-122', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Rompi Safety', 'serial' => 'SAFE-ROMPI-123', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
            ['slug' => 'sparepart-darurat', 'items' => [
                ['name' => 'ONT Cadangan 1 Port', 'serial' => 'SPR-ONT-1P-124', 'stock' => 30, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:FF:00:24'],
                ['name' => 'ONT Cadangan WiFi', 'serial' => 'SPR-ONT-WF-125', 'stock' => 20, 'unit' => 'pcs', 'loc' => 'Gudang Utama', 'mac' => 'A4:77:33:FF:00:25'],
                ['name' => 'Board GPON Cadangan', 'serial' => 'SPR-OLT-BOARD-126', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Fan OLT Cadangan', 'serial' => 'SPR-OLT-FAN-127', 'stock' => 5, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Power Supply OLT Cadangan', 'serial' => 'SPR-OLT-PSU-128', 'stock' => 3, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Router Cadangan', 'serial' => 'SPR-RTR-129', 'stock' => 2, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Power Adapter Cadangan', 'serial' => 'SPR-PSU-130', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'SFP Cadangan', 'serial' => 'SPR-SFP-131', 'stock' => 25, 'unit' => 'pcs', 'loc' => 'Rak NOC'],
                ['name' => 'Patch Cord SC/APC 1M', 'serial' => 'SPR-PC-1M-132', 'stock' => 50, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Patch Cord SC/APC 3M', 'serial' => 'SPR-PC-3M-133', 'stock' => 40, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Pigtail SC/APC', 'serial' => 'SPR-PT-134', 'stock' => 100, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Fast Connector SC/APC', 'serial' => 'SPR-FC-135', 'stock' => 200, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter 1:8', 'serial' => 'SPR-SPL-1-8-136', 'stock' => 15, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
                ['name' => 'Splitter 1:16', 'serial' => 'SPR-SPL-1-16-137', 'stock' => 10, 'unit' => 'pcs', 'loc' => 'Gudang Utama'],
            ]],
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $categoryMap[$cat['slug']] = Category::where('slug', $cat['slug'])->first()->id;
        }

        $supplierIds = Supplier::pluck('id')->toArray();

        foreach ($items as $group) {
            $catId = $categoryMap[$group['slug']];
            foreach ($group['items'] as $item) {
                Item::create([
                    'category_id'    => $catId,
                    'name'           => $item['name'],
                    'mac_address'    => $item['mac'] ?? null,
                    'serial_number'  => $item['serial'],
                    'stock_quantity' => $item['stock'],
                    'unit'           => $item['unit'],
                    'location'       => $item['loc'],
                    'supplier_id'    => $supplierIds[array_rand($supplierIds)],
                ]);
            }
        }

        $itemsMap = [];
        foreach (Item::all() as $item) {
            $itemsMap[$item->serial_number] = $item->id;
        }

        Transaction::create([
            'item_id' => $itemsMap['ONT-1P-012'], 'transaction_type' => 'in', 'quantity' => 50,
            'technician_name' => 'Andi', 'purpose' => 'Restock ONT 1 Port untuk stok gudang',
            'transaction_date' => now()->subDays(1),
        ]);
        Transaction::create([
            'item_id' => $itemsMap['DC-1C-077'], 'transaction_type' => 'out', 'quantity' => 5,
            'technician_name' => 'Bambang', 'purpose' => 'Instalasi baru pelanggan cluster Cilegon',
            'transaction_date' => now()->subDays(2),
        ]);
        Transaction::create([
            'item_id' => $itemsMap['SFP-GPON-B-016'], 'transaction_type' => 'in', 'quantity' => 100,
            'technician_name' => 'Citra', 'purpose' => 'Restock SFP GPON Class B+ untuk project FTTH',
            'transaction_date' => now()->subDays(3),
        ]);
        Transaction::create([
            'item_id' => $itemsMap['CCR2004-001'], 'transaction_type' => 'out', 'quantity' => 1,
            'technician_name' => 'Doni', 'purpose' => 'Deploy router core ke Site POP BSD',
            'transaction_date' => now()->subDays(4),
        ]);
        Transaction::create([
            'item_id' => $itemsMap['AP-IN-018'], 'transaction_type' => 'out', 'quantity' => 5,
            'technician_name' => 'Eka', 'purpose' => 'Instalasi WiFi coverage area cluster',
            'transaction_date' => now()->subDays(5),
        ]);
        Transaction::create([
            'item_id' => $itemsMap['SPL-1-8-054'], 'transaction_type' => 'out', 'quantity' => 10,
            'technician_name' => 'Fajar', 'purpose' => 'Splitting ODP untuk 10 rumah baru',
            'transaction_date' => now()->subDays(6),
        ]);

        $countItems = Item::count();
        $countSuppliers = Supplier::count();
        $this->command->info("Seeder berhasil: 2 user, {$countSuppliers} supplier, " . count($categories) . " kategori, {$countItems} item, 6 transaksi.");
    }
}
