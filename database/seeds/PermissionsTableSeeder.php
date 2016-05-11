<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => '用户管理-添加用户',
                // 权限带上命名空间
                'location' => 'User\User@create|User\User@store',
                'group_id' => 2,
            ],
            [
                'id' => 2,
                'name' => '用户管理-删除用户',
                'location' => 'User\User@delete',
                'group_id' => 2,
            ],
            [
                'id' => 3,
                'name' => '用户管理-查看用户列表',
                'location' => 'User\User@index',
                'group_id' => 2,
            ],
            [
                'id' => 4,
                'name' => '用户管理-修改用户',
                'location' => 'User\User@edit,update',
                'group_id' => 2,
            ],
        ]);
    }
}
