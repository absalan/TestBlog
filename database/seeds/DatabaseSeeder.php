<?php

use Illuminate\Database\Seeder;
use App\User as User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        User::create(['email' => 'git@mcclainconcepts.com', 'password' => Hash::make('LaravelTestPW')]);
        User::create(['email' => 'your@emailaddress.com', 'password' => Hash::make('LaravelTestPW')]);
    }
}
