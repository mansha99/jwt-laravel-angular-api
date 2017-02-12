<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        RolesAndUserSeed::run();
    }

}

class RolesAndUserSeed {

    public static function run() {

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::statement("TRUNCATE TABLE permission_role  ;");
        DB::statement("TRUNCATE TABLE  permissions      ;");
        DB::statement("TRUNCATE TABLE  role_user        ;");
        DB::statement("TRUNCATE TABLE  roles            ;");
        DB::statement("TRUNCATE TABLE  users;");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");



        $adminRole = new \App\Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'admin';
        $adminRole->description = 'System Administrator';
        $adminRole->save();

        $managerRole = new \App\Role();
        $managerRole->name = 'manager';
        $managerRole->display_name = 'manager';
        $managerRole->description = 'Manager';
        $managerRole->save();

        $userRole = new \App\Role();
        $userRole->name = 'user';
        $userRole->display_name = 'user';
        $userRole->description = 'User';
        $userRole->save();


        $adminUser = \App\User::create([
                    'name' => 'Admin',
                    'email' => "admin@email.com",
                    'password' => \Illuminate\Support\Facades\Hash::make('password1')
        ]);
        $adminUser->roles()->attach($adminRole->id);

        $managerUser = \App\User::create([
                    'name' => 'Manager',
                    'email' => "manager@email.com",
                    'password' => \Illuminate\Support\Facades\Hash::make('password1')
        ]);
        $managerUser->roles()->attach($managerUser->id);
    }

}
