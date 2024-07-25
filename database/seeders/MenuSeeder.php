<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['name' => 'Pengajuan Reimbursement', 'path' => 'pengajuan-reimbursement', 'access_permission' => 'user'],
            ['name' => 'Verifikasi', 'path' => 'verifikasi', 'access_permission' => 'verifikator'],
            ['name' => 'Approval', 'path' => 'approval', 'access_permission' => 'direktur'],
        ]);
    }
}
