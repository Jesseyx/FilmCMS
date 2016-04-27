<?php

use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permission_groups')->insert([
            [
                'id' => 1,
                'name' => '影视管理',
            ],
            [
                'id' => 2,
                'name' => '游戏管理',
            ],
            [
                'id' => 3,
                'name' => '轮播图管理',
            ],
            [
                'id' => 4,
                'name' => '栏目管理',
            ],
        ]);
    }
}
