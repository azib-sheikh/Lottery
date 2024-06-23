<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        try{
            DB::transaction(function () {
                $role =  DB::table('roles')->insertGetId([
                    'name' => 'superadmin',
                    'guard_name' => 'web'
                ]);
        
                $user = DB::table('users')->insertGetId([
                    'name' => 'Superadmin',
                    'email' => 'superadmin@mail.com',
                    'password' => \Hash::make('password')
                ]);
        
                DB::table('model_has_roles')->insertGetId([
                    'role_id' => $role,
                    'model_id' => $user,
                    'model_type' => '\App\Models\User'
                ]);
            });
        } catch(\Exception $e) {
            dd("Error occured while seeding -- ".$e->getMessage()."--\n"."-- Line number -- ".$e->getLine());
        }
    }
}
