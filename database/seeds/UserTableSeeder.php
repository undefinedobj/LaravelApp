<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 30)->create();

        $user = User::first();

        $user->name = 'Savory';
        $user->email = '8wy701645@163.com';
        $user->password = bcrypt(123456);
        $user->save();
    }
}
