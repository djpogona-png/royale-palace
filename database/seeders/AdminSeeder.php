<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Sede;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    public function run(): void {
        $ss = Sede::where('slug', 'san-salvador')->first();
        $sa = Sede::where('slug', 'santa-ana')->first();
        $sm = Sede::where('slug', 'san-miguel')->first();

        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@theroyalepalace.sv'],
            ['name' => 'Super Admin', 'password' => Hash::make('Royale2026!'), 'sede_id' => null]
        );
        $superAdmin->assignRole('super_admin');

        $adminSS = User::firstOrCreate(
            ['email' => 'admin.sansalvador@theroyalepalace.sv'],
            ['name' => 'Admin San Salvador', 'password' => Hash::make('Royale2026!'), 'sede_id' => $ss->id]
        );
        $adminSS->assignRole('admin_san_salvador');

        $adminSA = User::firstOrCreate(
            ['email' => 'admin.santaana@theroyalepalace.sv'],
            ['name' => 'Admin Santa Ana', 'password' => Hash::make('Royale2026!'), 'sede_id' => $sa->id]
        );
        $adminSA->assignRole('admin_santa_ana');

        $adminSM = User::firstOrCreate(
            ['email' => 'admin.sanmiguel@theroyalepalace.sv'],
            ['name' => 'Admin San Miguel', 'password' => Hash::make('Royale2026!'), 'sede_id' => $sm->id]
        );
        $adminSM->assignRole('admin_san_miguel');
    }
}