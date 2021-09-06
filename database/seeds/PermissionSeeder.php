<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Permission::insert([
            ['name' => 'view_teams'],
            ['name' => 'edit_teams'],
            ['name' => 'delete_teams'],
            ['name' => 'view_players'],
            ['name' => 'edit_players'],
            ['name' => 'delete_players'],
        ]);
    }
}
