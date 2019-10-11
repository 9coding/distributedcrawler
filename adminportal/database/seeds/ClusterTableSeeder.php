<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('clusters')->insert([
            'cluster_code' => 'default',
            'cluster_name' => '默认集群',
            'cluster_description' => '所有没有归属的机器都属于默认集群',
            'cluster_status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

}
