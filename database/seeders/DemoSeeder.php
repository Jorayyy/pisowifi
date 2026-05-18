<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Franchise;
use App\Models\Device;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $franchise = Franchise::create([
            'name' => 'Manila North Branch',
            'slug' => 'manila-north',
            'owner_id' => $user->id,
        ]);

        $device = Device::create([
            'franchise_id' => $franchise->id,
            'serial_number' => 'PISO-001',
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Hotspot Machine 1',
            'status' => 'online',
            'last_heartbeat' => now(),
        ]);

        Voucher::create([
            'franchise_id' => $franchise->id,
            'code' => 'PISO1HR',
            'type' => 'time',
            'value' => 60,
            'price' => 5.00,
        ]);

        Voucher::create([
            'franchise_id' => $franchise->id,
            'code' => 'PISO5HR',
            'type' => 'time',
            'value' => 300,
            'price' => 20.00,
        ]);
    }
}
