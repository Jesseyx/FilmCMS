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
        //
        DB::table('users')->insert([
            'username' => 'root',
            'name' => '超级管理员',
            'email' => 'jingshuaijun@kankan.com',
            'password' => bcrypt('root'),
            'avatar' => '/user2-160x160.jpg',
            'cellphone' => '13115036044',
        ]);
    }
}
