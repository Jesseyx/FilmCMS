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
            [
                'id' => 1,
                'username' => 'root',
                'name' => 'root',
                'email' => 'jingshuaijun@kankan.com',
                'password' => bcrypt('123456'),
                'avatar' => '/img/user1-128x128.jpg',
                'cellphone' => '13115036044',
            ],
            [
                'id' => 2,
                'username' => 'shuaijun',
                'name' => '帅军',
                'email' => 'shuaijun@kankan.com',
                'password' => bcrypt('123456'),
                'avatar' => '/img/user2-160x160.jpg',
                'cellphone' => '13115036044',
            ],
        ]);

        factory('App\User', 50)->create()->each(function ($u) {
            $u->save();
        });
    }
}
