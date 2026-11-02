<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Membersihkan cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Membuat Permission
        $permissions = [
            'lihat buku',
            'tambah buku',
            'edit buku',
            'hapus buku',
            'kelola role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // 2. Membuat Role Admin
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        // 3. Membuat Role Dosen
        $dosen = Role::firstOrCreate([
            'name' => 'Dosen',
            'guard_name' => 'web',
        ]);

        // 4. Membuat Role Mahasiswa
        $mahasiswa = Role::firstOrCreate([
            'name' => 'Mahasiswa',
            'guard_name' => 'web',
        ]);

        // 5. Memberikan Permission kepada Admin
        $admin->syncPermissions($permissions);

        // 6. Memberikan Permission kepada Dosen
        $dosen->syncPermissions([
            'lihat buku',
            'tambah buku',
            'edit buku',
        ]);

        // 7. Memberikan Permission kepada Mahasiswa
        $mahasiswa->syncPermissions([
            'lihat buku',
        ]);

        // Membersihkan cache kembali
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
