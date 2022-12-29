<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fasilitas::query()->create([
            'nama' => 'King Size Bed',
            "logo" => "http://127.0.0.1:8000/Fasilitas/E0GWeIWGGLHQt01LgtHa0EKPRTzIjfsA5TAx3Ql4.png"
        ]);

        Fasilitas::query()->create([
            'nama' => 'Queen Size Bed',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/n3yjcr7wWwL7qsdK4Vs13dMiVf7g1IzJEAUkN054.png"
        ]);

        Fasilitas::query()->create([
            'nama' => 'Twin Bed',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/E7gUzBRDgzd1Zl1toUWQh30QApSrBtfA0dHIi060.png",
        ]);

        Fasilitas::query()->create([
            'nama' => 'Shower',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/rVXul3gAZHWhBxJaeK6vs1SmIVquFPsNDEwvQ6o0.png",
        ]);

        Fasilitas::query()->create([
            'nama' => 'Bathtub',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/YvDY0VXkOJ3laXMLjwIHIC7ZHqrImUbY86HwLzbl.png",
        ]);

        Fasilitas::query()->create([
            'nama' => 'Breakfast',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/mLWREb8C7Got1rtNCqm4lTsyrWNeNkkmXRvaxG4R.png",
        ]);
        Fasilitas::query()->create([
            'nama' => 'No Breakfast',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/mLWREb8C7Got1rtNCqm4lTsyrWNeNkkmXRvaxG4R.png",
        ]);
        Fasilitas::query()->create([
            'nama' => 'Smoking Area',
            "logo"=> "http://127.0.0.1:8000/Fasilitas/oftfp3Y5acgEqWn1nyEctoSZXSS1A4Wh8IO5I7Uh.png",
        ]);
    }
}
