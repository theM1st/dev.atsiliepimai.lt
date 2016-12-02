<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'username' => 'demo',
            'password' => bcrypt('demo'),
            'email' => 'demo@atsiliepimai.lt',
            'first_name' => 'Demo',
            'user_role' => 'admin',
            'verified' => true,
        ]);

        factory(App\User::class, 50)->create();
    }
}
