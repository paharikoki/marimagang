<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $adminbidang = Role::create(['name' => 'adminbidang', 'guard_name' => 'admin']);

        $superadmin = Admin::first();
        $superadmin->assignRole('superadmin');
        $superadmin = Admin::find(2);
        $superadmin->assignRole('superadmin');
        $adminbidang = Admin::find(3);
        $adminbidang->assignRole('adminbidang');
        $adminbidang = Admin::find(4);
        $adminbidang->assignRole('adminbidang');
        $adminbidang = Admin::find(5);
        $adminbidang->assignRole('adminbidang');
        $adminbidang = Admin::find(6);
        $adminbidang->assignRole('adminbidang');
        $adminbidang = Admin::find(7);
        $adminbidang->assignRole('adminbidang');
    }
}
