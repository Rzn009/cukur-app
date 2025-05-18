<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Daftar modul yang akan dibuatkan permission-nya
        $modules = [
            'user',
            'role',
            'barber',
            'booking',
            'category',
            'service',
            'schedule',
        ];

        // 3. Jenis-jenis permission per modul
        $actions = ['list', 'create', 'edit', 'delete'];

        // 4. Buat permission untuk setiap modul dan aksi
        foreach ($modules as $module) {
            // Permission umum untuk mengelola modul
            Permission::create(['name' => "manage {$module}"]);

            // Permission CRUD spesifik
            foreach ($actions as $action) {
                Permission::create(['name' => "{$module}-{$action}"]);
            }
        }

        // 5. Buat role super_admin
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);

        // 6. Berikan semua permission ke super_admin
        $superAdmin->syncPermissions(Permission::all());
    }
}
