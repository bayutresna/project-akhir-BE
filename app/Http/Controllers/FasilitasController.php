<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    function index()
    {
        $fasilitas = Fasilitas::query()->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $fasilitas
        ]);
    }

    // function show($id)
    // {
    //     $fasilitas = Fasilitas::query()->where("id", $id)->first();
    //     if (!isset($fasilitas)) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "data tidak ditemukan",
    //             "data" => null
    //         ]);
    //     }

    //     return response()->json([
    //         "status" => true,
    //         "message" => "ini Fasilitas",
    //         "data" => $fasilitas
    //     ]);
    // }

    function store(Request $request)
    {
        // mengambil data dari request
        $payload = $request->all();
        if (!isset($payload['nama'])) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }
        // end ambil data dari request

        $file = $request->file('logo');
        if (!$file) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }
        //-------------endrevisi
        $filename = $file->hashName();
        $file->move("Fasilitas", $filename);
        //pembuatan url foto
        $path = $request->getSchemeAndHttpHost() . "/Fasilitas/" . $filename;
        //end pembuatan url foto

        $payload['logo'] = $path;

        $fasilitas = Fasilitas::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $fasilitas
        ]);
    }

    // function update(Request $request, $id)
    // {
    //     $fasilitas = Fasilitas::query()->where("id", $id)->first();
    //     if (!isset($fasilitas)) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "data tidak ditemukan",
    //             "data" => null
    //         ]);
    //     }

    //     $payload = $request->all();

    //     $file = $request->file('foto');
    //     $temp = $fasilitas->imgurl;


    //     if ($file) {

    //         $file = $request->file('foto');
    //         if ($file) {

    //             $filename = $file->hashName();
    //             $file->move("Fasilitas", $filename);
    //             //pembuatan url foto
    //             $path = $request->getSchemeAndHttpHost() . "/Fasilitas/" . $filename;
    //             //end pembuatan url foto

    //             //untuk memasukan posisi foto pada storage
    //             $path3 = $request->getSchemeAndHttpHost() . "Fasilitas/" . $filename;
    //             $path2 = str_replace($request->getSchemeAndHttpHost(), "", $path3);
    //             //end memasukan posisi foto pada storage

    //         }


    //         $payload['foto'] = $path;
    //         $payload['imgurl'] = $path2;
    //         unlink($temp);
    //     }


    //     $fasilitas->fill($payload);
    //     $fasilitas->save();

    //     return response()->json([
    //         "status" => true,
    //         "message" => "perubahan data tersimpan",
    //         "data" => $fasilitas
    //     ]);
    // }

    // function destroy(Request $request, $id)
    // {
    //     $fasilitas = Fasilitas::query()->where("id", $id)->first();

    //     if (!isset($fasilitas)) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "data tidak ditemukan",
    //             "data" => null
    //         ]);
    //     }


    //     unlink($fasilitas->imgurl);


    //     $fasilitas->delete();

    //     return response()->json([
    //         "status" => true,
    //         "message" => "Data Terhapus",
    //         "data" => $fasilitas
    //     ]);
    // }
}
