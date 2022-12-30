<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    function index()
    {
        $kamar = Kamar::with(['tipe','fasilitas'])->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $kamar
        ]);
    }

    function show($id)
    {
        $kamar = Kamar::query()->where("id", $id)->first();
        if (!isset($kamar)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini Kamar",
            "data" => $kamar
        ]);
    }

    function store(Request $request)
    {
        // mengambil data dari request
        $payload = $request->all();
        // if (!isset($payload['nama'])) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "input belum lengkap",
        //         "data" => null
        //     ]);
        // }
        // end ambil data dari request

        $file = $request->file('foto');
        if (!$file) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }
        //-------------endrevisi
        $filename = $file->hashName();
        $file->move("Kamar", $filename);
        //pembuatan url foto
        $path = $request->getSchemeAndHttpHost() . "/Kamar/" . $filename;
        //end pembuatan url foto

        //untuk memasukan posisi foto pada storage

        //end memasukan posisi foto pada storage
        $payload['foto'] = $path;

        $kamar = Kamar::query()->create($payload);

        $payload['fasilitas'] = explode(',', $payload['fasilitas']);
        // dd($payload['fasilitas']);
        foreach($payload['fasilitas'] as $f){
            FasilitasKamar::create([
                'id_kamar' => $kamar->id,
                'id_fasilitas' => $f

            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $kamar
        ]);
    }

    function update(Request $request, $id)
    {
        $kamar = Kamar::query()->where("id", $id)->first();
        if (!isset($kamar)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('foto');



        if ($file) {

            $file = $request->file('foto');
            if ($file) {

                $filename = $file->hashName();
                $file->move("Kamar", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/Kamar/" . $filename;
                //end pembuatan url foto

                //untuk memasukan posisi foto pada storage

                //end memasukan posisi foto pada storage

            }
            $payload['foto'] = $path;
        }


        $kamar->fill($payload);
        $kamar->save();

        FasilitasKamar::where('id_kamar', $kamar->id)->delete();

        foreach($payload['fasilitas'] as $f){
            FasilitasKamar::create([
                'id_kamar' => $kamar->id,
                'id_fasilitas' => $f

            ]);
        }



        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $kamar
        ]);
    }

    function destroy(Request $request, $id)
    {
        $kamar = Kamar::query()->where("id", $id)->first();

        if (!isset($kamar)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }


        $kamar->isdeleted=true;
        $kamar->save();
        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $kamar
        ]);
    }
}
