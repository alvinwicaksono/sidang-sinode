<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Seksis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seksis')->insert([
            'nama' => 'Moderamen',
        ]);
        DB::table('seksis')->insert([
            'nama' => 'Keesaan',
        ]);
        DB::table('seksis')->insert([
            'nama' => 'PWG',
        ]);
        DB::table('seksis')->insert([
            'nama' => 'Keuangan',
        ]);
        DB::table('seksis')->insert([
            'nama' => 'BPK',
        ]);
        DB::table('seksis')->insert([
            'nama' => 'Visitasi',
        ]);
    }
}
