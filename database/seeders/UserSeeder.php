<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // app()[PermissionRegister::class]->forgetCachedPermission();

        // create permissions
        Permission::create(['name' => 'crud workorder']);
        Permission::create(['name' => 'crud productions data']);
        Permission::create(['name' => 'input production data']);

        $role1  = Role::create(['name' => 'office-admin']);
        $role1->givePermissionTo('crud workorder');
        $role1->givePermissionTo('crud productions data');

        $role2  = Role::create(['name' => 'operator']);
        $role2->givePermissionTo('input production data');

        $role3  = Role::create(['name' => 'super-admin']);

        $role4  = Role::create(['name' => 'supervisor']);

        $role5  = Role::create(['name' => 'warehouse']);

        $superAdmin = User::create([
            'name'  => 'Super Admin',
            'employeeId' => '00000001',
            'password'  => bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);
        $superAdmin->assignRole($role3);

        $officeAdmin = User::create([
            'name'  => 'Office Admin',
            'employeeId' => '00000002',
            'password'  => bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);
        $officeAdmin->assignRole($role1);

        $operator = User::create([
            'name'  => 'Operator',
            'employeeId' => '00000003',
            'password'  => bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);
        $operator->assignRole($role2);

        $supervisor = User::create([
            'name'  => 'Supervisor Produksi',
            'employeeId' => '00000004',
            'password'  => bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);
        $supervisor->assignRole($role4);

        $warehouse = User::create([
            'name'  => 'Warehouse',
            'employeeId' => '00000005',
            'password'  => bcrypt('12345678'),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);
        $warehouse->assignRole($role5);

    }
}
