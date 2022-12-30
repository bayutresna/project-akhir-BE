<?php

namespace App\Http\Controllers;

use App\Models\FasilitasHotel;
use Illuminate\Http\Request;

class FasilitasHotelController extends Controller
{
      function index()
    {
        $fasilitashotel = FasilitasHotel::query()->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $fasilitashotel
        ]);
    }

    function show($id)
    {
        $fasilitashotel = FasilitasHotel::query()->where("id", $id)->where('isdeleted',false)->first();
        if (!isset($fasilitashotel)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini Fasilitas Hotel",
            "data" => $fasilitashotel
        ]);
    }

    function store(Request $request)
    {
        // mengambil data dari request
        $payload = $request->all();

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
        $file->move("FasilitasHotel", $filename);
        //pembuatan url foto
        $path = $request->getSchemeAndHttpHost() . "/FasilitasHotel/" . $filename;
        //end pembuatan url foto


        $payload['foto'] = $path;

        $fasilitashotel = FasilitasHotel::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $fasilitashotel
        ]);
    }

    function update(Request $request, $id)
    {
        $fasilitashotel = FasilitasHotel::query()->where("id", $id)->where('isdeleted',false)->first();
        if (!isset($fasilitashotel)) {
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
                $file->move("FasilitasHotel", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/FasilitasHotel/" . $filename;
                //end pembuatan url foto

            }
            $payload['foto'] = $path;
        }


        $fasilitashotel->fill($payload);
        $fasilitashotel->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $fasilitashotel
        ]);
    }

    function destroy(Request $request, $id)
    {
        $fasilitashotel = FasilitasHotel::query()->where("id", $id)->where('isdeleted',false)->first();

        if (!isset($fasilitashotel)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $fasilitashotel->isdeleted = true;
        $fasilitashotel->save();
        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $fasilitashotel
        ]);
    }
}
