<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder {
    public function run(): void {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos
        $permisos = [
            'ver-reservaciones', 'gestionar-reservaciones',
            'ver-mesas', 'gestionar-mesas',
            'ver-platos', 'gestionar-platos',
            'ver-usuarios', 'gestionar-usuarios',
            'ver-sedes', 'gestionar-sedes',
            'generar-reportes',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $adminSS    = Role::firstOrCreate(['name' => 'admin_san_salvador']);
        $adminSA    = Role::firstOrCreate(['name' => 'admin_santa_ana']);
        $adminSM    = Role::firstOrCreate(['name' => 'admin_san_miguel']);

        // Super Admin tiene todos los permisos
        $superAdmin->givePermissionTo(Permission::all());

        // Admins de sede tienen permisos de su sede
        $permisosAdmin = [
            'ver-reservaciones', 'gestionar-reservaciones',
            'ver-mesas', 'gestionar-mesas',
            'ver-platos', 'gestionar-platos',
            'generar-reportes',
        ];

        $adminSS->givePermissionTo($permisosAdmin);
        $adminSA->givePermissionTo($permisosAdmin);
        $adminSM->givePermissionTo($permisosAdmin);
    }
}