<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Admin i7',
            'email' => 'admin@i7creative.com.br',
            'password' => bcrypt('creative5340'),
            'active' => 1
        ],[
            'name' => 'Lucas R. Pasquetto',
            'email' => 'lucas@i7creative.com.br',
            'password' => bcrypt('mklider'),
            'active' => 1
        ]);

        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
