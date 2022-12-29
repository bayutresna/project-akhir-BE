<?php

namespace Database\Seeders;

use App\Models\roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        roles::query()->create([
            'nama' => 'admin',
        ]);
        roles::query()->create([
            'nama' => 'penyewa',
        ]);
    }
}
