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

    function show($id)
    {
        $fasilitas = Fasilitas::query()->where("id", $id)->where('isdeleted',false)->first();
        if (!isset($fasilitas)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini Fasilitas",
            "data" => $fasilitas
        ]);
    }

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

    function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::query()->where("id", $id)->first();
        if (!isset($fasilitas)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('logo');

        if ($file) {

            $file = $request->file('logo');
            if ($file) {

                $filename = $file->hashName();
                $file->move("Fasilitas", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/Fasilitas/" . $filename;
                //end pembuatan url foto
            }


            $payload['logo'] = $path;

        }


        $fasilitas->fill($payload);
        $fasilitas->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $fasilitas
        ]);
    }

    function destroy(Request $request, $id)
    {
        $fasilitas = Fasilitas::query()->where("id", $id)->first();

        if (!isset($fasilitas)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $fasilitas->isdeleted = true;
        $fasilitas->save();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $fasilitas
        ]);
    }
}
