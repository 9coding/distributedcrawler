<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert([
            ['role_name' => '管理员','role_status' => 1],
            ['role_name' => '普通用户','role_status' => 1]
        ]);
    }

}
