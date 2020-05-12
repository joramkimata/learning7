<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // check if user exists before seeding
        $check = User::where('email', 'admin')->count();

        if ($check == 0) {
            $user = new User;
            $user->name = 'Joe Doe';
            $user->email = 'admin';
            $user->password = bcrypt('123456');
            $user->role = 'admin';
            $user->save();
        }


    }
}
