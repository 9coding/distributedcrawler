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
        DB::table('admins')->insert([
            'admin_email' => 'ivan820819@qq.com',
            'password' => bcrypt('123456'),
            'admin_level' => 1,
            'admin_name' => '管理员',
            'admin_loginip' => 0,
            'admin_logindate' => now(),
            'remember_token' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

}
