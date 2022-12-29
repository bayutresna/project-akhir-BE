<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeKamar::query()->create([
            'nama' => 'family'
        ]);

        TipeKamar::query()->create([
            'nama' => 'deluxe'
        ]);
        TipeKamar::query()->create([
            'nama' => 'premier'
        ]);
        TipeKamar::query()->create([
            'nama' => 'supreme'
        ]);
        TipeKamar::query()->create([
            'nama' => 'ultimate'
        ]);
    }
}
