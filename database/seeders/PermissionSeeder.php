<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
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
        $roles_structure = Config::get('permission.roles_structure');
        $permissions_map = collect(config('permission.permissions_map'));
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        foreach($roles_structure as $role_name => $role_value){
            $this->command->info('Creating Role '. strtoupper($role_name));
            $role = Role::firstOrCreate(['name' => $role_name,'display_name'=>$role_name]);
            foreach($role_value as $module => $permission_content){
                foreach (explode(',', $permission_content) as $p => $perm) {
                    $this->command->info('Adding Permission '. $module.'-'.$permissions_map[$perm] .' For Module '.$module);

                    $permission = Permission::firstOrCreate(['name' => $module.'-'.$permissions_map[$perm],'table'=>$module]);
                    $role->givePermissionTo($permission);
                }
            }

        }
    }
}
