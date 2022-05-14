<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('username', 'admin')->first();
        if(!$admin){
            $admin = new User();
            $admin->username = 'admin';
            $admin->email = 'admin@example.com';
            $admin->password = password_hash('admin', PASSWORD_ARGON2ID);
            $admin->save();   
        }

        $this->call([
            PostSeeder::class,
            CommentSeeder::class
        ]);
    }
}
