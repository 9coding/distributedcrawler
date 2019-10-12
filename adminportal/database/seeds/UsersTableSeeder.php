<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'user_email' => 'ivan820819@qq.com',
            'user_password' => bcrypt('123456'),
            'user_name' => '管理员',
            'user_phone' => '',
            'user_point' => 0,
            'user_money' => 0,
            'user_status' => 1,
            'user_lastip' => 0,
            'user_lastdate' => now(),
            'user_currentip' => 0,
            'user_currentdate' => now(),
            'user_privatekey' => md5('ivan820819@qq.com'),
            'user_role' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

}
