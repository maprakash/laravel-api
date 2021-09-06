<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $admin = Role::whereName('Admin')->first();

        foreach($permissions as $permission){
            DB::table('role_permission')->insert([
                'role_id'=>$admin->id,
                'permission_id' => $permission->id,
            ]);
        }

        $viewer = Role::whereName('Viewer')->first();
        $viewerRoles = [
            'view_teams',
            'view_players',
        ];

        foreach($permissions as $permission){
            if(in_array($permission->name, $viewerRoles))
            {
                DB::table('role_permission')->insert([
                    'role_id'=>$viewer->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }


    }
}
