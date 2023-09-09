<?php 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Seed a single user
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin112277'), // You can use the bcrypt function or Hash facade to hash passwords
        ]);

        // Seed multiple users using factory
        // factory(App\User::class, 10)->create();
    }
}
