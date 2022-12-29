<?php

namespace App\Http\Controllers;

use App\Models\ReservasiKamar;
use Illuminate\Http\Request;

class ReservasiKamarController extends Controller
{
    function index()
    {
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->get()->where('isdeleted',false);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $reservasi
        ]);
    }
    function showavailability($tanggal, $idkamar){
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->where("id_kamar", $idkamar)->where('tanggal_cekin',$tanggal)->get();
        return response()->json([
            "status" => true,
            "message" => "data reservasi kamar",
            "data" => $reservasi
        ]);
    }

    function show($id)
    {
        $reservasi = ReservasiKamar::with(['user', 'kamar'])->where("id", $id)->first();
        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini ReservasiKamar",
            "data" => $reservasi
        ]);
    }

    function store(Request $request)
    {

        $payload = $request->all();
        $reservasi = ReservasiKamar::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $reservasi
        ]);
    }

    function update(Request $request, $id)
    {
        $reservasi = ReservasiKamar::query()->where("id", $id)->first();
        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('bukti_pembayaran');
        $filename = $file->hashName();
        $file->move("ReservasiKamar", $filename);

        //pembuatan url foto
        $path = $request->getSchemeAndHttpHost() . "/ReservasiKamar/" . $filename;
        //end pembuatan url foto

        //untuk memasukan posisi foto pada storage
        //end memasukan posisi foto pada storage
        $payload['foto'] = $path;


        $reservasi->fill($payload);
        $reservasi->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $reservasi
        ]);
    }

    function destroy(Request $request, $id)
    {
        $reservasi = ReservasiKamar::query()->where("id", $id)->first();

        if (!isset($reservasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }


        $reservasi->isdeleted= true;

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $reservasi
        ]);
    }
}
