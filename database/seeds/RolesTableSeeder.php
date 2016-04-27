<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => '普通码农',
                'order' => 1,
                'description' => '我是普通码农',
            ],
            [
                'id' => 2,
                'name' => '高级码农',
                'order' => 2,
                'description' => '我是高级码农',
            ],
            [
                'id' => 3,
                'name' => '普通程序员',
                'order' => 3,
                'description' => '我是普通程序员',
            ],
            [
                'id' => 4,
                'name' => '高级程序员',
                'order' => 4,
                'description' => '我是高级程序员',
            ],
        ]);
    }
}
