<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\Admin::count();
        if($users==0)
            \App\Models\Admin::create([
                'name'=>"ADMIN",
                'email'=>"admin@admin.com",
                'password'=>bcrypt("password")
            ]);
    }
}
